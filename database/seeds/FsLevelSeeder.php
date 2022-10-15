<?php

use Illuminate\Database\Seeder;

//php artisan db:seed --class=FsLevelSeeder
class FsLevelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // fs levels
        $fs_levels = [
            [
                "level" => 1,
                "name" => "Thành viên một sao",
                "quota" => 10.00,
                "rate" => 0.10,
            ],
            [
                "level" => 2,
                "name" => "Thành viên hai sao",
                "quota" => 100.00,
                "rate" => 0.20,
            ],
            [
                "level" => 3,
                "name" => "Thành viên ba sao",
                "quota" => 1000.00,
                "rate" => 0.30,
            ]
        ];

        $data = [];
        foreach ($fs_levels as $item){
            foreach (config('platform.game_type') as $key => $value){
                $item['game_type'] = $key;
                $data[] = $item;
            }
        }


        foreach ($data as $item) \App\Models\FsLevel::create($item);


        $yjlevels = [
            [
                "level" => 1,
                "name" => "一级",
                "active_num" => 1,
                "min" => 10.00,
                "rate" => 10.00,
            ],
            [
                "level" => 2,
                "name" => "二级",
                "active_num" => 1,
                "min" => 200.00,
                "rate" => 15.00,
            ],
            [
                "level" => 3,
                "name" => "三级",
                "active_num" => 1,
                "min" => 2000.00,
                "rate" => 20.00,
            ]
        ];

        foreach ($yjlevels as $item) \App\Models\YjLevel::create($item);

        // agent fd rates
        $rates = [
            ['type' => 1,'rate' => 6.00],
            ['type' => 2,'rate' => 1.00],
            ['type' => 1,'rate' => 6.00]
        ];

        $fdrates = [];
        foreach ($fdrates as $item){
            foreach (config('platform.game_type') as $key => $value){
                $item['game_type'] = $key;
                $data[] = $item;
            }
        }

        foreach ($fdrates as $item) \App\Models\AgentFdRate::create($item);

    }
}
