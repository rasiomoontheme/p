<?php

namespace App\Services;

use App\Exceptions\InvalidRequestException;
use App\Models\Activity;
use App\Models\CreditPayRecord;
use App\Models\InterestHistory;
use App\Models\Member;
use App\Models\MemberYuebaoPlan;
use App\Models\YuebaoPlan;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class ActivityService{

    public function getActivityDetailHtml(Activity $activity){
        $html = '';

        // 活动时间
        $html .= $this->getTitleValueHtml(trans('res.activity.field.date_description'),$activity->date_description);

        // 活动内容
        $html .= $this->getTitleValueHtml(trans('res.activity.field.content'));
        $html .= $activity->content;

        // 申请方式
        $html .= $this->getTitleValueHtml(trans('res.activity.field.apply_type'));
        // $html .= $this->getHrefImageHtml($activity->apply_type,$activity->apply_url);
        $html .= $this->getHrefImageHtml($activity->apply_type,$activity->apply_type == Activity::APPLY_TYPE_HALL ? quicklink('activity_hall').'/'.$activity->id :$activity->apply_url);
        $html .= $activity->apply_desc;

        // 活动细则
        $html .= $this->getTitleValueHtml(trans('res.activity.field.rule_content'));
        $html .= $activity->rule_content;

        return $html;
    }

    public function getTitleValueHtml($title,$value = ''){
        return '<p><span style="color:#f39c12;"><span style="font-size:20px;"><span style="margin:0cm 0cm 0.0001pt;text-align:justify;"><span style="font-family:Verdana,Geneva,sans-serif;"><span style="line-height:150%;"><small><strong>'.$title.'：</strong>'.($value  ?? "").'</small></span></span></span></span></span></p>';
    }

    public function getHrefImageHtml($type,$url = ''){
        if($type == Activity::APPLY_TYPE_NO_NEED) return '';

        $img = systemconfig('site_domain');

        if($type == Activity::APPLY_TYPE_KEFU){
            $img .= '/images/apply_type_kefu.gif';
            // 读取客服地址
            $html = '<p><a href="'.$url.'" onclick="window.open(this.href, \'\', \'resizable=no,status=no,location=no,toolbar=no,menubar=no,fullscreen=no,scrollbars=no,dependent=no,width=800,height=625\'); return false;">';
        }

        else if($type == Activity::APPLY_TYPE_HALL){
            $img .= '/images/apply_type_hall.gif';
            // 读取活动大厅地址
            $html = '<p><a href="'.$url.'" target="_blank">';
        }
        else if(Activity::APPLY_TYPE_URL){
            $img .= '/images/apply_type_url.gif';
            $html = '<p><a href="'.$url.'" target="_blank">';
        }

        $html .= '<img alt="" height="62" src="'.$img.'" width="219"></a></p>';
        return $html;
    }

    // 计算余额宝的利息
    // app(\App\Services\ActivityService::class)->yuebao_calc(\App\Models\Member::find(1))
    public function yuebao_calc(Member $member){
        // 找出 interest_histories 表中最新的数据
        $lastRecords = DB::table('interest_histories')->select('member_plan_id',DB::raw('MAX(id) as id'))
            ->groupBy('member_plan_id')->get();

        // 查找未结算的方案 以及 方案的 最后结算时间
        $records = DB::table('member_yuebao_plans')
            ->select('member_yuebao_plans.*','interest_histories.calc_at','interest_histories.times')

            ->leftJoin('interest_histories',function($join) use ($lastRecords){
            $join->on('member_yuebao_plans.id','=','interest_histories.member_plan_id')
                ->whereIn('interest_histories.id',$lastRecords->pluck('id'));
        })

            ->where('member_yuebao_plans.member_id',$member->id)
            //->where('member_yuebao_plans.id',11)
            ->where('member_yuebao_plans.status',MemberYuebaoPlan::STATUS_PROCESSING)->get();

        // 查找这些plan
        $plans = YuebaoPlan::whereIn('id',$records->pluck('plan_id'))->get();

        // 循环处理这些记录，判断是否需要发放
        foreach ($records as $item){
            $plan = $plans->where('id',$item->plan_id)->first();

            // 如果方案不存在，则跳过
            if(!$plan) continue;

            // 如果不是循环发放，并且以及发放过一次，跳过
            if(!$plan->IsCycleSettle && $item->times > 0) continue;

            // 计算发放次数 （当前时间 - 最开始的购买时间） / 时间间隔
            $times = floor(Carbon::now()->diffInHours(Carbon::parse($item->created_at)) / $plan->SettleTime);
            $times = $times ? $times : 0;

            // 如果发放次数 和 最大发放次数是一样的，那么不需要发放
            if($times <= $item->times) continue;

            // $times = $times == 0 ? $times : $times + 1;
            $times = $plan->IsCycleSettle ? $times : 1;


            // 创建利息记录
            try{
                DB::transaction(function () use ($item, $times, $plan){
                    for($i = $item->times ?? 0 ; $i < $times;$i++){
                        InterestHistory::create([
                            'member_plan_id' => $item->id,
                            'interest' => sprintf("%.2f", $item->amount * $plan->Rate / 100),
                            'times' => $i + 1,
                            'calc_at' => Carbon::parse($item->calc_at ?? $item->created_at)->addHours($plan->SettleTime * ($i+1))
                        ]);
                    }
                });
            }catch (\Exception $e){
                DB::rollBack();
                throw new InvalidRequestException($e->getMessage());
            }
        }
    }

    // 检查借呗是否逾期,如果逾期则设置逾期
    public function check_credit(){
        CreditPayRecord::where('type',CreditPayRecord::TYPE_BORROW)
            ->where('status',CreditPayRecord::STATUS_SUCCESS)
            ->where('is_return',0)
            ->where('is_overdue',0)
            ->where('dead_at','<',Carbon::now())->update([
                'is_overdue' => 1
            ]);
    }

    public function read_credit(){
        // writelog('管理员 已读 逾期列表');
        CreditPayRecord::where('type',CreditPayRecord::TYPE_BORROW)
            ->where('status',CreditPayRecord::STATUS_SUCCESS)
            ->where('is_return',0)
            ->where('is_overdue',1)
            ->where('is_read',0)
            ->update([
                'is_read' => 1
            ]);
    }

    // 借呗清零
    // app(App\Services\ActivityService::class)->reset_credit_pay()
    public function reset_credit_pay(){
        Member::where('status',Member::STATUS_ALLOW)->update([
            'total_credit' => 0,
            'used_credit' => 0
        ]);
    }
}