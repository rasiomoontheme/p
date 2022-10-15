<?php

use App\Models\Api;
use Illuminate\Database\Seeder;

// php artisan db:seed --class=ApiSeeder
class ApiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        /**
        $data = [
            [
                'api_name' => 'AG',
                'api_title' => 'AG',
            ],

            [
                'api_name' => 'MG',
                'api_title' => 'MG',
            ],
            [
                'api_name' => 'JDB',
                'api_title' => 'JDB',
            ],
            [
                'api_name' => 'BBIN',
                'api_title' => 'BBIN',
            ],
        ];
        **/

        $data = [
            ['id' => '1','api_title' => 'AG','api_name' => 'AG','is_open' => '1',],
            ['id' => '2','api_title' => 'MG','api_name' => 'FMG','is_open' => '1',],
            ['id' => '3','api_title' => 'JDB','api_name' => 'JDB','is_open' => '1',],
            ['id' => '4','api_title' => 'BBIN','api_name' => 'NEWBBIN','is_open' => '1',],
            ['id' => '5','api_title' => 'IGLottery','api_name' => 'IG','is_open' => '1',],
            ['id' => '6','api_title' => '欧博视讯','api_name' => 'AB','is_open' => '1',],
            ['id' => '7','api_title' => 'OG真人','api_name' => 'OG','is_open' => '1',],
            ['id' => '8','api_title' => '三昇体育','api_name' => 'SS','is_open' => '1',],
            ['id' => '9','api_title' => 'VR彩票','api_name' => 'VR','is_open' => '1',],
            ['id' => '10','api_title' => 'KY棋牌','api_name' => 'KY','is_open' => '1',],
            ['id' => '11','api_title' => 'IM体育','api_name' => 'IMSPORT','is_open' => '1',],
            ['id' => '12','api_title' => 'SABA体育','api_name' => 'SABA','is_open' => '1',],
            ['id' => '13','api_title' => 'MT','api_name' => 'MT','is_open' => '1',],
            ['id' => '14','api_title' => 'BG真人','api_name' => 'BG','is_open' => '1',],
            ['id' => '15','api_title' => 'LEYOU棋牌','api_name' => 'LEYOU','is_open' => '1',],
            ['id' => '16','api_title' => 'FASTBET体育','api_name' => 'FASTBET','is_open' => '1',],
            ['id' => '17','api_title' => 'PT电子','api_name' => 'IMPT','is_open' => '1',],
            ['id' => '18','api_title' => 'IM电子','api_name' => 'IMSLOT','is_open' => '1',],
            ['id' => '19','api_title' => 'PG电子','api_name' => 'PG','is_open' => '1',],
            ['id' => '20','api_title' => 'CQ9','api_name' => 'CQ9','is_open' => '1',],
            ['id' => '21','api_title' => 'ISB电子','api_name' => 'ISB','is_open' => '1',],
            ['id' => '22','api_title' => 'VG棋牌','api_name' => 'VG','is_open' => '1',],
            ['id' => '23','api_title' => 'BOLE棋牌','api_name' => 'BOLE','is_open' => '1',],
            ['id' => '24','api_title' => 'NWG棋牌','api_name' => 'NWG','is_open' => '1',],
            ['id' => '25','api_title' => 'LH体育','api_name' => 'LH','is_open' => '1',],
            ['id' => '26','api_title' => 'RTG电子','api_name' => 'RTG','is_open' => '1',],
            ['id' => '27','api_title' => 'MV电子','api_name' => 'MV','is_open' => '1',],
            ['id' => '28','api_title' => 'PLAYSTAR','api_name' => 'PLAYSTAR','is_open' => '1',],
            ['id' => '29','api_title' => 'GD真人','api_name' => 'GD','is_open' => '1',],
            ['id' => '30','api_title' => 'LG棋牌','api_name' => 'LG','is_open' => '1',],
            ['id' => '31','api_title' => 'TTG电子','api_name' => 'TTG','is_open' => '1',],
            ['id' => '32','api_title' => 'PNG电子','api_name' => 'PNG','is_open' => '1',],
            ['id' => '33','api_title' => 'HB电子','api_name' => 'HB','is_open' => '1',],
            ['id' => '34','api_title' => 'GG电子','api_name' => 'GG','is_open' => '1'],
            ['id' => '35','api_title' => 'RG棋牌','api_name' => 'RG','is_open' => '1'],
            ['id' => '36','api_title' => 'EBET真人','api_name' => 'EBET','is_open' => '1']
        ];

        foreach($data as $item){
            Api::create($item);
        }
    }
}
