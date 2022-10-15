<?php

namespace App\Http\Controllers\Api;

use App\Exceptions\InvalidRequestException;
use App\Handlers\FileUploadHandler;
use App\Http\Controllers\Controller;
use App\Models\Api;
use App\Models\ApiGame;
use App\Models\Bank;
use App\Models\BankCard;
use App\Models\Base;
use App\Models\DailyBonus;
use App\Models\Drawing;
use App\Models\Favorite;
use App\Models\FsLevel;
use App\Models\GameList;
use App\Models\GameRecord;
use App\Models\InterestHistory;
use App\Models\LevelConfig;
use App\Models\Member;
use App\Models\MemberApi;
use App\Models\MemberAgentApply;
use App\Models\MemberBank;
use App\Models\MemberMessage;
use App\Models\MemberMoneyLog;
use App\Models\MemberYuebaoPlan;
use App\Models\Message;
use App\Models\Payment;
use App\Models\Recharge;
use App\Models\SystemConfig;
use App\Models\Transfer;
use App\Models\YuebaoPlan;
use App\Services\ActivityService;
use App\Services\AgentService;
use App\Services\ThirdPayService;
use App\Services\SelfService;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\Rule;
// ????
class SelfController extends MemberBaseController{
    protected $service,$password;
    public function __construct()
    {
        $this->service = new SelfService();
		$this->password = 123456;
    }
    public function login(Request $request){
		$member = $this->getMember(1);
		if(!$member){
			return $this->failed('????');
		}
		$member_id = $member->id;
		$member_anme = $member->name;
		$api_code = strtoupper($request->get('api_code'));
		$isMobile = $request->get('isMobile',0);  //0?? , 1??
		$gameType = $request->get('gameType'); //????:1??,2??,3??,4??,5??,6??,7??
		$gameCode = $request->get('gameCode');  //?????
		$lang = $request->get('lang');  //??
        // $api_code = preg_replace("/\\d+/",'', $api_code);
		// if($api_code == 'CQ'){
		// 	$api_code = 'CQ9';
		// }
		$MemberApi = MemberApi::where('api_name', $api_code)->where('member_id', $member_id)->first();
//{"id":19,"member_id":24,"api_name":"GSS","username":"test100","password":"123456","api_token":"",
//"game_token":"","money":"0.00","last_login_at":null,"description":"","created_at":"2022-06-17T23:43:23.000000Z","updated_at":"2022-06-17T23:43:23.000000Z"}

        if(!$MemberApi){
			$register = $this->service->register($api_code,$member_anme);
			if(!$register){
				return $this->failed('????????01');
			}
			$register = json_decode($register,true);
			if($register['errCode'] != 0){
				//??api??
				$member_api = MemberApi::create([
					'member_id'=> $member_id,
					'api_name' => $api_code,
					'username' => $member_anme,
					'password' => $this->password,
					'api_token' => $gameCode
				]);
				return $this->failed($register['errMsg']);
			}
		}
		if($member->is_trans_on == 1){
			if($member->fs_money > 0){
                $member->increment('money', $member->fs_money);
                $member->decrement('fs_money', $member->fs_money);
			}
            $money = intval($member->money);
			if($money >= 1){
        	    $request->merge(['api_code' => $api_code,'money' => $money]);
         	    $data = $this->deposit($request);
        	    $data = json_decode($data->getContent(),1);
        	    if($data['status'] != 'success') return $this->failed($data['message']);
			}
		}
		$login = $this->service->login($api_code, $MemberApi->password, $gameCode, $gameType, $lang, $member_anme, $isMobile);
		if(!$login){
			return $this->failed('????????02');
		}
		$login = json_decode($login,true);
		if($login['errCode'] != 0){
			return $this->failed($login['errMsg']);
		}
        return $this->success(['game_url' => $login['gameUrl']]);;
    }

    public function balance(Request $request){
		$member = $this->getMember(1);
		if(!$member){
			return $this->failed('????');
		}
		$member_id = $member->id;
		$member_anme = $member->name;
        $data = $request->all();
		$api_code = strtoupper($data['api_code']);
		$lang = $data['lang'];  //??
		$MemberApi = MemberApi::where('api_name', $api_code)->where('member_id', $member_id)->first();
		$memberpassword = $MemberApi->password;
		$gameCode = $MemberApi->api_token;
        if(!$MemberApi){
			$register = $this->service->register($api_code,$member_anme);
			if(!$register){
				return $this->failed('????????01');
			}
			$register = json_decode($register,true);
			if($register['errCode'] != 0){
				//??api??
				$member_api = MemberApi::create([
					'member_id'=> $member_id,
					'api_name' => $api_code,
					'username' => $member_anme,
					'password' => $this->password,
					'api_token' => $gameCode
				]);
				return $this->failed($register['errMsg']);
			}
		}
		$balance = $this->service->balance($api_code,$member_anme,$memberpassword,$gameCode);
		if(!$balance){
			return $this->failed('????????04');
		}
		$balance = json_decode($balance,true);
		if($balance['errCode'] != 0){
			return $this->failed($balance['errMsg']);
		}
        return $this->success(['money' => $balance['balance']]);;
    }


    public function deposit(Request $request){
		$member = $this->getMember(1);
		if(!$member){
			return $this->failed('????');
		}
		$member_id = $member->id;
		$member_anme = $member->name;
        $data = $request->all();
		$api_code = strtoupper($data['api_code']);
		$lang = $request->input('lang');  //??
		$money = $request->input('money');
		$money_type = $request->input('money_type', 'money');
		if($member->money < $money){
			return $this->failed('????');
		}
		$MemberApi = MemberApi::where('api_name', $api_code)->where('member_id', $member_id)->first();
        $Api = Api::where('api_name', $api_code)->first();
		$member_password = $MemberApi->password;
		$gameCode = $MemberApi->api_token;
        if(!$MemberApi){
			$register = $this->service->register($api_code,$member_anme);
			if(!$register){
				return $this->failed('????????05');
			}
			$register = json_decode($register,true);
			if($register['errCode'] != 0){
				//??api??
				$member_api = MemberApi::create([
					'member_id'=> $member_id,
					'api_name' => $api_code,
					'username' => $member_anme,
					'password' => $this->password,
					'api_token' => $gameCode
				]);
				return $this->failed($register['errMsg']);
			}
		}
        $amount = intval($money);
        $transferno = date("YmdHms").rand(000000,999999);//????
		$deposit = $this->service->deposit($member_anme,$member_password,$gameCode,$amount,$transferno);
		if(!$deposit){
			return $this->failed('????????06');
		}
		$deposit = json_decode($deposit,true);
		if($deposit['errCode'] != 0){
			return $this->failed($deposit['errMsg']);
		}
        $MemberApi->update([
            'money' => $amount
        ]);
        $Transfer = Transfer::create([
            'bill_no' => $transferno,
            'api_name' => $api_code,
            'member_id' => $member_id,
            'transfer_type' => 1,  //1??,2??
			'money' => $amount,  //????
			'diff_money' => 0,  //??
			'real_money' => $amount,  //??????
			'before_money' => $member->money,  //?????
			'after_money' => $member->money - $amount,  //?????
			'money_type' => $money_type,
        ]);
        MemberMoneyLog::create([
            'member_id' => $member_id,
            'money' => $amount,
			'money_before' => $member->money,
			'money_after' => $member->money - $amount,
			'money_type' => $money_type,
            'number_type' => -1,  //1??  -1??
            'operate_type' => MemberMoneyLog::OPERATE_TYPE_GAME_IN_OUT,
            'description' => '???'.$Api->api_title.'????'.$amount.'??,??????',
            'model_name' => \get_class($Transfer),
            'model_id' => $Transfer->id
        ]);
		$member->decrement('money', $amount);
		return $this->success(["success" => true]);
    }

    public function withdrawal(Request $request){
		$member = $this->getMember(1);
		if(!$member){
			return $this->failed('????');
		}
		$member_id = $member->id;
        $member_anme = $member->name;
		$api_code = strtoupper($request->input('api_code'));
		$lang = $request->input('lang');  //??
		$money = $request->input('money');
		$money_type = $request->input('money_type', 'money');
		//$MemberApi = MemberApi::where('api_name', $api_code)->where('member_id', $member_id)->first();

		$Membertest = MemberApi::where('member_id', $member_id)->get();
			foreach ($Membertest as $value) {
				$Api = Api::where('api_name', $value->api_name)->first();
				$amount = intval($value->money);
				$transferno = date("YmdHms").rand(000000,999999);//????
				$withdrawal = $this->service->withdrawal($value->api_token,$value->username,$value->password,$value->api_token,$amount,$transferno);
				if(!$withdrawal){

				}
				$withdrawal = json_decode($withdrawal,true);
				if($withdrawal['errCode'] != 0){

				}else{
					MemberApi::where('id', $value->id)->update(['money' => 0]);
					$Transfer = Transfer::create([
						'bill_no' => $transferno,
						'api_name' => $value->api_token,
						'member_id' => $member_id,
						'transfer_type' => 2,  //1??,2??
						'money' => $amount,  //????
						'diff_money' => 0,  //??
						'real_money' => $amount,  //??????
						'before_money' => $member->money,  //?????
						'after_money' => $member->money + $amount,  //?????
						'money_type' => $money_type,
					]);
					MemberMoneyLog::create([
						'member_id' => $member_id,
						'money' => $amount,
						'money_before' => $member->money,
						'money_after' => $member->money + $amount,
						'money_type' => $money_type,
						'number_type' => 1,  //1??  -1??
						'operate_type' => MemberMoneyLog::OPERATE_TYPE_GAME_IN_OUT,
						'description' => '???'.$Api->api_title.'????'.$amount.'??,??????',
						'model_name' => \get_class($Transfer),
						'model_id' => $Transfer->id
					]);
					Member::where('id', $member->id)->increment('money', $amount);
				}
			}

        // $Api = Api::where('api_name', $api_code)->first();
		// $memberpassword = $MemberApi->password;
		// $gameCode = $MemberApi->api_token;
        // if(!$MemberApi){
		// 	$register = $this->service->register($api_code,$member_anme);
		// 	if(!$register){
		// 		return $this->failed('????????07');
		// 	}
		// 	$register = json_decode($register,true);
		// 	if($register['errCode'] != 0){
		// 		//??api??
		// 		$member_api = MemberApi::create([
		// 			'member_id'=> $member_id,
		// 			'api_name' => $api_code,
		// 			'username' => $member_anme,
		// 			'password' => $this->password,
		// 			'api_token' => $gameCode
		// 		]);
		// 		return $this->failed($register['errMsg']);
		// 	}
		// }
        // $amount = intval($money);
        // $transferno = date("YmdHms").rand(000000,999999);//????
		// $withdrawal = $this->service->withdrawal($api_code,$member_anme,$memberpassword,$gameCode,$amount,$transferno);
		// if(!$withdrawal){
		// 	return $this->failed('????????08');
		// }
		// $withdrawal = json_decode($withdrawal,true);
		// if($withdrawal['errCode'] != 0){
		// 	return $this->failed($withdrawal['errMsg']);
		// }
        // $MemberApi->update([
        //     'money' => 0
        // ]);
        // $Transfer = Transfer::create([
        //     'bill_no' => $transferno,
        //     'api_name' => $api_code,
        //     'member_id' => $member_id,
        //     'transfer_type' => 2,  //1??,2??
		// 	'money' => $amount,  //????
		// 	'diff_money' => 0,  //??
		// 	'real_money' => $amount,  //??????
		// 	'before_money' => $member->money,  //?????
		// 	'after_money' => $member->money + $amount,  //?????
		// 	'money_type' => $money_type,
        // ]);
        // MemberMoneyLog::create([
        //     'member_id' => $member_id,
        //     'money' => $amount,
		// 	'money_before' => $member->money,
		// 	'money_after' => $member->money + $amount,
		// 	'money_type' => $money_type,
        //     'number_type' => 1,  //1??  -1??
        //     'operate_type' => MemberMoneyLog::OPERATE_TYPE_GAME_IN_OUT,
        //     'description' => '???'.$Api->api_title.'????'.$amount.'??,??????',
        //     'model_name' => \get_class($Transfer),
        //     'model_id' => $Transfer->id
        // ]);
        // $member->increment('money', $amount);
        return $this->success(["success" => true]);
    }

    public function balance_admin(Request $request){

        $name =  $request->input('name');
		$member = Member::where('name', $name)->first();

		$member_id = $member->id;
		$member_anme = $member->name;
        $data = $request->all();
		$api_code = strtoupper($data['api_code']);
        $api_code = preg_replace("/\\d+/",'', $api_code);
		if($api_code == 'CQ'){
			$api_code = 'CQ9';
		}
		$MemberApi = MemberApi::where('api_name', $api_code)->where('member_id', $member_id)->first();
        if(!$MemberApi){
			$register = $this->service->register($api_code,$member_anme,$this->password);
			if(!$register){
				return $this->failed('????????03');
			}
			$register = json_decode($register,true);
			if($register['Code'] != 0){
				return $this->failed($register['Message']);
			}
                //??api??
            $member_api = MemberApi::create([
                'member_id' => $member_id,
                'api_name' => $api_code,
                'username' => $member_anme,
                'password' => $this->password
            ]);
		}
		$balance = $this->service->balance($api_code,$member_anme);
		if(!$balance){
			return $this->failed('????????04');
		}
		$balance = json_decode($balance,true);

		if($balance['Code'] != 0){
			return $this->failed($balance['Message']);
		}
        return $this->success(['money' => $balance['Data']['balance']]);;
    }

    public function withdrawal_admin(Request $request){

        $name =  $request->input('name');
		$member = Member::where('name', $name)->first();

		$member_id = $member->id;
        $member_anme = $member->name;

		$api_code = strtoupper($request->input('api_code'));
		$lang = $request->input('lang', 'zh-cn');  //??
		$money = $request->input('money');
		$money_type = $request->input('money_type', 'money');
        $api_code = preg_replace("/\\d+/",'', $api_code);
		if($api_code == 'CQ'){
			$api_code = 'CQ9';
		}
		$MemberApi = MemberApi::where('api_name', $api_code)->where('member_id', $member_id)->first();
        $Api = Api::where('api_name', $api_code)->first();
        if(!$MemberApi){
			$register = $this->service->register($api_code,$member_anme,$this->password);
			if(!$register){
				return $this->failed('????????07');
			}
			$register = json_decode($register,true);
			if($register['Code'] != 0){
				return $this->failed($register['Message']);
			}
                //??api??
            $MemberApi = MemberApi::create([
                'member_id' => $member_id,
                'api_name' => $api_code,
                'username' => $member_anme,
                'password' => $this->password
            ]);
		}

        $amount = intval($money);
        $transferno = date("YmdHms").rand(000000,999999);//????
		$withdrawal = $this->service->withdrawal($api_code,$member_anme,$amount,$transferno);
		if(!$withdrawal){
			return $this->failed('????????08');
		}
		$withdrawal = json_decode($withdrawal,true);
		if($withdrawal['Code'] != 0){
			return $this->failed($withdrawal['Message']);
		}
        $MemberApi->update([
            'money' => 0
        ]);
        $Transfer = Transfer::create([
            'bill_no' => $transferno,
            'api_name' => $api_code,
            'member_id' => $member_id,
            'transfer_type' => 2,  //1??,2??
			'money' => $amount,  //????
			'diff_money' => 0,  //??
			'real_money' => $amount,  //??????
			'before_money' => $member->money,  //?????
			'after_money' => $member->money + $amount,  //?????
			'money_type' => $money_type,
        ]);
        MemberMoneyLog::create([
            'member_id' => $member_id,
            'money' => $amount,
			'money_before' => $member->money,
			'money_after' => $member->money + $amount,
			'money_type' => $money_type,
            'number_type' => 1,  //1??  -1??
            'operate_type' => MemberMoneyLog::OPERATE_TYPE_GAME_IN_OUT,
            'description' => '???'.$Api->api_title.'????'.$amount.'??,??????',
            'model_name' => \get_class($Transfer),
            'model_id' => $Transfer->id
        ]);
        $member->increment('money', $amount);
        return $this->success(['money' => $withdrawal['Data']['withdrawal']]);
    }

}
