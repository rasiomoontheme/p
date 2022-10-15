<?php

namespace App\Http\Controllers\Backend\Admin;

use App\Models\ActivityApply;
use App\Models\Base;
use App\Models\CreditPayRecord;
use App\Models\GameRecord;
use App\Models\Member;
use App\Models\MemberLog;
use App\Models\MemberMoneyLog;
use App\Models\MemberYuebaoPlan;
use App\Models\SystemConfig;
use App\Services\ActivityService;
use App\Services\AgentService;
use App\Services\GameService;
use App\Services\MenuService;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\BaseController;
use App\Models\Drawing;
use App\Models\MemberAgentApply;
use App\Models\Message;
use App\Models\Recharge;
use Illuminate\Support\Facades\DB;

class IndexController extends AdminBaseController{

    public function main(){
        $voice_list = SystemConfig::where('config_group','notice')
            ->where('type','file')->where('value','<>','')->get();

        $user = $this->guard()->user();
        return view("admin.main",compact('voice_list','user'));
    }

    public function index(Request $request){
        // 获取统计数据
        $startDay = Carbon::now()->startOfDay();
        $startMonth = Carbon::now()->startOfMonth();

        // 注册数据
        $today_register = Member::where('created_at','>',$startDay)->filterDemoAccount()->count();
        $month_register = Member::where('created_at','>',$startMonth)->filterDemoAccount()->count();

        // 营销数据（包括 会员的福利金额，代理的佣金 和 全民代理的返点）
        $today_free = app(AgentService::class)->getTotalFreeMoney($startDay);
        $month_free = app(AgentService::class)->getTotalFreeMoney($startMonth);

        // 今日投注
        $today_bet = GameRecord::where('created_at','>',$startDay)
            ->whereNotIn('member_id',Member::demoIdLists())
            ->where('status',GameRecord::STATUS_COMPLETE)
            ->sum('betAmount');
        $month_bet = GameRecord::where('created_at','>',$startMonth)
            ->whereNotIn('member_id',Member::demoIdLists())
            ->sum('betAmount');

        // 游戏营收 (派彩金额 - 投注金额)
        $today_game_profit = GameRecord::where('created_at','>',$startDay)
            ->whereNotIn('member_id',Member::demoIdLists())
            ->sum('netAmount');
        $today_game_profit = sprintf("%.2f",$today_game_profit - $today_bet);

        $month_game_profit = GameRecord::where('created_at','>',$startMonth)
            ->whereNotIn('member_id',Member::demoIdLists())
            ->where('status',GameRecord::STATUS_COMPLETE)
            ->sum('netAmount');
        $month_game_profit = sprintf("%.2f",$month_game_profit - $month_bet);

        // 获取最近7天的注册数据
        /**
        $last_7days_counts = DB::table('members')->select(DB::raw("count(*) as member_count, date_format(created_at, '%Y-%m-%d') as date"))->where('created_at','>', Carbon::now()->subDays(6)->startOfDay())->groupBy('date')->get();

        // 循环处理结果
        $last_7days = [];
        for($i = 0; $i < 7; $i++){
            $dates = Carbon::now()->subDays(6 - $i)->startOfDay()->format('Y-m-d');
            $datas = $last_7days_counts->where('date',$dates)->first();
            $last_7days[$dates] = $datas->member_count ?? 0;
        }
        **/

        // 获取最近10天的充值数据
        $last_10day_sum = DB::table('recharges')
            ->select(DB::raw("sum(money) as recharge_sum, date_format(created_at, '%Y-%m-%d') as date"))
            ->where('created_at','>', Carbon::now()->subDays(9)->startOfDay())
            ->whereNotIn('member_id',Member::demoIdLists())
            ->where('status',Recharge::STATUS_SUCCESS)
            ->groupBy('date')->get();

        $last_10days = [];
        for($i = 0; $i < 10; $i++){
            $dates = Carbon::now()->subDays(9 - $i)->startOfDay()->format('Y-m-d');
            $datas = $last_10day_sum->where('date',$dates)->first();
            $last_10days[$dates] = floatval($datas->recharge_sum ?? 0);
        }

        // 获取最近10天的提款数据
        $last_10day_drawing_sum = DB::table('drawings')
            ->select(DB::raw("sum(money) as drawing_sum, date_format(created_at, '%Y-%m-%d') as date"))
            ->where('created_at','>', Carbon::now()->subDays(9)->startOfDay())
            ->whereNotIn('member_id',Member::demoIdLists())
            ->where('status',Drawing::STATUS_SUCCESS)
            ->groupBy('date')->get();

        $last_10days_drawing = [];
        for($i = 0; $i < 10; $i++){
            $dates = Carbon::now()->subDays(9 - $i)->startOfDay()->format('Y-m-d');
            $datas = $last_10day_drawing_sum->where('date',$dates)->first();
            $last_10days_drawing[$dates] = floatval($datas->drawing_sum ?? 0);
        }

        return view("admin.index.index",compact('today_register','month_register','today_free','month_free','today_bet','month_bet','today_game_profit','month_game_profit','last_10days','last_10days_drawing'));
    }

    public function iconlist(Request $request){
        return view("layouts.icon_list");
    }

    public function picture_upload(){
        return view("admin.apigame.picture_uploader");
    }

    public function notice_undeal(){
        $now = Carbon::now();
        $data = [];

        $data['recharge'] = Recharge::where('status',Recharge::STATUS_UNDEAL)->count();
        $data['drawing'] = Drawing::where('status',Drawing::STATUS_UNDEAL)->count();
        $data['message'] = Message::where('status',Message::STATUS_NOT_DEAL)->where('send_type',Message::SEND_TYPE_MEMBER)->count();

        // 查询是否有需要提醒的用户登录
        /**
        $data['member'] = MemberLog::where('type',MemberLog::LOG_TYPE_API_LOGIN)
            ->whereIn('member_id',Member::where('is_tips_on',1)->pluck('id'))
            ->whereBetween('created_at',[Carbon::now()->subSeconds(15),$now])->count();
         */
        $data['member'] = MemberLog::memberRecent()
            ->whereIn('member_id',Member::where('is_tips_on',1)->pluck('id'))->count();

        // 代理申请
        $data['agent_apply'] = MemberAgentApply::where('status',MemberAgentApply::STATUS_NOT_DEAL)->count();

        // 余额宝购买，金额日志表中 余额宝购买记录的备注表示已读时间
         $data['yuebao'] = MemberMoneyLog::where('operate_type',MemberMoneyLog::OPERATE_TYPE_FINANCIAL)
             ->where('model_name',get_class(app(MemberYuebaoPlan::class)))
             ->where('remark','')
             ->whereBetween('created_at',[Carbon::now()->subDay(),$now])->count();

         // 活动申请提醒
        $data['activity'] = ActivityApply::where('status',ActivityApply::STATUS_NOT_DEAL)->count();

        // 借呗提醒
        $data['credit_apply'] = CreditPayRecord::where('type',CreditPayRecord::TYPE_BORROW)->where('status',CreditPayRecord::STATUS_UNDEAL)->count();

        app(ActivityService::class)->check_credit();
        $data['credit_overdue'] = CreditPayRecord::where('type',CreditPayRecord::TYPE_BORROW)
            ->where('is_return',0)->where('is_overdue',1)->where('is_read',0)->count();

        $notices = '';
         // 循环data数组，取出需要提醒的 键值
        foreach ($data as $k => $v){
            if($v > 0) $notices .= $k.',';
        }

        $data['notices'] = $notices;
        return $this->success(['data' => $data]);
    }


    // 游戏记录汇总
    public function gamerecord_total(){
        /**
        $api_types = DB::table('apis')->select('apis.api_name','apis.api_title','api_games.game_type')->leftJoin('api_games',function($join){
            $join->on('apis.api_name','=','api_games.api_name')->where('api_games.is_open',1);
        })->where('api_games.is_open',1)->groupBy('apis.api_name','apis.api_title','api_games.game_type')->get();

        $data = collect([]);

        foreach ($api_types as $key => $val){
            if(in_array($val->game_type,[1,2,3,6]) && !$data->where('api_name',$val->api_name)->where('fresh_time',300)->first()){
                $data->push([
                    'api_name' => $val->api_name,
                    'title' => $val->api_title.'(今天)',
                    'fresh_time' => 300,
                    'start_at' => $start_at,
                    'end_at' => $end_at
                ]);
            }

            else if(in_array($val->game_type,[4,99])){
                if(!$api_types->where('api_name',$val->api_name)->whereIn('game_type',[1,2,3,6])->first()){
                    $data->push([
                        'api_name' => $val->api_name,
                        'title' => $val->api_title.'(今天)',
                        'fresh_time' => 300,
                        'start_at' => $start_at,
                        'end_at' => $end_at
                    ]);
                }


                $data->push([
                    'api_name' => $val->api_name,
                    'title' => $val->api_title.'(昨天)',
                    'fresh_time' => 1800,
                    'start_at' => $yesterder_start_at,
                    'end_at' => $yesterder_end_at
                ]);
            }

            else if($val->game_type == 5){
                if(!$api_types->where('api_name',$val->api_name)->whereIn('game_type',[1,2,3,6])->first()){
                    $data->push([
                        'api_name' => $val->api_name,
                        'title' => $val->api_title.'(今天)',
                        'fresh_time' => 300,
                        'start_at' => $start_at,
                        'end_at' => $end_at
                    ]);
                }

                if(!$api_types->where('api_name',$val->api_name)->where('game_type',4)->first()){
                    $data->push([
                        'api_name' => $val->api_name,
                        'title' => $val->api_title.'(昨天)',
                        'fresh_time' => 1800,
                        'start_at' => $yesterder_start_at,
                        'end_at' => $yesterder_end_at
                    ]);
                }

                $data->push([
                    'api_name' => $val->api_name,
                    'title' => $val->api_title.'(前天)',
                    'fresh_time' => 3600,
                    'start_at' => $yesterder_start_at,
                    'end_at' => $yesterder_end_at
                ]);
            }
        }

        // dd($data->pluck('title'));
        */

        $start_at = date('Y-m-d H:i:s',time() - 3 * 3600);
        $end_at = date('Y-m-d H:i:s');

        $yesterder_start_at = date('Y-m-d H:i:s',time() - (3 + 24) * 3600);
        $yesterder_end_at = date('Y-m-d H:i:s',time() - 24 * 3600);

        $yesterder_before_start_at = date('Y-m-d H:i:s',time() - (3 + 24 * 2) * 3600);
        $yesterder_before_end_at = date('Y-m-d H:i:s',time() - 24 * 2 * 3600);

        $data = [
            ['api_name' => '','title' => '全部 - 今天','fresh_time' => 300,
                'start_at' => $start_at,'end_at' => $end_at],
            ['api_name' => '','title' => '全部 - 昨天','fresh_time' => 1800,
                'start_at' => $yesterder_start_at,'end_at' => $yesterder_end_at],
            ['api_name' => '','title' => '全部 - 前天','fresh_time' => 3600,
                'start_at' => $yesterder_before_start_at,'end_at' => $yesterder_before_end_at],
        ];

        if(\App\Models\Api::where('api_name',\App\Models\Api::JZ_LOTTERY)->where('is_open',1)->first()){
            array_push($data, ['api_name' => 'JZ','title' => '极致彩票 - 今天','fresh_time' => 300,
                'start_at' => $start_at,'end_at' => $end_at]);

            array_push($data, ['api_name' => 'JZ','title' => '极致彩票 - 昨天','fresh_time' => 1800,
                'start_at' => $yesterder_start_at,'end_at' => $yesterder_end_at]);

            array_push($data, ['api_name' => 'JZ','title' => '极致彩票 - 前天','fresh_time' => 3600,
                'start_at' => $yesterder_before_start_at,'end_at' => $yesterder_before_end_at]);
        }

        return view('admin.gamerecord.total',compact('data'));
    }

    // 游戏记录单个拉取
    public function gamerecord_pull(){
        return view('admin.gamerecord.pull');
    }

    // 定时发放代理的返点
    public function agent_fd_cron(){
        if(\systemconfig('agent_fd_mode'))
            return view('admin.gamerecord.fd');
        else
            exit('当前不是无限代理模式，不需要开启此页面');
    }

    // 补单操作
    // /gamerecord/check
    public function transfer_check(){
        return view('admin.gamerecord.bd');
    }

    // 修复数据库中失效的URL
    public function fix_url(){
        $oldurl = \systemconfig('site_domain',Base::LANG_COMMON);
        // $newurl = config('APP_URL');
        $newurl = env('APP_URL');

        if(!strlen($oldurl)) return $this->failed(trans('res.index.site_domain_required'));

        if(!$newurl) return $this->failed(trans('res.index.app_url_required'));

        if($oldurl == $newurl) return $this->failed(trans('res.index.url_same_error'));

        try{
            // 创建 软连接
            app(MenuService::class)->checkUploadsFolder();

            // 批量替换所有的图片地址
            app(GameService::class)->replaceAllPic();
        }catch (\Exception $e){
            return $this->failed($e->getMessage());
        }

        // 执行替换图片操作后，应该整个页面刷新
        // return $this->success([],'操作成功');
        return $this->success(['redirect' => route('admin.main')],trans('res.base.operate_success'));
    }
}
