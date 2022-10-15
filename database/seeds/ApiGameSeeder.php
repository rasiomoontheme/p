<?php

use App\Models\ApiGame;
use Illuminate\Database\Seeder;

// php artisan db:seed --class=ApiGameSeeder
class ApiGameSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //$data = factory(ApiGame::class)->times(20)->make();
        /**
        $api_games = array(
            array(
                "id" => 6,
                "title" => "BBIN真人",
                "subtitle" => "Voluptatem eos amet.",
                "web_pic" => "https://cdn.igsttech.com/Multimedia/Navigation/Mobile/Term/BbVideo.png",
                "mobile_pic" => "https://cdn.igsttech.com/Multimedia/Navigation/Mobile/Term/BbVideo.png",
                "api_name" => "BBIN",
                "game_type" => 1,
                "params" => "{\"game_code\":\"TS001\"}",
                "is_open" => 1,
                "weight" => 98,
                "tags" => "hot,recommend",
                "remark" => "",
                "created_at" => NULL,
                "updated_at" => "2020-03-30 21:38:54",
            ),
            array(
                "id" => 20,
                "title" => "AG真人",
                "subtitle" => "Voluptatibus consequatur.",
                "web_pic" => "https://cdn.igsttech.com/Multimedia/Navigation/Mobile/Term/AgBr.png",
                "mobile_pic" => "https://cdn.igsttech.com/Multimedia/Navigation/Mobile/Term/AgBr.png",
                "api_name" => "AG",
                "game_type" => 1,
                "params" => "",
                "is_open" => 1,
                "weight" => 51,
                "tags" => "hot",
                "remark" => "",
                "created_at" => NULL,
                "updated_at" => "2020-03-30 20:51:35",
            ),
            array(
                "id" => 21,
                "title" => "MG电子",
                "subtitle" => "",
                "web_pic" => "https://cdn.igsttech.com/Multimedia/Navigation/Mobile/Term/MgReal.png",
                "mobile_pic" => "https://cdn.igsttech.com/Multimedia/Navigation/Mobile/Term/MgReal.png",
                "api_name" => "MG",
                "game_type" => 3,
                "params" => "",
                "is_open" => 1,
                "weight" => 10,
                "tags" => "",
                "remark" => "",
                "created_at" => "2020-03-30 20:21:36",
                "updated_at" => "2020-03-30 20:52:10",
            ),

            array(
                "id" => 23,
                "title" => "IG官方彩",
                "subtitle" => "",
                "web_pic" => "",
                "mobile_pic" => "",
                "api_name" => "IG",
                "class_name" => "ig6",
                "game_type" => 4,
                "params" => "{\"gameType\":\"GFC\"}",
                "is_open" => 1,
                "weight" => 10,
                "tags" => "",
                "remark" => "",
                "created_at" => "2020-06-28 19:10:21",
                "updated_at" => "2020-06-28 22:54:49",
            ),
        );
        **/

        $apigames = [
            ['id' => '23','title' => 'IG官方彩','mobile_pic' => env('APP_URL').'/storage/uploads/api_game/202007/27/api_game_1595852718_fTRbE9Jbjn.png','api_name' => 'IG','class_name' => 'ig6','game_type' => '4','params' => '{"gameType":"GFC"}','tags' => 'hot','is_open' => '1',],
            ['id' => '24','title' => 'IG时时彩','mobile_pic' => env('APP_URL').'/storage/uploads/api_game/202007/27/api_game_1595852697_EqiMDjmCXY.png','api_name' => 'IG','game_type' => '4','params' => '{"gameType":"LOTTERY"}','tags' => 'hot','is_open' => '1',],
            ['id' => '25','title' => 'AG寰亚厅','mobile_pic' => env('APP_URL').'/storage/uploads/api_game/202007/28/api_game_1595943231_jpl5AoNcKp.png','api_name' => 'AG','game_type' => '1','params' => '{"gameCode":1}','tags' => 'hot','is_open' => '1',],
            ['id' => '26','title' => 'BBIN旗舰厅','mobile_pic' => env('APP_URL').'/storage/uploads/api_game/202007/28/api_game_1595943353_PlB37TxdUq.png','api_name' => 'NEWBBIN','class_name' => 'bb','game_type' => '1','params' => '{"gameType":"Live"}','tags' => 'hot','is_open' => '1',],
            ['id' => '27','title' => 'BBIN捕鱼达人','web_pic' => env('APP_URL').'/storage/uploads/api_game/202007/07/api_game_1594090779_r28wdgR8Gs.png','mobile_pic' => env('APP_URL').'/storage/uploads/api_game/202007/28/api_game_1595943501_RqHO7GTi2i.png','api_name' => 'NEWBBIN','class_name' => 'bbdr','game_type' => '2','params' => '{"gameType":30,"isSingle":1,"gameCode":"30599"}','tags' => 'hot,recommend,new','is_open' => '1',],
            ['id' => '28','title' => 'BBIN捕鱼达人2','web_pic' => env('APP_URL').'/storage/uploads/api_game/202007/07/api_game_1594090779_r28wdgR8Gs.png','mobile_pic' => env('APP_URL').'/storage/uploads/api_game/202007/28/api_game_1595943474_mXUidyh5Le.png','api_name' => 'NEWBBIN','class_name' => 'bbdr2','game_type' => '2','params' => '{"gameType":30,"isSingle":1,"gameCode":"30598"}','tags' => 'hot,recommend,new','is_open' => '1',],
            ['id' => '29','title' => 'BBIN捕鱼大师','web_pic' => env('APP_URL').'/storage/uploads/api_game/202007/07/api_game_1594090779_r28wdgR8Gs.png','mobile_pic' => env('APP_URL').'/storage/uploads/api_game/202007/28/api_game_1595943440_dbKRiSYpEB.png','api_name' => 'NEWBBIN','class_name' => 'bbds','game_type' => '2','params' => '{"gameType":38,"isSingle":1,"gameCode":"38001"}','tags' => 'hot,recommend,new','is_open' => '1',],
            ['id' => '30','title' => 'BBIN富贵渔场','web_pic' => env('APP_URL').'/storage/uploads/api_game/202007/07/api_game_1594090779_r28wdgR8Gs.png','mobile_pic' => env('APP_URL').'/storage/uploads/api_game/202007/28/api_game_1595943417_7u6F6WImpG.png','api_name' => 'NEWBBIN','class_name' => 'bbyc','game_type' => '2','params' => '{"gameType":30,"isSingle":1,"gameCode":"38002"}',],
            ['id' => '31','title' => '欧博尊爵厅','mobile_pic' => env('APP_URL').'/storage/uploads/api_game/202007/28/api_game_1595944433_0xMrbk2bl6.png','api_name' => 'AB','game_type' => '1','tags' => 'hot','is_open' => '1',],
            ['id' => '32','title' => 'OG东方厅','mobile_pic' => env('APP_URL').'/storage/uploads/api_game/202007/28/api_game_1595944288_vcQjLRXNVM.png','api_name' => 'OG','game_type' => '1','is_open' => '1',],
            ['id' => '33','title' => '皇冠体育','mobile_pic' => env('APP_URL').'/storage/uploads/api_game/202007/28/api_game_1595944652_MqzPE5CnVx.png','api_name' => 'SS','class_name' => 'ss','game_type' => '5','is_open' => '1',],
            ['id' => '34','title' => 'VR彩票','mobile_pic' => env('APP_URL').'/storage/uploads/api_game/202007/28/api_game_1595944781_KCsyMuxsaQ.png','api_name' => 'VR','game_type' => '4','params' => '{"gameCode":1}','tags' => 'hot','is_open' => '1',],
            ['id' => '35','title' => 'KY棋牌','mobile_pic' => env('APP_URL').'/storage/uploads/api_game/202007/28/api_game_1595942806_emHDoYshaf.png','api_name' => 'KY','game_type' => '6','tags' => 'hot','is_open' => '1',],
            ['id' => '36','title' => 'IM体育','mobile_pic' => env('APP_URL').'/storage/uploads/api_game/202007/28/api_game_1595944870_zZQU3nCflg.png','api_name' => 'IMSPORT','class_name' => 'im','game_type' => '5','tags' => 'hot','is_open' => '1',],
            ['id' => '37','title' => '沙巴体育','mobile_pic' => env('APP_URL').'/storage/uploads/api_game/202007/28/api_game_1595944707_Xrbxrqt32I.png','api_name' => 'SABA','game_type' => '5','tags' => 'hot','is_open' => '1',],
            ['id' => '38','title' => 'MT李逵劈鱼','web_pic' => env('APP_URL').'/storage/uploads/api_game/202007/07/api_game_1594090779_r28wdgR8Gs.png','mobile_pic' => env('APP_URL').'/storage/uploads/api_game/202007/28/api_game_1595945318_ckOnu4A7My.png','api_name' => 'MT','game_type' => '2','params' => '{"gameCode":"IMBG40024"}','tags' => 'hot,recommend,new','is_open' => '1',],
            ['id' => '39','title' => 'MT金蝉捕鱼','web_pic' => env('APP_URL').'/storage/uploads/api_game/202007/07/api_game_1594090779_r28wdgR8Gs.png','mobile_pic' => env('APP_URL').'/storage/uploads/api_game/202007/28/api_game_1595945287_gKVVl0M45r.png','api_name' => 'MT','game_type' => '2','params' => '{"gameCode":"IMBG40025"}','tags' => 'hot,recommend,new','is_open' => '1',],
            ['id' => '40','title' => 'BG视讯','mobile_pic' => env('APP_URL').'/storage/uploads/api_game/202007/28/api_game_1595944327_2DupQmtprn.png','api_name' => 'BG','game_type' => '1','params' => '{"gameType":"Live"}','is_open' => '1',],
            ['id' => '41','title' => 'BG捕鱼大师','web_pic' => env('APP_URL').'/storage/uploads/api_game/202007/07/api_game_1594090779_r28wdgR8Gs.png','mobile_pic' => env('APP_URL').'/storage/uploads/api_game/202007/28/api_game_1595944371_W4ZZzkBDvf.png','api_name' => 'BG','game_type' => '2','params' => '{"gameType":"Hunter"}','is_open' => '1',],
            ['id' => '42','title' => 'BB彩票','mobile_pic' => env('APP_URL').'/storage/uploads/api_game/202007/28/api_game_1595943353_PlB37TxdUq.png','api_name' => 'NEWBBIN','class_name' => 'bb','game_type' => '4','params' => '{"gameType":"Lottery"}','tags' => 'hot','is_open' => '1',],
            ['id' => '43','title' => 'BB体育','mobile_pic' => env('APP_URL').'/storage/uploads/api_game/202007/28/api_game_1595943353_PlB37TxdUq.png','api_name' => 'NEWBBIN','class_name' => 'bb','game_type' => '5','params' => '{"gameType":"Sport"}','tags' => 'hot','is_open' => '1',],
            ['id' => '44','title' => 'FASTBET体育','mobile_pic' => env('APP_URL').'/storage/uploads/api_game/202007/28/api_game_1595943082_RLDTsvsPaL.png','api_name' => 'FASTBET','game_type' => '5','is_open' => '1',],
            ['id' => '45','title' => 'AG捕鱼','web_pic' => env('APP_URL').'/storage/uploads/api_game/202007/07/api_game_1594090779_r28wdgR8Gs.png','mobile_pic' => env('APP_URL').'/storage/uploads/api_game/202007/27/api_game_1595849735_IjM8VxYTyX.png','api_name' => 'AG','game_type' => '2','params' => '{"gameCode":"HMPL"}','tags' => 'hot,recommend,new','is_open' => '1',],
            ['id' => '46','title' => 'JDB龙王捕鱼','web_pic' => env('APP_URL').'/storage/uploads/api_game/202007/07/api_game_1594090779_r28wdgR8Gs.png','mobile_pic' => env('APP_URL').'/storage/uploads/api_game/202007/28/api_game_1595943876_4OahQskzH2.png','api_name' => 'JDB','game_type' => '2','params' => '{"gameType":7,"gameCode":"7001"}','tags' => 'hot,recommend,new','is_open' => '1',],
            ['id' => '47','title' => 'JDB龙王捕鱼2','web_pic' => env('APP_URL').'/storage/uploads/api_game/202007/07/api_game_1594090779_r28wdgR8Gs.png','mobile_pic' => env('APP_URL').'/storage/uploads/api_game/202007/28/api_game_1595943851_p48rUQq7GV.png','api_name' => 'JDB','game_type' => '2','params' => '{"gameType":7,"gameCode":"7002"}','is_open' => '1',],
            ['id' => '48','title' => 'JDB财神捕鱼','web_pic' => env('APP_URL').'/storage/uploads/api_game/202007/07/api_game_1594090779_r28wdgR8Gs.png','mobile_pic' => env('APP_URL').'/storage/uploads/api_game/202007/28/api_game_1595943815_QFkmtEXFV1.png','api_name' => 'JDB','game_type' => '2','params' => '{"gameType":7,"gameCode":"7003"}','tags' => 'hot,recommend,new','is_open' => '1',],
            ['id' => '49','title' => 'JDB五龙捕魚','web_pic' => env('APP_URL').'/storage/uploads/api_game/202007/07/api_game_1594090779_r28wdgR8Gs.png','mobile_pic' => env('APP_URL').'/storage/uploads/api_game/202007/28/api_game_1595943792_9TfqXxoecy.png','api_name' => 'JDB','game_type' => '2','params' => '{"gameType":7,"gameCode":"7004"}','tags' => 'hot','is_open' => '1',],
            ['id' => '50','title' => 'JDB捕魚一路發','web_pic' => env('APP_URL').'/storage/uploads/api_game/202007/07/api_game_1594090779_r28wdgR8Gs.png','mobile_pic' => env('APP_URL').'/storage/uploads/api_game/202007/28/api_game_1595943610_vAfkAwC2wU.png','api_name' => 'JDB','game_type' => '2','params' => '{"gameType":7,"gameCode":"7005"}','is_open' => '1',],
            ['id' => '51','title' => 'AG电子','web_pic' => env('APP_URL').'/storage/uploads/api_game/202007/28/api_game_1595946129_qVGdyy4UGX.png','mobile_pic' => env('APP_URL').'/storage/uploads/api_game/202007/28/api_game_1595943231_jpl5AoNcKp.png','api_name' => 'AG','game_type' => '3','tags' => 'hot','is_open' => '1',],
            ['id' => '52','title' => 'JDB电子','web_pic' => env('APP_URL').'/storage/uploads/api_game/202007/28/api_game_1595946290_KN3tObIh7X.png','mobile_pic' => env('APP_URL').'/storage/uploads/api_game/202007/28/api_game_1595943560_ElXBX3DVmd.png','api_name' => 'JDB','game_type' => '3','tags' => 'hot','is_open' => '1',],
            ['id' => '53','title' => 'BB电子','web_pic' => env('APP_URL').'/storage/uploads/api_game/202007/28/api_game_1595946233_m5EA67h2d6.png','mobile_pic' => env('APP_URL').'/storage/uploads/api_game/202007/28/api_game_1595943353_PlB37TxdUq.png','api_name' => 'NEWBBIN','class_name' => 'bb','game_type' => '3','tags' => 'hot','is_open' => '1',],
            ['id' => '54','title' => 'PT电子','web_pic' => env('APP_URL').'/storage/uploads/api_game/202007/28/api_game_1595946327_1BWm93hOce.png','mobile_pic' => env('APP_URL').'/storage/uploads/api_game/202007/28/api_game_1595945096_RbqT1I53Lx.png','api_name' => 'IMPT','class_name' => 'pt','game_type' => '3','tags' => 'hot','is_open' => '1',],
            ['id' => '55','title' => 'IM电子','mobile_pic' => env('APP_URL').'/storage/uploads/api_game/202007/28/api_game_1595944870_zZQU3nCflg.png','api_name' => 'IMSLOT','class_name' => 'im','game_type' => '3','is_open' => '1',],
            ['id' => '56','title' => 'PG电子','web_pic' => env('APP_URL').'/storage/uploads/api_game/202007/28/api_game_1595946259_MXrj9TlmiY.png','mobile_pic' => env('APP_URL').'/storage/uploads/api_game/202007/28/api_game_1595945205_PLtDpGKcsR.gif','api_name' => 'PG','game_type' => '3','is_open' => '1',],
            ['id' => '57','title' => 'CQ9电子','web_pic' => env('APP_URL').'/storage/uploads/api_game/202007/28/api_game_1595946212_fGQEXdSHhn.png','mobile_pic' => env('APP_URL').'/storage/uploads/api_game/202007/28/api_game_1595945436_UfgFv9FQ5S.png','api_name' => 'CQ9','game_type' => '3','tags' => 'hot','is_open' => '1',],
            ['id' => '58','title' => 'CQ9水浒劈鱼','web_pic' => env('APP_URL').'/storage/uploads/api_game/202007/07/api_game_1594090779_r28wdgR8Gs.png','mobile_pic' => env('APP_URL').'/storage/uploads/api_game/202008/09/api_game_1596963897_xBWap8rWGD.png','api_name' => 'CQ9','game_type' => '2','params' => '{"gameCode":"CQ0313"}','tags' => 'hot','is_open' => '1',],
            ['id' => '59','title' => 'PS海底捞','web_pic' => env('APP_URL').'/storage/uploads/api_game/202007/07/api_game_1594090779_r28wdgR8Gs.png','mobile_pic' => env('APP_URL').'/storage/uploads/api_game/202008/09/api_game_1596963916_WL2sZilySh.png','api_name' => 'PLAYSTAR','game_type' => '2','params' => '{"gameCode":"PSF-ON-00001"}','is_open' => '1',],
            ['id' => '60','title' => 'PS麻辣捕鱼','web_pic' => env('APP_URL').'/storage/uploads/api_game/202007/07/api_game_1594090779_r28wdgR8Gs.png','mobile_pic' => env('APP_URL').'/storage/uploads/api_game/202008/09/api_game_1596963933_RIKWil1JsD.png','api_name' => 'PLAYSTAR','game_type' => '2','params' => '{"gameCode":"PSF-ON-00002"}','is_open' => '1',],
            ['id' => '62','title' => 'VG3D龙王捕鱼','web_pic' => env('APP_URL').'/storage/uploads/api_game/202007/07/api_game_1594090779_r28wdgR8Gs.png','mobile_pic' => env('APP_URL').'/storage/uploads/api_game/202007/27/api_game_1595850205_fd01kzXSjU.png','api_name' => 'VG','game_type' => '2','params' => '{"gameCode":"IMBG30028"}','is_open' => '1',],
            ['id' => '63','title' => 'VG棋牌','mobile_pic' => env('APP_URL').'/storage/uploads/api_game/202007/28/api_game_1595942827_yXBcqpoabB.png','api_name' => 'VG','game_type' => '6','tags' => 'hot','is_open' => '1',],
            ['id' => '64','title' => 'BOLE棋牌','mobile_pic' => env('APP_URL').'/storage/uploads/api_game/202007/28/api_game_1595942850_6UxCsQ6Rte.png','api_name' => 'BOLE','game_type' => '6','is_open' => '1',],
            ['id' => '65','title' => 'NWG棋牌','mobile_pic' => env('APP_URL').'/storage/uploads/api_game/202007/28/api_game_1595945496_pI1x5Rzd0M.gif','api_name' => 'NWG','game_type' => '6','is_open' => '1',],
            ['id' => '66','title' => 'LH体育','mobile_pic' => env('APP_URL').'/storage/uploads/api_game/202007/28/api_game_1595943103_MOtB4sBH0O.png','api_name' => 'LH','game_type' => '5','is_open' => '1',],
            ['id' => '67','title' => 'RTG电子','mobile_pic' => env('APP_URL').'/storage/uploads/api_game/202007/27/api_game_1595849676_SCmrz0DuZP.png','api_name' => 'RTG','game_type' => '3','is_open' => '1',],
            ['id' => '68','title' => 'MV电子','mobile_pic' => env('APP_URL').'/storage/uploads/api_game/202007/27/api_game_1595849528_Q9aY5otFVC.png','api_name' => 'MV','game_type' => '3','is_open' => '1',],
            ['id' => '69','title' => 'PS电子','mobile_pic' => env('APP_URL').'/storage/uploads/api_game/202007/27/api_game_1595848680_LhbrWE5qkr.png','api_name' => 'PLAYSTAR','game_type' => '3','is_open' => '1',],
            ['id' => '71','title' => 'GD奢华厅','mobile_pic' => env('APP_URL').'/storage/uploads/api_game/202007/28/api_game_1595944571_TkabbagfOV.png','api_name' => 'GD','game_type' => '1','is_open' => '1',],
            ['id' => '72','title' => 'LG棋牌','mobile_pic' => env('APP_URL').'/storage/uploads/api_game/202007/28/api_game_1595942873_3vHodIy4Dw.png','api_name' => 'LG','game_type' => '6','tags' => 'hot,recommend','is_open' => '1',],
            ['id' => '73','title' => 'CQ9欢乐捕鱼','web_pic' => env('APP_URL').'/storage/uploads/api_game/202007/07/api_game_1594090779_r28wdgR8Gs.png','mobile_pic' => env('APP_URL').'/storage/uploads/api_game/202008/09/api_game_1596963954_NnKRFJxifT.png','api_name' => 'CQ9','game_type' => '2','params' => '{"gameCode":"CQ0305"}','tags' => 'hot,recommend,new','is_open' => '1',],
            ['id' => '74','title' => 'CQ9雷电战机','web_pic' => env('APP_URL').'/storage/uploads/api_game/202007/07/api_game_1594090779_r28wdgR8Gs.png','mobile_pic' => env('APP_URL').'/storage/uploads/api_game/202008/09/api_game_1596963972_yezcDPNS7a.png','api_name' => 'CQ9','game_type' => '2','params' => '{"gameCode":"CQ0301"}','tags' => 'hot,recommend,new','is_open' => '1',],
            ['id' => '76','title' => 'CQ9皇金渔场2','web_pic' => env('APP_URL').'/storage/uploads/api_game/202007/07/api_game_1594090779_r28wdgR8Gs.png','mobile_pic' => env('APP_URL').'/storage/uploads/api_game/202008/09/api_game_1596963999_RKx4cooUQN.png','api_name' => 'CQ9','game_type' => '2','params' => '{"gameCode":"CQ0158"}','is_open' => '1',],
            ['id' => '77','title' => 'TTG电子','mobile_pic' => env('APP_URL').'/storage/uploads/api_game/202007/27/api_game_1595846467_udnG8hlOqY.png','api_name' => 'TTG','game_type' => '3','is_open' => '1',],
            ['id' => '78','title' => 'PNG电子','mobile_pic' => env('APP_URL').'/storage/uploads/api_game/202007/27/api_game_1595848632_NLgIjZSWpi.png','api_name' => 'PNG','game_type' => '3','tags' => 'hot','is_open' => '1',],
            ['id' => '79','title' => 'HB电子','mobile_pic' => env('APP_URL').'/storage/uploads/api_game/202007/27/api_game_1595846576_YxVgPMX5kg.png','api_name' => 'HB','game_type' => '3','is_open' => '1',],
            ['id' => '80','title' => 'ISB电子','web_pic' => env('APP_URL').'/storage/uploads/api_game/202007/27/api_game_1595847119_vEZN7EvWI9.png','mobile_pic' => env('APP_URL').'/storage/uploads/api_game/202007/27/api_game_1595847119_vEZN7EvWI9.png','api_name' => 'ISB','game_type' => '3','is_open' => '1',],
            ['id' => '81','title' => 'MG电子','web_pic' => env('APP_URL').'/storage/uploads/api_game/202007/28/api_game_1595946180_0q8t6lisym.png','mobile_pic' => env('APP_URL').'/storage/uploads/api_game/202007/28/api_game_1595943927_k0RwxHT3r8.png','api_name' => 'FMG','class_name' => 'mg','game_type' => '3','tags' => 'hot','is_open' => '1',],
            ['id' => '82','title' => 'LEYOU棋牌','mobile_pic' => env('APP_URL').'/storage/uploads/api_game/202007/28/api_game_1595942899_AxXxdCS5R8.png','api_name' => 'LEYOU','game_type' => '6','params' => '{"gameCode":0}','is_open' => '1',],
            ['id' => '83','title' => 'MT棋牌','mobile_pic' => env('APP_URL').'/storage/uploads/api_game/202007/28/api_game_1595946812_MogDM7SCnA.png','api_name' => 'MT','game_type' => '6','params' => '{"gameCode":"IMBG40001"}','is_open' => '1',],
            ['id' => '84','title' => 'IM捕鱼天王','web_pic' => env('APP_URL').'/storage/uploads/api_game/202007/07/api_game_1594090779_r28wdgR8Gs.png','mobile_pic' => env('APP_URL').'/storage/uploads/api_game/202008/09/api_game_1596964025_S4IMdfhACL.png','api_name' => 'IMSLOT','class_name' => 'im','game_type' => '2','params' => '{"gameCode":"imgame16136"}','is_open' => '1',],
            ['id' => '85','title' => 'IM龙王捕鱼','web_pic' => env('APP_URL').'/storage/uploads/api_game/202007/07/api_game_1594090779_r28wdgR8Gs.png','mobile_pic' => env('APP_URL').'/storage/uploads/api_game/202008/09/api_game_1596964047_fsyISOheXa.png','api_name' => 'IMSLOT','class_name' => 'im','game_type' => '2','params' => '{"gameCode":"imgame27082"}','is_open' => '1',],
            ['id' => '86','title' => 'IM龙王捕鱼2','web_pic' => env('APP_URL').'/storage/uploads/api_game/202007/07/api_game_1594090779_r28wdgR8Gs.png','mobile_pic' => env('APP_URL').'/storage/uploads/api_game/202008/09/api_game_1596964072_XXwa8likH7.png','api_name' => 'IMSLOT','class_name' => 'im','game_type' => '2','params' => '{"gameCode":"imgame27083"}','is_open' => '1',],
            ['id' => '87','title' => 'IM财神捕鱼','web_pic' => env('APP_URL').'/storage/uploads/api_game/202007/07/api_game_1594090779_r28wdgR8Gs.png','mobile_pic' => env('APP_URL').'/storage/uploads/api_game/202008/09/api_game_1596964087_DcgJ4eVqwG.png','api_name' => 'IMSLOT','class_name' => 'im','game_type' => '2','params' => '{"gameCode":"imgame27084"}','is_open' => '1',],
            ['id' => '88','title' => 'IM五龙捕魚','web_pic' => env('APP_URL').'/storage/uploads/api_game/202007/07/api_game_1594090779_r28wdgR8Gs.png','mobile_pic' => env('APP_URL').'/storage/uploads/api_game/202008/09/api_game_1596964102_f7rqz9Qfsh.png','api_name' => 'IMSLOT','class_name' => 'im','game_type' => '2','params' => '{"gameCode":"imgame27085"}','is_open' => '1',],
            ['id' => '89','title' => 'MG百家乐','mobile_pic' => env('APP_URL').'/storage/uploads/api_game/202007/28/api_game_1595943927_k0RwxHT3r8.png','api_name' => 'FMG','class_name' => 'mg','game_type' => '1','params' => '{"gameCode":"4344"}','is_open' => '1',],
            ['id' => '90','title' => 'AG体育','mobile_pic' => env('APP_URL').'/storage/uploads/api_game/202007/28/api_game_1595943231_jpl5AoNcKp.png','api_name' => 'AG','game_type' => '5','params' => '{"gameCode":"TASSPTA"}','is_open' => '1',],
            ['id' => '91','title' => 'JDB棋牌','web_pic' => env('APP_URL').'/storage/uploads/api_game/202007/28/api_game_1595946290_KN3tObIh7X.png','mobile_pic' => env('APP_URL').'/storage/uploads/api_game/202007/28/api_game_1595943560_ElXBX3DVmd.png','api_name' => 'JDB','game_type' => '6',],
            ['id' => '92','title' => 'AG棋牌','web_pic' => env('APP_URL').'/storage/uploads/api_game/202007/28/api_game_1595946129_qVGdyy4UGX.png','mobile_pic' => env('APP_URL').'/storage/uploads/api_game/202007/28/api_game_1595943231_jpl5AoNcKp.png','api_name' => 'AG','game_type' => '6',],
            ['id' => '93','title' => 'EBET真人','mobile_pic' => env('APP_URL').'/storage/uploads/api_game/202008/29/api_game_1598692089_L31lBsKzNQ.png','api_name' => 'EBET','game_type' => '1','tags' => 'hot','is_open' => '1',],
            ['id' => '94','title' => 'GG电子','mobile_pic' => env('APP_URL').'/storage/uploads/api_game/202008/29/api_game_1598692019_EPH83hvW6J.png','api_name' => 'GG','game_type' => '3','tags' => 'hot','is_open' => '1',],
            ['id' => '95','title' => 'RG棋牌','mobile_pic' => env('APP_URL').'/storage/uploads/api_game/202008/29/api_game_1598692006_rmux34WbaU.png','api_name' => 'RG','game_type' => '6','is_open' => '1',],
            ['id' => '96','title' => 'PP真人','mobile_pic' => env('APP_URL').'/storage/uploads/api_game/202008/29/api_game_1598692089_L31lBsKzNQ.png','api_name' => 'PP','game_type' => '1','is_open' => '1','params' => '{"gameCode":"101"}'],

        ];
        foreach ($apigames as $item){
            ApiGame::create($item);
        }
        // ApiGame::insert($apigames);

        // ApiGame::insert($api_games->makeHidden(['game_type_text'])->toArray());
    }
}
