<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
// use Illuminate\Database\Eloquent\Model\DateTimeInterface;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Route;
use Spatie\Permission\Models\Permission as Base;

class Permission extends Base
{
    protected $cast = [
        "is_show" => "boolean"
    ];

    public $hidden = ['lang_json'];

    const TYPE_SHOW = 1;
    const TYPE_NOT_SHOW = 0;

    public static $isShowMap = [
        self::TYPE_SHOW => 'Hiển thị',
        self::TYPE_NOT_SHOW => 'Không hiển thị'
    ];

    public static $list_field = [
        'id' => 'ID',
        'name' => 'Tên quyền',
        'icon' => 'Biểu tượng',
        'pid' => 'ID cha mẹ',
        'route_name' => 'Tên tuyến đường',
        'weight' => 'Trọng lượng',
        'description' => 'Mô tả',
        'remark' => 'Nhận xét',
        'created_at' => 'Tạo mới lúc',
        'updated_at' => 'Cập nhật lúc'
    ];

    public function parent()
    {
        return $this->belongsTo(Permission::class, 'pid');
    }

    public function children()
    {
        return $this->hasMany(Permission::class, 'pid');
    }

    public function getLangJsonArrAttribute(){
        return json_decode($this->lang_json,1);
    }

    public function scopeGetByRouteName($query, $name)
    {
        return $query->where('route_name', $name);
    }

    public function scopeGuard($query, $guard)
    {
        return $query->where('guard_name', $guard);
    }

    /**
     * 判断权限是否有pid
     * @param $model
     * @return bool
     */
    public function isModelHasPid($model)
    {
        return !(is_null($model->pid) || $model->pid == 0);
    }

    protected function serializeDate(\DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }

    public function isItemShow(){
        if(!$this->remark || !\Str::contains($this->remark,'=')) return true;

        $arr = explode('=',$this->remark);

        return systemconfig($arr[0]) == $arr[1];
    }

    public function getLangName($lang = ''){
        return Arr::get($this->lang_json_arr,$lang ? $lang : app()->getLocale(),$this->name);
    }

    public static function getRouteTitle(){
        $mod = Permission::where('route_name',Route::currentRouteName())->orderByDesc('level')->first();
        return $mod ? $mod->getLangName() : '';
    }
}
