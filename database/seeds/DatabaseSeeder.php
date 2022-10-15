<?php

use App\Models\GameList;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;
/***
 * php artisan db:seed
 * php artisan migrate:refresh --seed
*/
class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // 清空上传目录的文件
        //Storage::disk('public')->deleteDirectory('uploads');

        // 直接删除 public/storage 文件夹，然后执行命令php artisan storage:link

        $this->call(UsersTableSeeder::class);
        $this->call(PermissionsTablesSeeder::class);
        $this->call(MemberSeeder::class);

        $this->call(SystemNoticeSeeder::class);
        $this->call(AboutSeeder::class);
        $this->call(ActivitySeeder::class);

        $this->call(SystemConfigSeeder::class);
        $this->call(ApiSeeder::class);
        $this->call(ApiGameSeeder::class);

        $this->call(TaskSeeder::class);

        $this->call(FsLevelSeeder::class);
        $this->call(AgentFdRateSeeder::class);

        //$this->call(GameListSeeder::class);
        $this->call(BankSeeder::class);
    }
}
