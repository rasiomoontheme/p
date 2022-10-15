<?php

use App\Models\User;
use Illuminate\Database\Seeder;

// php artisan db:seed --class=UsersTableSeeder
class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = factory(User::class)->times(10)->make();
        User::insert($users->makeVisible(['password'])->toArray());

        // 单独处理第一个用户
        $user = User::find(1);
        $user->name = 'admin';
        $user->status = '1';
        $user->save();

        $user2 = User::find(2);
        $user2->name = 'test02';
        $user2->status = '1';
        $user2->save();
    }
}
