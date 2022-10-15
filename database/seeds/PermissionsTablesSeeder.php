<?php

use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Artisan;

// php artisan db:seed --class=PermissionsTablesSeeder
class PermissionsTablesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // 清除缓存
        app()['cache']->forget('spatie.permission.cache');
        // php artisan cache:forget spatie.permission.cache
        // Artisan::call("cache:forget spatie.permission.cache");
        // cache()->flush();

        // 创建权限和角色时，需要带上 guard_name 参数，否则默认是 web
        // return;
        // 后台权限菜单
        $permissions = app(\App\Services\MenuService::class)->getFormatterPermissionList("web");

        foreach ($permissions as $key =>  $item) {
            //echo $item['name'];
            Permission::create($item);
        }

        Role::create([
            'id' => 1,
            'name' => '超级管理员',
            'guard_name' => 'web',
            'description' => '后台超级管理员'
        ]);

        Role::create([
            'id' => 2,
            'name' => '管理员',
            'guard_name' => 'web',
            'description' => '系统管理员'
        ]);

        Role::create([
            'id' => 3,
            'name' => '测试角色',
            'guard_name' => 'web',
            'description' => '测试'
        ]);

        $user = User::find(1);
        //$user->roles()->attach(1);

        $role = Role::find(1);
        
        $role->syncPermissions(Permission::all()->pluck('id')->toArray());
        $user->assignRole($role);

    }
}
