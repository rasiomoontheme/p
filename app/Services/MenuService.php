<?php

namespace App\Services;

use App\Exceptions\InvalidRequestException;
use App\Models\Base;
use App\Models\SystemConfig;
use Exception;
use Illuminate\Support\Arr;
use App\Models\Permission;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;
use sqhlib\Hanzi\HanziConvert;

class MenuService{
    
    public static function getModelSelectHtml($col,$id=0,$pid=0,$level=0){
        $menu_arr = MenuService::menuTree($col->toArray(),$pid,$level);
        return MenuService::getSelectMenuHtml($menu_arr,$id);
    }

    /**
     * 格式化菜单列表数据
     * @param array $arr
     * @param int $pid
     * @param int $level
     * @return array
     */
    public static function menuTree($arr,$pid = 0,$level = 0){
        static $res = array();
        foreach ($arr as $v){
            if($v['pid'] == $pid){
                $v['level'] = $level;
                $res[] = $v;
                self::menuTree($arr,$v['id'],$level+1);
            }
        }
        return $res;
    }

    /**
     * 获取格式化后的菜单 html代码
     * @param $list
     * @param int $id
     * @return string
     */
    public static function getSelectMenuHtml($list, $id = 0){
        $str = '';
        foreach($list as $row) {
            $select = '';
            if($id==$row['id']){
                $select = "selected";
            }
            $str .= '<option value="' . $row['id'] . '"' . $select . '>' .
                str_repeat('&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;', $row['level']) . Arr::get($row['lang_json_arr'],app()->getLocale(),$row['name']) .
                '</option>';
        }
        return $str;
    }

    // app(App\Services\MenuService::class)->getFormatterPermissionList("web")
    public function getFormatterPermissionList($guard_name = "web"){
        $config = config('admin_menu');
        $data = [];
        $id = 1;

        foreach ($config as $k => $v){
            // 第一层 level = 0
            $parent = $this->fillMenuData(Arr::except($v,'child'),$id,null,$guard_name);
            array_push($data,$parent);
            $id++;

            if(isset($v['child']) && count($v['child']) > 0){
                foreach ($v['child'] as $ke => $va){
                    $parent1 = $this->fillMenuData(Arr::except($va,'child'),$id,$parent,$guard_name);
                    array_push($data,$parent1);
                    $id++;

                    if(isset($va['child']) && count($va['child']) > 0){
                        foreach ($va['child'] as $key => $val){
                            $parent2 = $this->fillMenuData(Arr::except($val,'child'),$id,$parent1,$guard_name);
                            array_push($data,$parent2);
                            $id++;
                        }
                    }
                }
            }
        }

        return $data;
    }

    // 更新 菜单 和 权限
    // app(App\Services\MenuService::class)->updateMenuAndPermission()
    public function updateMenuAndPermission(){
        app()['cache']->forget('spatie.permission.cache');
        // 删除全部权限数据
        Permission::where('id','>',0)->delete();
        DB::update("ALTER TABLE permissions AUTO_INCREMENT = 0;");

        $data = $this->getFormatterPermissionList("web");
        foreach ($data as $item){
            /**
            if(!Arr::get($item,'route_name')){
                Permission::create($item);
            }
            else if($permission = Permission::where('route_name',$item['route_name'])->first()){
                unset($item['name']);
                $permission->update($item);
            }else{
                Permission::create($item);
            }**/
            Permission::create($item);
        }

        $role = Role::find(1);
        $role->syncPermissions(Permission::all()->pluck('id')->toArray());
    }

    public function fillMenuData($arr,$id,$parent = null,$guard_name = 'web'){
        $arr['id'] = $id;
        $arr['guard_name'] = $guard_name;

        if(is_array($parent)){
            $arr['level'] = $parent['level'] + 1;
            $arr['path'] = $parent['path'].$parent['id'].'-';
            $arr['pid'] = $parent['id'];
        }else{
            $arr['level'] = 0;
            $arr['path'] = '-';
        }

        if(isset($arr['pid']) && isset($arr['route_name'])){
            //echo $arr['alias'];
            $this->validateRouteName($arr['route_name']);
        }

        //$arr['is_show'] = $arr['level'] > 1?0:1;
        if(!array_key_exists("is_show",$arr)) $arr['is_show'] = $arr['level'] > 1?false:true;
        $arr['weight'] = $id;

        $temp = [
            'zh_cn' => $arr['name'],
            'zh_hk' => HanziConvert::convert($arr['name'],true),
            // 'en' => Arr::get(config('admin_menu_langs')['en'],$arr['name'],''),
        ];

        foreach (config('platform.lang_select') as $key => $lang){
            if(Arr::get(config('admin_menu_langs'),$key) && Arr::get(config('admin_menu_langs')[$key],$arr['name'])){
                $temp[$key] = Arr::get(config('admin_menu_langs')[$key],$arr['name']);
            }
        }

        $arr['lang_json'] = json_encode($temp,320);

        return $arr;
    }

    public function validateRouteName($route_name){
        $route = app('routes')->getByName($route_name);
        if(!$route) throw new InvalidRequestException("route_name 【".$route_name."】不存在");
    }

    // 获取当前用户的顶级菜单
    // app(App\Services\MenuService::class)->getMenuByGuard("web")
    public function getPermissionsByGuard($guard = "web"){
        $permission_ids = request()->user($guard)
            ->getPermissionsViaRoles()
            ->where("is_show",true)
            ->where("guard_name",$guard)
            ->where("level",0)->pluck('id');
         
            //->all();
            // dd($data->pluck("name"));
        if(!$permission_ids) throw new InvalidRequestException("请联系管理员分配权限");
        $data = Permission::whereIn('id',$permission_ids)->get();
        return $data;   
    }

    // 获取所有的顶级菜单
    public function getFirstLevelPermission($guard = "web"){
        return Permission::where("is_show",true)
            ->where("guard_name",$guard)
            ->where("level",0)
            ->orderBy("weight")
            ->get();
    }


    public function listFolderFiles($folder, $arr = []){
        //1、首先先读取文件夹
        $temp=scandir($folder);dd($temp);
        //遍历文件夹
        foreach($temp as $v){
            $a=$folder.'/'.$v;
            if(is_dir($a)){//如果是文件夹则执行

                if($v=='.' || $v=='..'){//判断是否为系统隐藏的文件.和..  如果是则跳过否则就继续往下走，防止无限循环再这里。
                    continue;
                }
                echo "<font color='red'>$a</font>","<br/>"; //把文件夹红名输出

                $this->listFolderFiles($a);//因为是文件夹所以再次调用自己这个函数，把这个文件夹下的文件遍历出来
            }else{
                echo $a,"<br/>";
            }

        }
    }

    // app(App\Services\MenuService::class)->checkUploadsFolder();
    public function checkUploadsFolder(){
        // 如果文件夹不存在，则需要创建，可能会提示需要权限
        if(!file_exists(public_path('storage\uploads'))){
            Artisan::call('storage:link');
        }
    }

    // 更新 SystemConfig为多语言版本
    // app(App\Services\MenuService::class)->makeConfigLangs();
    public function makeConfigLangs(){
        $data = SystemConfig::MULTI_LANGS_ARR;

        try{
            DB::transaction(function() use($data) {
                $list = SystemConfig::whereIn('name',$data)->whereIn('lang',[Base::LANG_COMMON,Base::LANG_CN])->get();
                foreach ($list as $item){
                    foreach (config('platform.lang_fields') as $lang => $v){
                        // 判断该语言的配置是否存在
                        if($list->where('name',$item->name)->where('lang',$lang)->first()) continue;

                        SystemConfig::create($item->copyConfig($lang));
                    }
                }

                // 删除common
                SystemConfig::whereIn('name',$data)->where('lang',Base::LANG_COMMON)->delete();
            });
        }catch (\Exception $e){
            DB::rollBack();
            exit('错误：'.$e->getMessage());
        }

    }

    // app(App\Services\MenuService::class)->outputLangArray();
    public function outputLangArray(){
        foreach (trans('res') as $item){
            foreach ($item as $k => $v){
                if(is_array($v)){
                    foreach ($v as $key => $val){
                        if(!is_array($val)) echo $val.PHP_EOL;
                    }
                }else {
                    echo $v.PHP_EOL;
                }
            }
        }
    }

    // app(App\Services\MenuService::class)->updateEnPermissionEnTitle()
    public function updateEnPermissionEnTitle(){
        $list = Permission::where('id',18)->get();
        foreach ($list as $item){
            $json = $item->lang_json;
            $arr = json_decode($json,1);

            /**
            if(!array_key_exists('en',$arr)) {
                $arr['en'] = gtranslate($item->name);
                echo $item->name.' -> en:'.$arr['en'].PHP_EOL;
                sleep(0.5);
                if(!$arr['en']) continue;
                $item->update(['lang_json' => json_encode($arr,JSON_UNESCAPED_UNICODE)]);
            }
            **/

            $item->update(['lang_json' => json_encode($arr,JSON_UNESCAPED_UNICODE)]);
        }
    }

    // app(App\Services\MenuService::class)->getPermissionEnNames()
    public function getPermissionEnNames(){
        $data = Permission::get();
        foreach ($data as $item){
            echo '"'.$item->name.'" => "'.$item->getLangName('en').'",<br>';
        }
    }

    // 在网页中，按照PHP代码的格式输出数组
    public function printPhpArrayToHtml($data,$root = 0){
        if($root == 0){
            echo '<pre>';
        }

        if(is_array($data)){
            echo str_repeat('&#9',$root).'[<br>';

            foreach ($data as $key => $val){

                if(!is_string($key)){
                    if(is_array($val)){
                        self::print_submenu($val,$root+1);
                    }else{
                        echo str_repeat('&#9',$root+1)."'{$key}' => ";
                        self::print_submenu($val,$root+1);
                    }
                }else{
                    if(is_array($val)){
                        echo str_repeat('&#9',$root+1)."'{$key}' => <br>"; // [
                        self::print_submenu($val,$root+1);
                    }else{
                        echo str_repeat('&#9',$root+1)."'{$key}' => ";
                        self::print_submenu($val,$root+1);
                 }
                }
            }

            echo str_repeat('&#9',$root).'],<br>';
        }else{
            echo "'{$data}',<br>";
        }

        if($root == 0){
            echo '</pre>';
        }
    }
}