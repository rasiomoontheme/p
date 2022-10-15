<?php

namespace App\Services;

use App\Exceptions\InvalidRequestException;
use App\Models\Api;
use App\Models\GameRecord;
use App\Models\Member;
use App\Models\MemberLog;
use App\Models\Transfer;
use Carbon\Carbon;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;

class MemberService{

    // const DEMO_PREFIX = 'demo';
    const DEMO_NUMBER_LENGTH = 4;

    // 试玩账号 前缀不固定
    public function getDemoPrefix(){
        return substr(md5(env('APP_URL')),0,5);
    }

    public function getLastDemoName(){
        return Member::withTrashed()->where('is_demo',1)->latest()->orderByDesc('id')->first()->name ?? '';
    }

    // app(App\Services\MemberService::class)->generateDemoName()
    public function generateDemoName(){
        $last = $this->getLastDemoName();

        $prefix = $name = $this->getDemoPrefix();
        $number = 0;
        if($last) $number = intval(substr($last,strlen($prefix)));

        $name = $name.$this->getDemoNameByNumber($number + 1);
        return $name;
    }

    public function getDemoNameByNumber($number){
        return str_pad($number,self::DEMO_NUMBER_LENGTH,0,STR_PAD_LEFT);
    }

    // 更新会员的码量
    // app(App\Services\MemberService::class)->updateMemberML(App\Models\Member::find(1))
    public function updateMemberML(Member $member){
        // $total_ml = app(GameRecord::class)->getMemberTotalValidBet($member->id);
        $total_ml = GameRecord::where('member_id',$member->id)
            ->where('status','<>',GameRecord::STATUS_X)->where('is_ml_use',0)->sum('validBetAmount');

        // $percent = systemconfig('ml_percent');

        // if($percent <= 0 || !$total_ml) return;

        // $percent = sprintf("%.2f", $percent / 100);

        try{
            DB::transaction(function() use($member,$total_ml){
                $add_ml = sprintf("%.2f",$total_ml);
                $member->decrement('ml_money',$add_ml);
                $member->increment('total_money',$total_ml);

                GameRecord::where('member_id',$member->id)->where('status','<>',GameRecord::STATUS_X)->update([
                    'is_ml_use' => 1
                ]);
            });
        }catch (\Exception $e){
            DB::rollBack();
            throw new InvalidRequestException(trans('res.api.drawing.ml_calc_err').$e->getMessage());
        }
    }

    // 判断该笔订单是否转入成功
    // app(App\Services\MemberService::class)->checkMemberTransferError()
    public function checkMemberTransferError(){
        // 筛选需要处理的日志
        $logs = MemberLog::where('status',MemberLog::STATUS_NOT_DEAL)->get();

        $count = 0;$errMsg = '';

        if($logs->count() == 0) return ['code' => 0,'data' => $count,'msg' => $errMsg];

        $services = app(SelfService::class);

        $now = Carbon::now();

        foreach ($logs as $item){
            $member = $item->member;

            // 根据订单号查询接口
            $json = $services->checktransfer($member,$now,$item->remark);

            try{
                $res = json_decode($json,1);

                if(!is_array($res)) throw new InvalidRequestException('网络错误，请重试');

                if($res['status']['errorCode']) throw new InvalidRequestException('错误代码：'.$res['status']['errorCode'].'，错误信息：'.$res['status']['msg']);

                // 在服务器查询的到 额度转换记录 则不需要补单
                if(count($res['data']) > 0 && Arr::get(current($res['data']),'bill_no') && current($res['data'])['bill_no'] != $item->remark){
                    /**
                    $item->update([
                    'status' => MemberLog::STATUS_DEALED,
                    ]);
                     **/

                    echo '会员【'.$item->member->name.'】订单号【'.$item->remark.'】分数未丢失'.PHP_EOL;

                }else{

                    $count++;

                    // 补单操作
                    DB::transaction(function() use($item, $member){
                        $transfer = Transfer::where('bill_no',$item->remark)->first();

                        $api = null;
                        if($transfer) $api = Api::where('api_name',$transfer->api_name)->first();

                        if(!$transfer || !$api) throw new InvalidRequestException('无法查询到本地转账记录');

                        $money_type = $transfer->money_type;

                        $member->increment($money_type,$transfer->money);

                        MemberMoneyLog::create([
                            'member_id' => $member->id,
                            'money' => $transfer->money,
                            'money_before' => $member->$money_type,
                            'money_after' => $member->$money_type + $transfer->money,
                            'number_type' => MemberMoneyLog::MONEY_TYPE_ADD,
                            'operate_type' => MemberMoneyLog::OPERATE_TYPE_DEPOSIT_RETURN,
                            'money_type' => $money_type,
                            'description' => '转入【'.$api->api_title.'】游戏失败，退还账户金额【'.$transfer->money.'元】'
                        ]);

                        echo '会员【'.$item->member->name.'】补单订单号【'.$item->remark.'】'.PHP_EOL;
                    });
                }

            }catch (\Exception $e){
                DB::rollBack();
                $errMsg = $errMsg.','.$e->getMessage();
            }
        }

        return ['code' => 1,'data' => $count,'msg' => $errMsg];
    }
}