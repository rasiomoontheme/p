<?php

namespace App\Http\Controllers\Backend\Admin;

use App\Http\Controllers\Controller;
use App\Models\LevelConfig;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class LevelConfigsController extends AdminBaseController
{
    protected $create_field = ['level','level_name','deposit_money','bet_money','level_bonus','day_bonus','week_bonus','month_bonus','year_bonus','credit_bonus','levelup_type','lang'];
    protected $update_field = ['level','level_name','deposit_money','bet_money','level_bonus','day_bonus','week_bonus','month_bonus','year_bonus','credit_bonus','levelup_type','lang'];

    public function __construct(LevelConfig $model){
        $this->model = $model;
        parent::__construct();
    }

    public function edit(LevelConfig $levelconfig){
        return view($this->getEditViewName(),["model" => $levelconfig]);
    }

    public function storeRule(){
        return [
			"level" => "required",
			"level_name" => "required",
			"deposit_money" => "required|numeric|min:0",
			"bet_money" => "required|numeric|min:0",
			"level_bonus" => "required|numeric|min:0",
			"day_bonus" => "required|numeric|min:0",
			"week_bonus" => "required|numeric|min:0",
			"month_bonus" => "required|numeric|min:0",
			"year_bonus" => "required|numeric|min:0",
            "credit_bonus" => "required|numeric|min:0",
			"levelup_type" => ["required",Rule::in(array_keys(config('platform.levelup_types')))],
            "lang" => Rule::in(array_keys(config('platform.lang_select'))),
		];
    }

    public function updateRule($id){
        return [
			"level" => "required",
			"level_name" => "required",
            "deposit_money" => "required|numeric|min:0",
            "bet_money" => "required|numeric|min:0",
            "level_bonus" => "required|numeric|min:0",
            "day_bonus" => "required|numeric|min:0",
            "week_bonus" => "required|numeric|min:0",
            "month_bonus" => "required|numeric|min:0",
            "year_bonus" => "required|numeric|min:0",
            "credit_bonus" => "required|numeric|min:0",
			"levelup_type" => ["required",Rule::in(array_keys(config('platform.levelup_types')))],
            "lang" => Rule::in(array_keys(config('platform.lang_select'))),
		];
    }

    // app(App\Http\Controllers\Backend\Admin\LevelConfigsController::class)->fill_data()
    public function fill_data(){
        $json = '[{
			"keepPayAmount": 0.0,
			"dayBonus": 0.0,
			"keepType": 4,
			"siteCode": "intqd",
			"weekBonus": 0.0,
			"keepBetAmount": 0.0,
			"yearBonus": 0.0,
			"weekBetLimit": 0.0,
			"monthBonus": 0.0,
			"currentLevel": 0,
			"birthdayBonus": 0.0,
			"dayBetLimit": 0.0,
			"betAmount": 0.0,
			"payAmount": 0.0,
			"yearBetLimit": 0.0,
			"userCount": 58824,
			"monthBetLimit": 0.0,
			"upgradeBonus": 0.0,
			"upgradeBetLimit": 0.0,
			"upgradeType": 0,
			"id": 225,
			"birthdayBetLimit": 0.0,
			"lastUpdateTime": "2020-12-16T15:00:01.000+0800"
		},{"keepPayAmount":0.0,"dayBonus":0.5,"keepType":4,"siteCode":"intqd","weekBonus":1.5,"keepBetAmount":0.0,"yearBonus":88.0,"weekBetLimit":1.5,"monthBonus":8.0,"currentLevel":1,"birthdayBonus":8.0,"dayBetLimit":0.5,"betAmount":0.0,"payAmount":50.0,"yearBetLimit":88.0,"userCount":4520,"monthBetLimit":8.0,"upgradeBonus":1.0,"upgradeBetLimit":1.0,"upgradeType":2,"id":226,"birthdayBetLimit":8.0,"lastUpdateTime":"2020-12-16T14:59:54.000+0800"},{"keepPayAmount":0.0,"dayBonus":3.0,"keepType":4,"siteCode":"intqd","weekBonus":5.0,"keepBetAmount":0.0,"yearBonus":188.0,"weekBetLimit":5.0,"monthBonus":18.0,"currentLevel":2,"birthdayBonus":58.0,"dayBetLimit":3.0,"betAmount":100000.0,"payAmount":10000.0,"yearBetLimit":188.0,"userCount":92,"monthBetLimit":18.0,"upgradeBonus":28.0,"upgradeBetLimit":28.0,"upgradeType":4,"id":227,"birthdayBetLimit":58.0,"lastUpdateTime":"2020-12-16T14:59:50.000+0800"},{"keepPayAmount":0.0,"dayBonus":8.0,"keepType":4,"siteCode":"intqd","weekBonus":18.0,"keepBetAmount":0.0,"yearBonus":288.0,"weekBetLimit":18.0,"monthBonus":58.0,"currentLevel":3,"birthdayBonus":88.0,"dayBetLimit":8.0,"betAmount":500000.0,"payAmount":50000.0,"yearBetLimit":288.0,"userCount":9,"monthBetLimit":58.0,"upgradeBonus":88.0,"upgradeBetLimit":88.0,"upgradeType":4,"id":228,"birthdayBetLimit":88.0,"lastUpdateTime":"2020-12-16T14:59:45.000+0800"},{"keepPayAmount":0.0,"dayBonus":18.0,"keepType":4,"siteCode":"intqd","weekBonus":38.0,"keepBetAmount":0.0,"yearBonus":388.0,"weekBetLimit":38.0,"monthBonus":88.0,"currentLevel":4,"birthdayBonus":188.0,"dayBetLimit":18.0,"betAmount":1000000.0,"payAmount":100000.0,"yearBetLimit":388.0,"userCount":4,"monthBetLimit":88.0,"upgradeBonus":188.0,"upgradeBetLimit":188.0,"upgradeType":4,"id":230,"birthdayBetLimit":188.0,"lastUpdateTime":"2020-12-16T14:59:36.000+0800"},{"keepPayAmount":0.0,"dayBonus":38.0,"keepType":4,"siteCode":"intqd","weekBonus":58.0,"keepBetAmount":0.0,"yearBonus":588.0,"weekBetLimit":58.0,"monthBonus":188.0,"currentLevel":5,"birthdayBonus":588.0,"dayBetLimit":38.0,"betAmount":5000000.0,"payAmount":500000.0,"yearBetLimit":588.0,"userCount":0,"monthBetLimit":188.0,"upgradeBonus":388.0,"upgradeBetLimit":388.0,"upgradeType":4,"id":231,"birthdayBetLimit":588.0,"lastUpdateTime":"2020-12-16T14:59:23.000+0800"},{"keepPayAmount":0.0,"dayBonus":88.0,"keepType":4,"siteCode":"intqd","weekBonus":188.0,"keepBetAmount":0.0,"yearBonus":888.0,"weekBetLimit":188.0,"monthBonus":388.0,"currentLevel":6,"birthdayBonus":888.0,"dayBetLimit":88.0,"betAmount":1.0E+7,"payAmount":1000000.0,"yearBetLimit":888.0,"userCount":1,"monthBetLimit":388.0,"upgradeBonus":888.0,"upgradeBetLimit":888.0,"upgradeType":4,"id":232,"birthdayBetLimit":888.0,"lastUpdateTime":"2020-12-16T14:59:18.000+0800"},{"keepPayAmount":0.0,"dayBonus":188.0,"siteCode":"intqd","weekBonus":388.0,"keepBetAmount":0.0,"yearBonus":1888.0,"weekBetLimit":388.0,"monthBonus":588.0,"currentLevel":7,"birthdayBonus":2888.0,"dayBetLimit":188.0,"betAmount":3.0E+7,"payAmount":3000000.0,"yearBetLimit":1888.0,"userCount":0,"monthBetLimit":588.0,"upgradeBonus":2888.0,"upgradeBetLimit":2888.0,"upgradeType":3,"id":233,"birthdayBetLimit":2888.0,"lastUpdateTime":"2020-12-16T14:49:33.000+0800"},{"keepPayAmount":0.0,"dayBonus":388.0,"siteCode":"intqd","weekBonus":588.0,"keepBetAmount":0.0,"yearBonus":3888.0,"weekBetLimit":588.0,"monthBonus":888.0,"currentLevel":8,"birthdayBonus":5888.0,"dayBetLimit":388.0,"betAmount":5.0E+7,"payAmount":5000000.0,"yearBetLimit":3888.0,"userCount":1,"monthBetLimit":888.0,"upgradeBonus":5888.0,"upgradeBetLimit":5888.0,"upgradeType":3,"id":234,"birthdayBetLimit":5888.0,"lastUpdateTime":"2020-12-16T14:50:33.000+0800"},{"keepPayAmount":0.0,"dayBonus":688.0,"siteCode":"intqd","weekBonus":888.0,"keepBetAmount":0.0,"yearBonus":8888.0,"weekBetLimit":888.0,"monthBonus":1888.0,"currentLevel":9,"birthdayBonus":8888.0,"dayBetLimit":688.0,"betAmount":1.0E+8,"payAmount":8000000.0,"yearBetLimit":8888.0,"userCount":0,"monthBetLimit":1888.0,"upgradeBonus":8888.0,"upgradeBetLimit":8888.0,"upgradeType":3,"id":235,"birthdayBetLimit":8888.0,"lastUpdateTime":"2020-12-16T14:51:54.000+0800"},{"keepPayAmount":0.0,"dayBonus":888.0,"siteCode":"intqd","weekBonus":1888.0,"keepBetAmount":0.0,"yearBonus":18888.0,"weekBetLimit":1888.0,"monthBonus":3888.0,"currentLevel":10,"birthdayBonus":18888.0,"dayBetLimit":888.0,"betAmount":5.0E+8,"payAmount":1.5E+7,"yearBetLimit":18888.0,"userCount":1,"monthBetLimit":3888.0,"upgradeBonus":18888.0,"upgradeBetLimit":18888.0,"upgradeType":3,"id":236,"birthdayBetLimit":18888.0,"lastUpdateTime":"2020-12-16T14:55:06.000+0800"}]';

        $data = json_decode($json,1);

        foreach ($data as $key => $item){
            $index = $key;
            LevelConfig::create([
                'level' => $index,
                'level_name' => 'VIP'.$index,
                'deposit_money' => $item['payAmount'],
                'bet_money' => $item['betAmount'],
                'level_bonus' => $item['upgradeBonus'],
                'day_bonus' => $item['dayBonus'],
                'week_bonus' => $item['weekBonus'],
                'month_bonus' => $item['monthBonus'],
                'year_bonus' => $item['yearBonus'],
                'levelup_type' => $item['upgradeType'],
            ]);
        }
    }
}
