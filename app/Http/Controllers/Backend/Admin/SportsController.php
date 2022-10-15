<?php

namespace App\Http\Controllers\Backend\Admin;

use App\Http\Controllers\Controller;
use App\Models\Sport;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class SportsController extends AdminBaseController
{
    protected $create_field = ['home_team_name','home_team_name_en','home_team_img','home_odds','visiting_team_name','visiting_team_name_en','visiting_team_img','visiting_odds','match_cup','match_cup_en','let_ball','match_at','is_open','weight'];
    protected $update_field = ['home_team_name','home_team_name_en','home_team_img','home_odds','visiting_team_name','visiting_team_name_en','visiting_team_img','visiting_odds','match_cup','match_cup_en','let_ball','match_at','is_open','weight'];

    public function __construct(Sport $model){
        $this->model = $model;
        parent::__construct();
    }

    public function edit(Sport $sport){
        return view($this->getEditViewName(),["model" => $sport]);
    }

    public function storeRule(){
        return [
			"home_team_name" => "required",
			"home_team_name_en" => "required",
			"home_team_img" => "required",
			"home_odds" => "required",
			"visiting_team_name" => "required",
			"visiting_team_name_en" => "required",
			"visiting_team_img" => "required",
			"visiting_odds" => "required",
			"match_cup" => "required",
			"match_cup_en" => "required",
			"match_at" => "required",
			"is_open" => ["required",Rule::in(array_keys(config('platform.boolean')))],
		];
    }

    public function updateRule($id){
        return [
			"home_team_name" => "required",
			"home_team_name_en" => "required",
			"home_team_img" => "required",
			"home_odds" => "required",
			"visiting_team_name" => "required",
			"visiting_team_name_en" => "required",
			"visiting_team_img" => "required",
			"visiting_odds" => "required",
			"match_cup" => "required",
			"match_cup_en" => "required",
			"match_at" => "required",
			"is_open" => ["required",Rule::in(array_keys(config('platform.boolean')))],
		];
    }

    // app(App\Http\Controllers\Backend\Admin\SportsController::class)->fill_data()
    public function fill_data(){
        $json = '[{
            "visitingOdds": "1.95",
            "homeOdds": "1.98",
            "matchDate": "03月20日 23:14",
            "letBall": "0.75",
            "receivedTeam": "皇家马德里",
            "visitingTeam": "皇家马德里",
            "matchCup": "西班牙甲组联赛",
            "matchTime": "2021-03-20 23:14:59",
            "visitingTeamImg": "https://www.753320.com/q01/jeroe/APP/notice/201912/b2df021c8f2a4c62927e0b0321950b2b.png",
            "homeTeamImg": "https://www.753320.com/q01/jeroe/APP/notice/201912/1bf6c818de18477ea69b72722c1e8d82.png",
            "homeTeam": "切尔达",
            "gameCode": "42073033",
            "sport": "Soccer"
        }, {
            "visitingOdds": "1.93",
            "homeOdds": "2",
            "matchDate": "03月20日 22:29",
            "letBall": "0.5",
            "receivedTeam": "沃尔夫斯堡",
            "visitingTeam": "沃尔夫斯堡",
            "matchCup": "德国甲组联赛",
            "matchTime": "2021-03-20 22:29:59",
            "visitingTeamImg": "https://www.753320.com/q01/jeroe/APP/notice/201912/1d1b5d8b655243d28adc2d301227f1a7.png",
            "homeTeamImg": "https://www.753320.com/q01/jeroe/APP/notice/201912/68f4360a9f00415dac4ab776e3022183.png",
            "homeTeam": "云达不莱梅",
            "gameCode": "42073327",
            "sport": "Soccer"
        }, {
            "visitingOdds": "2.38",
            "homeOdds": "1.65",
            "matchDate": "03月20日 22:29",
            "letBall": "1.5",
            "receivedTeam": "多特蒙德",
            "visitingTeam": "多特蒙德",
            "matchCup": "德国甲组联赛",
            "matchTime": "2021-03-20 22:29:59",
            "visitingTeamImg": "https://www.753320.com/q01/jeroe/APP/notice/201912/48477fc15f254adbbabb3a391606be2b.png",
            "homeTeamImg": "https://www.753320.com/q01/jeroe/APP/notice/201912/34c3d23d5ecf4c948126abe970e1f0e6.png",
            "homeTeam": "科隆",
            "gameCode": "42073325",
            "sport": "Soccer"
        }, {
            "visitingOdds": "1.96",
            "homeOdds": "1.97",
            "matchDate": "03月20日 22:29",
            "letBall": "-0.5",
            "receivedTeam": "柏林联",
            "visitingTeam": "柏林联",
            "matchCup": "德国甲组联赛",
            "matchTime": "2021-03-20 22:29:59",
            "visitingTeamImg": "https://www.753320.com/q01/jeroe/APP/notice/201912/2016240218f44007a72f8e7f91dc1e4b.png",
            "homeTeamImg": "https://www.753320.com/q01/jeroe/APP/notice/201912/4604b3d4fedc42d986dca1263e383b82.png",
            "homeTeam": "法兰克福",
            "gameCode": "42073326",
            "sport": "Soccer"
        }, {
            "visitingOdds": "1.88",
            "homeOdds": "2.05",
            "matchDate": "03月20日 22:29",
            "letBall": "-2",
            "receivedTeam": "斯图加特",
            "visitingTeam": "斯图加特",
            "matchCup": "德国甲组联赛",
            "matchTime": "2021-03-20 22:29:59",
            "visitingTeamImg": "https://www.753320.com/q01/intqa/PC/notice/202008/406750107d9a485aa25053c5fae60329.png",
            "homeTeamImg": "https://www.753320.com/q01/jeroe/APP/notice/201912/51197d0ac8454e4e956b8523e151e5c8.png",
            "homeTeam": "拜仁慕尼黑",
            "gameCode": "42073324",
            "sport": "Soccer"
        }, {
            "visitingOdds": "2.03",
            "homeOdds": "1.9",
            "matchDate": "03月20日 21:59",
            "letBall": "0.5",
            "receivedTeam": "博洛尼亚",
            "visitingTeam": "博洛尼亚",
            "matchCup": "意大利甲组联赛",
            "matchTime": "2021-03-20 21:59:59",
            "visitingTeamImg": "https://www.753320.com/q01/jeroe/APP/notice/201912/29f867ce9088499aa496b6942c0ad230.png",
            "homeTeamImg": "https://www.753320.com/q01/jeror/APP/notice/202009/e33db553a54b475baf78038c4f44af93.png",
            "homeTeam": "克努托内",
            "gameCode": "42073276",
            "sport": "Soccer"
        }, {
            "visitingOdds": "2.16",
            "homeOdds": "1.79",
            "matchDate": "03月20日 20:59",
            "letBall": "-0.5",
            "receivedTeam": "埃巴",
            "visitingTeam": "埃巴",
            "matchCup": "西班牙甲组联赛",
            "matchTime": "2021-03-20 20:59:59",
            "visitingTeamImg": "https://www.753320.com/q01/jeroe/APP/notice/201912/78e0024a0ada41c1ab75efc8976201fc.png",
            "homeTeamImg": "https://www.753320.com/q01/jeroe/APP/notice/201912/fc93d7b0a58d4530821d309313e4fd3a.png",
            "homeTeam": "毕尔巴鄂竞技",
            "gameCode": "42073032",
            "sport": "Soccer"
        }, {
            "visitingOdds": "2",
            "homeOdds": "1.92",
            "matchDate": "03月20日 19:59",
            "letBall": "0.25",
            "receivedTeam": "雷恩",
            "visitingTeam": "雷恩",
            "matchCup": "法国甲组联赛",
            "matchTime": "2021-03-20 19:59:59",
            "visitingTeamImg": "https://www.753320.com/q01/jeroe/APP/notice/201912/235b4e0cd2864c78959d9ba0d28218ca.png",
            "homeTeamImg": "https://www.753320.com/q01/jeroe/APP/notice/201912/71a69b2a61ca40ae999a8cb2daa1786f.png",
            "homeTeam": "梅斯",
            "gameCode": "42162336",
            "sport": "Soccer"
        }, {
            "visitingOdds": "2.01",
            "homeOdds": "1.92",
            "matchDate": "03月21日 00:59",
            "letBall": "0",
            "receivedTeam": "卡利亚里",
            "visitingTeam": "卡利亚里",
            "matchCup": "意大利甲组联赛",
            "matchTime": "2021-03-21 00:59:59",
            "visitingTeamImg": "https://www.753320.com/q01/jeroe/APP/notice/201912/2878c51bdd3542b09e755055da56b22f.png",
            "homeTeamImg": "https://www.753320.com/q01/jerof/PC/notice/202009/7d47e0c5b0d8419cbe799f3ea895f03e.jpg",
            "homeTeam": "史柏斯亚",
            "gameCode": "42073277",
            "sport": "Soccer"
        }, {
            "visitingOdds": "2.96",
            "homeOdds": "1.43",
            "matchDate": "03月20日 23:59",
            "letBall": "0.75",
            "receivedTeam": "马赛",
            "visitingTeam": "马赛",
            "matchCup": "法国甲组联赛",
            "matchTime": "2021-03-20 23:59:59",
            "visitingTeamImg": "https://www.753320.com/q01/jeroe/APP/notice/201912/0c9a6d1a173e4eda8482ffcaacee661d.png",
            "homeTeamImg": "https://www.753320.com/q01/jeroe/APP/notice/201912/3b05541701ce49048f54669ec1bd7db7.png",
            "homeTeam": "尼斯",
            "gameCode": "42162335",
            "sport": "Soccer"
        }]';

        $data = json_decode($json,1);

        foreach ($data as $item){
            Sport::create([
                'home_team_name' => $item['homeTeam'],
                'home_team_name_en' => $item['homeTeam'].'- en',
                'home_team_img' => $item['homeTeamImg'],
                'home_odds' => $item['homeOdds'],

                'visiting_team_name' => $item['visitingTeam'],
                'visiting_team_name_en' => $item['visitingTeam'].'- en',
                'visiting_team_img' => $item['visitingTeamImg'],
                'visiting_odds' => $item['visitingOdds'],

                'let_ball' => $item['letBall'],
                'match_cup' => $item['matchCup'],
                'match_cup_en' => $item['matchCup'].'- en',
                'match_at' => $item['matchTime']
            ]);
        }
    }
}
