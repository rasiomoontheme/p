<?php

namespace App\Services;
use App\Models\Attachment;
use App\Models\GameRecord;
use App\Models\Payment;
use App\Models\SystemConfig;
use Carbon\Carbon;

class GameService {

    // app(App\Services\GameService::class)->batchModifyName('D:\游戏图片\MG Game Icons');
    public function batchModifyName($path){
        if(!is_dir($path)) exit('不是目录');

        $handle = opendir($path);

        while(($fn = readdir($handle))!==false){

            // && substr($fn,strlen($fn) - 5, strlen($fn) - 1) == '1.png'
            if($fn!='.'&&$fn!='..' ){
                echo "<br>将名为：".$fn."\n\r";
                $curDir = $path.'/'.$fn;

                if(!is_dir($curDir)){
                    $pathinfo = pathinfo($curDir);
                    // $newname = $pathinfo['dirname'].'/'.explode('_',$fn)[0].'.'.$pathinfo['extension'];
                    $newname = $this->getFullFileNewName($pathinfo['dirname'],$pathinfo['extension'],$fn);
                    echo '替换成'.basename($newname);
                    rename($curDir,$newname);
                }
            }
        }
    }

    // 待处理文件名 BTN_CouchPotato2
    // 测试 app(App\Services\GameService::class)->getFullFileNewName('/','png','DoubleJokerPowerPoker1.png');
    public function getFullFileNewName($dirname,$extension,$oldname){
        // 移除 BTN_
        $newname = \Str::replaceFirst('btn_','',$oldname);
        $newname = $this->removeFileExtension($newname,$extension);

        $newname = $this->removeLastNumber($newname);

        return $dirname.'/'.$newname.'.'.$extension;
    }

    // 移除文件名中的 extension
    public function removeFileExtension($name,$extension){
        $search = '.'.$extension;

        if(\Str::endsWith($name,$search)){
            return \Str::replaceLast($search,'',$name);
        }

        return $name;
    }

    // 获取最后一个字符串
    // app(App\Services\GameService::class)->getLastChar('abc');
    public function getLastChar($str){
        return \Str::substr($str, strlen($str)-1);
    }

    public function removeLastNumber($str){
        $last = $this->getLastChar($str);

        if(is_numeric($last)){
            return \Str::replaceLast($last,'',$str);
        }

        return $str;
    }

    // 修改文件名
    // http://888ht.lin-game.com/storage 修改为 env('APP_URL').'/storage'
    // app(App\Services\GameService::class)->replaceNewDomain('http://888ht.lin-game.com/storage/uploads/api_game/202007/07/api_game_1594090779_r28wdgR8Gs.png');
    public function replaceNewDomain($oldurl,$domain = ''){
        $domain = $domain ?? substr($oldurl,0,strpos($oldurl,'storage/uploads') - 1);
        // return strlen($domain) ? \Str::replaceFirst($domain,env('APP_URL'),$oldurl) : $oldurl;
        return strlen($domain) ? str_replace($domain,env('APP_URL'),$oldurl) : $oldurl;
    }

    // 将 数据库中的 systemconfig('site_domain') 替换为 env中的APP_URL
    public function replaceAllPic(){
        $olddomain = systemconfig('site_domain');

        foreach (\App\Models\ApiGame::get() as $item){
            $item->update([
                'web_pic' => $this->replaceNewDomain($item->web_pic,$olddomain),
                'mobile_pic' => $this->replaceNewDomain($item->mobile_pic,$olddomain),
                'logo_url' => $this->replaceNewDomain($item->logo_url,$olddomain)
            ]);
        }
        foreach (\App\Models\GameList::get() as $item){
            $item->update([
                'img_url' => $this->replaceNewDomain($item->img_url,$olddomain)
            ]);
        }
        foreach (\App\Models\Api::get() as $item){
            $item->update([
                'icon_url' => $this->replaceNewDomain($item->icon_url,$olddomain)
            ]);
        }

        foreach (\App\Models\GameHot::get() as $item){
            $item->update([
                'icon_path' => $this->replaceNewDomain($item->icon_path,$olddomain),
                'icon_path2' => $this->replaceNewDomain($item->icon_path2,$olddomain),
                'img_url' => $this->replaceNewDomain($item->img_url,$olddomain),
            ]);
        }

        foreach (\App\Models\Sport::get() as $item){
            $item->update([
                'home_team_img' => $this->replaceNewDomain($item->home_team_img, $olddomain),
                'visiting_team_img' => $this->replaceNewDomain($item->visiting_team_img, $olddomain)
            ]);
        }

        foreach (\App\Models\SystemNotice::get() as $item){
            $item->update([
                'content' => $this->replaceNewDomain($item->content, $olddomain),
            ]);
        }

        foreach(\App\Models\AsideAdv::get() as $item){
            $item->update([
                'pic_url' => $this->replaceNewDomain($item->pic_url,$olddomain)
            ]);
        }

        foreach (\App\Models\Activity::get() as $item){
            $item->update([
                'cover_image' => $this->replaceNewDomain($item->cover_image,$olddomain),
                'hall_image' => $this->replaceNewDomain($item->hall_image,$olddomain),
                'apply_url' => $this->replaceNewDomain($item->apply_url,$olddomain),

                // 富文本
                // content,apply_desc,rule_content
                'content' => $this->replaceNewDomain($item->content,$olddomain),
                'apply_desc' => $this->replaceNewDomain($item->apply_desc,$olddomain),
                'rule_content' => $this->replaceNewDomain($item->rule_content,$olddomain),
            ]);
        }

        foreach (\App\Models\Banner::get() as $item){
            $item->update([
                'url' => $this->replaceNewDomain($item->url,$olddomain)
            ]);
        }

        foreach (Attachment::get() as $item){
            $item->update([
                'domain' => $this->replaceNewDomain($item->domain,$olddomain)
            ]);
        }

        foreach (Payment::where('qrcode','!=','')->get() as $item){
            $item->update([
                'qrcode' => $this->replaceNewDomain($item->qrcode,$olddomain)
            ]);
        }

        foreach (SystemConfig::whereIn('type',[
            SystemConfig::CONFIG_TYPE_FILE,
            SystemConfig::CONFIG_TYPE_PICTURE,
            SystemConfig::CONFIG_TYPE_EDITOR,
            SystemConfig::CONFIG_TYPE_TEXT])->get() as $item){
            $item->update([
                'value' => $this->replaceNewDomain($item->value,$olddomain)
            ]);
        }
    }

    public function makeFakeGameRecord($member_id,$api_code){
        $member = \App\Models\Member::find($member_id);

        $data = [
            'billno' => getBillNo(),
            'member_id' => $member->id,
            'name' => $member->name,
            'playerName' => $member->name,
            'api_name' => $api_code,
            'betTime' => Carbon::now()->subMinutes(random_int(1,99)),
            'status' => \Arr::random(array_keys(config('platform.gamerecord_status'))),
            'betAmount' => floatval(sprintf("%.2f",random_int(10,499))),
            'gameType' => \Arr::random(array_keys(config('platform.game_type'))),
            'playDetail' => '测试游戏记录',
        ];

        if($data['status'] == GameRecord::STATUS_COMPLETE){
            $data['validBetAmount'] = $data['betAmount'];
            $data['netAmount'] = \Arr::random([0,$data['betAmount']]);
            $data['netAmount'] = floatval(sprintf("%.2f",$data['netAmount']));
        }else{
            $data['validBetAmount'] = 0;
            $data['netAmount'] = 0;
        }
        return $data;
    }

    /**
     * @param member_id 会员id
     * @param api_code 接口标识
     * app(\App\Services\GameService::class)->makeBatchFakeGameRecord(37,'AG');
     */
    public function makeBatchFakeGameRecord($member_id,$api_code){
        $times = 5;
        for($i = 0;$i < $times;$i++){
            // array_push($data,$this->makeFakeGameRecord($member_id,$api_code));
            GameRecord::create($this->makeFakeGameRecord($member_id,$api_code));
        }
        return '成功创建【'.$api_code.'】接口五条游戏记录';
    }

    const SUM_PREFIX = 'SUM_';
    const SUM_DAY = 7; // 默认整合七天前的游戏记录

    // 将会员N天前的游戏记录整合为一条
    // app(\App\Services\GameService::class)->convertSumGameRecord(2)
    public function convertSumGameRecord($member_id){
        // 查询当前会员最早一条非整合的游戏记录
        $record = GameRecord::where('member_id',$member_id)
            ->where('billNo','not like',self::SUM_PREFIX.'%')
            ->where('betTime','<',date('Y-m-d 00:00:00',time() - (self::SUM_DAY - 1)*86400))
            ->orderByDesc('betTime')->first();

        if(!$record) return;

        $betTimeStamp = strtotime($record->betTime);
        $start_at = date('Y-m-d 00:00:00',$betTimeStamp);
        $end_at = date('Y-m-d 00:00:00',$betTimeStamp + 24*3600);

        $records = GameRecord::where('member_id',$member_id)
            ->where('billNo','not like',self::SUM_PREFIX.'%')
            ->whereBetween('betTime',[$start_at,$end_at])->limit(5000)->get();

        $valid_records = $records->where('status',GameRecord::STATUS_COMPLETE);

        $api_names = array_values(array_unique($records->pluck('api_name')->toArray()));

        foreach ($api_names as $api_name){
            $billNo = self::SUM_PREFIX.$api_name.'_'.$record->name.'_'.date('Ymd',$betTimeStamp);

            $betAmount = $valid_records->where('api_name',$api_name)->sum('betAmount');
            $validBetAmount = $valid_records->where('api_name',$api_name)->sum('validBetAmount');
            $netAmount = $valid_records->where('api_name',$api_name)->sum('netAmount');

            $mod = GameRecord::where('billNo',$billNo)->first();

            if($validBetAmount){
               if($mod){
                   $mod->update([
                       'betAmount' => $betAmount + $mod->betAmount,
                       'validBetAmount' => $validBetAmount  + $mod->validBetAmount,
                       'netAmount' => $netAmount  + $mod->netAmount,
                   ]);
               } else{
                   // 创建统计记录
                   GameRecord::create([
                       'billNo' => $billNo,
                       'api_name' => $api_name,
                       'member_id' => $member_id,
                       'name' => $record->name,
                       'playerName' => $record->playerName,
                       'betAmount' => $betAmount,
                       'validBetAmount' => $validBetAmount,
                       'netAmount' => $netAmount,
                       'status' => GameRecord::STATUS_COMPLETE,
                       'playDetail' => 'Game Record Sum - '.date('Y-m-d',$betTimeStamp),
                       'betTime' => date('Y-m-d 12:00:00',$betTimeStamp),
                       'is_fs' => 1,
                       'is_fd' => 1,
                       'is_ml_use' => 1
                   ]);
               }

                // 删除游戏记录
                GameRecord::whereIn('id',$records->pluck('id'))->where('api_name',$api_name)->delete();
            }
        }
    }
}