<?php

namespace App\Http\Controllers\Backend\Admin;

use App\Events\CheckAwards;
use App\Events\CheckTask;
use App\Exceptions\InvalidRequestException;
use App\Http\Controllers\Controller;
use App\Models\Api;
use App\Models\ApiGame;
use App\Models\AsideAdv;
use App\Models\GameList;
use App\Models\GameRecord;
use App\Models\Member;
use App\Models\MemberApi;
use App\Models\MemberMoneyLog;
use App\Models\Permission;
use App\Models\QuickUrl;
use App\Models\SystemConfig;
use App\Models\SystemNotice;
use App\Models\Task;
use App\Services\MenuService;
use App\Services\TaskService;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;

class SendFsController extends AdminBaseController{

    protected $create_field = ['gameType','api_name','name','created_at'];

    // 一键反水，接口类型是必选的
    public function index(Request $request){
        if(\systemconfig('is_realtime_fs_mode')) throw new InvalidRequestException(trans('res.send_fs.msg.realtime_fs_mode'));

        $params = $request->only($request->only($this->create_field));

        if(!count($params)) return view('admin.sendfs.index',['data' => [],'gamerecords' => []]);

        if(!array_key_exists('gameType',$params) || !$params['gameType']) $params['gameType'] = 1;

        if(!array_key_exists('created_at',$params) || !$params['created_at']) $params['created_at'] = date('Y-m-d 00:00:00', strtotime('-1 day')).' ~ '.date('Y-m-d 23:59:59',strtotime('-1 day'));


        // 筛选符合条件的游戏记录
        $gamerecords = GameRecord::where($this->convertWhere($params))->where('is_fs',0)->get();

        // $data = Member::whereIn('id',array_unique($gamerecords->pluck('member_id')
        //    ->filterInnerAccount()->toArray()))->latest()->paginate(10);
        $data = Member::whereIn('id',array_unique($gamerecords->where('is_in_on',0)->pluck('member_id')
            ->toArray()))->latest()->paginate(10);

        return view('admin.sendfs.index',compact('params','data','gamerecords'));
    }

    // money['member_id'] => money , ids
    public function store(Request $request){
        if(\systemconfig('is_realtime_fs_mode')) throw new InvalidRequestException(trans('res.send_fs.msg.realtime_fs_mode'));

        if(!$request->get('ids')) return $this->failed(trans('res.base.item_select_required'));

        $data = $request->all();
        $params = $request->only(['created_at','api_name','gameType']);

        // $msg = "管理员发放时间范围【{$data['created_at']}】游戏类型【".config('platform.game_type')[$data['gameType']]."】的反水至反水钱包";

        $money_type = 'fs_money';
        if(\systemconfig('member_fs_money_type')) $money_type = \systemconfig('member_fs_money_type');

        try{
            DB::transaction(function() use ($data,$params,$money_type){
                GameRecord::where($this->convertWhere($params))
                    ->where('is_fs',0)
                    ->whereIn('member_id',$data['ids'])->update([
                    'is_fs' => 1
                ]);

                foreach ($data['ids'] as $member_id){
                    $member = Member::find($member_id);
                    $money_before = $member->$money_type;

                    // 发放反水，记录日志
                    if($member && $data['money'][$member_id]){
                        $member->increment($money_type,$data['money'][$member_id]);

                        MemberMoneyLog::create([
                            'member_id' => $member_id,
                            'money' => $data['money'][$member_id],
                            'money_before' => $money_before,
                            'money_after' => $member->$money_type,
                            'number_type' => MemberMoneyLog::MONEY_TYPE_ADD,
                            'operate_type' => MemberMoneyLog::OPERATE_TYPE_FANSHUI,
                            'money_type' => $money_type,
                            // 'description' => $msg,
                            'description' => trans('res.member_money_log.notice.system_send_fs',[
                                'time' => $data['created_at'],
                                'game_type' => Arr::get(trans('res.option.game_type',[],$member->lang),$data['gameType'])
                            ], $member->lang)
                        ]);
                    }
                }
            });


        }catch(\Exception $e){
            DB::rollBack();
            return $this->failed(trans('res.send_fs.msg.send_fail').$e->getMessage());
        }

        return $this->success(['reload' => true],trans('res.send_fs.msg.send_success'));
    }

    // laravel-iframe.test/admin/test
    public function test2()
    {
        //$res = \App\Models\GameRecord::where('member_id',1)->where('is_fs',0)->get();

        $gamerecords = DB::table('game_records')
            ->select(\DB::raw('sum(validBetAmount) as total_valid,gameType,GROUP_CONCAT(DISTINCT api_name SEPARATOR ",") as api_names'))
            ->where('member_id', 2)->where('is_fs', 0)
            ->where('validBetAmount', '>', 0)
            ->groupBy('gameType');
        // ->get();

        $data = DB::table('fs_levels')
            ->rightJoinSub($gamerecords, 'gr', function ($join) {
                $join->on('fs_levels.game_type', '=', 'gr.gameType')
                    ->on('fs_levels.quota', '<', 'gr.total_valid');
            })->where('fs_levels.quota', '>=', 'fs_levels.quota')
            ->orderBy('game_type', 'desc')
            ->orderBy('quota', 'desc')
            ->get(['fs_levels.name', 'fs_levels.quota', 'fs_levels.rate', 'fs_levels.game_type']);

        $gamerecords = $gamerecords->get()->transform(function ($item) use ($data) {
            // 获取最大的fs_level
            $fs_level = $data->where('game_type', $item->gameType)->first();
            if (!$fs_level) return [];


            $item->rate = $fs_level->rate;
            $item->fs_money = sprintf("%.2f", $item->total_valid * $fs_level->rate / 100);
            $item->game_type_text = isset_and_not_empty(config('platform.game_type'), $item->gameType, '');
            return $item;
        });

        //dd($data);

        echo json_encode(array_values($gamerecords->toArray()));
    }

    //laravel-iframe-i18n.test/admin/test
    public function test(){
        $arr = config('admin_menu');
        return $this->getPermissionLangs($arr);

        return $this->print_submenu(config('admin_menu'));
        return $this->print_submenu([
            'a' => 'c',
            'b' => ['c' => 'd'],
            ['a' => 'b']
        ]);

        //return $this->print_admin_menu();
        //echo json_encode(app(MenuService::class)->getFormatterPermissionList("web"));exit;
        // return app(TaskService::class)->getUndoTasks(Member::find(14),[1,2]);
        // app(\App\Services\AdminLogService::class)->systemLogCreate('测试记录');
        // event(new CheckTask(Member::find(1),Task::TYPE_SUM_DRAWING));
        // event(new CheckAwards(Member::find(1)));

        // app(MenuService::class)->listFolderFiles(public_path().'/web/images/game/ag');
        // return;

        // 导出数组格式的字符串
        // $data = Api::select('id','api_title','api_name','is_open')->get()->toArray();
        // $data = ApiGame::select('id','title','web_pic','mobile_pic','api_name','class_name','game_type','params','tags','is_open')->get()->makeHidden('game_type_text')->toArray();
        // $data = ApiGame::where('web_pic','like','%cdn%')->get()->pluck('web_pic')->implode(PHP_EOL);print_r($data);exit;

        // $data = QuickUrl::select('id','name','type','url','is_open','weight')->get()->makeHidden('full_url')->toArray();
        // $data = AsideAdv::select('id','name','group','pic_url','pic_index','pic_width','pic_height','url_id','vertical','horizontal','effect','is_open','weight')->get()->toArray();

        //foreach ($data as $val){echo current($val).'<br>';}
        // $data = GameList::get()->makeHidden(['full_image_url','created_at','updated_at'])->toArray();
        // $data = SystemNotice::get()->makeHidden(['id','created_at','updated_at'])->toArray();

        //        $data = GameList::select('name','api_name','game_type','game_code','img_path','img_url','client_type','is_open','tags')->where('api_name','AG')->get()->makeHidden('full_image_url')->toArray();
        //          $data = MemberApi::select('member_id','username','password','api_name')->get()->toArray();
        //        $data = SystemConfig::latest()->take(2)->get()->toArray();

        $str = '<pre><code class="language-php">[<br>';
        foreach($data as $key  => $value){
            $str .= "[";
            foreach($value as $k => $v){
                if(!$v) continue;
                $str .= "   '{$k}' => '{$v}',";
            }
            $str .= "],";
            $str .= '<br>';
        }

        $str .= '<br>]</code></pre>';

        echo $str;
    }

    public function print_admin_menu(){
        $data = config('admin_menu');
        echo '<pre>';
        foreach ($data as $o){
            echo '[<br>';

            foreach ($o as $k1 => $t){
                if(is_array($t)){
                    echo "&#9'{$k1}' => [<br>";

                    foreach ($t as $k2 => $v2){
                        echo "&#9&#9[<br>";

                        foreach ($v2 as $k3 => $v3){
                            if(is_array($v3)){
                                echo "&#9&#9&#9'{$k3}' => [<br>";

                                foreach ($v3 as $k4 => $v4){
                                    echo "&#9&#9&#9&#9[<br>";

                                    foreach ($v4 as $k5 => $v5){
                                        echo "&#9&#9&#9&#9&#9'{$k5}' => '".($v5 ? $v5 : 'null')."',<br>";
                                    }

                                    echo "&#9&#9&#9&#9],<br>";
                                }

                                echo "&#9&#9&#9],<br>";
                            }else{
                                echo "&#9&#9&#9'{$k3}' => '".($v3 ? $v3 : 'null')."',<br>";
                            }
                        }

                        echo "&#9&#9],<br>";
                    }

                    echo "&#9],<br>";
                }
                else{
                    echo "&#9'{$k1}' => '".($t ? $t : 'null')."',<br>";
                }
            }

            echo '],<br>';
        }
        echo '</pre>';
    }
}
