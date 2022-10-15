<?php

namespace App\Services;

use App\Exceptions\InternalException;
use App\Exceptions\InvalidRequestException;
use App\Models\Api;
use App\Models\ApiGame;
use App\Models\GameRecord;
use App\Models\Member;
use App\Models\SystemConfig;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;

class SelfService{

    protected $config;

    public $debug;
    public $salt ;
    public $betLimitCode;
    public $currencyCode;
    public $isspeed;
    public $isdemo;

    public function __construct(){

        // ?? api ????
        $this->config = SystemConfig::getConfigGroup('remote_api');

        // ???????api?????
         if(!array_key_exists('remote_api_domain',$this->config) || !array_key_exists('remote_api_id',$this->config)
            && !array_key_exists('remote_api_key',$this->config))
             throw new InternalException(trans('res.api.game.api_parameter_err'));
    }

    // ???? gameType,gameCode
    // username???????
    // public function register($api_code, $username,$password,$is_test = 0){
    public function register($data){
        $data['method'] = 'register';
        $data = $this->combineDefaultParams($data);

        $result = $this->send_post($data);
        // writelog("?? register ??,??:".json_encode($data).',??:'.$result);
        return $result;
    }

    // public function login($api_code,$username,$password,$gameType,$gameName = '',$is_Mobile = 0,$gameId = ''){
    public function login($data){
        $data['method'] = 'login';
        $data = $this->combineDefaultParams($data);

        $result = $this->send_post($data);
        // writelog("?? login ??,??:".json_encode($data).',??:'.$result);

        return $result;
    }

    // $api_code,$username,$password
    public function balance($data){
        $data['method'] = 'balance';
        $data = $this->combineDefaultParams($data);

        $result = $this->send_post($data);
        // writelog("?? balance ??,??:".json_encode($data).',??:'.$result);
        return $result;
    }

    // app(App\Services\SelfService::class)->autotransfer(['name' => '','api_code' => '','merchant_bill_no_1' => getBillNo(),'merchant_bill_no_2' => getBillNo(),])

    /**
     * {
            "status": {
                "errorCode": 20000,
                "msg": "??"
            },
            "data": {
                "code": 20000,
                "message": "??",
                "url": "",
                "data": {
                    "out_api_id": 5301,
                    "out_amount": 5,
                    "in_api_id": 5401,
                    "in_amount": 5
            }
        }
     */
    public function autotransfer($data){
        $data['method'] = 'autotransfer';
        $data = $this->combineDefaultParams($data);

        $result = $this->send_post($data);
        return $result;
    }

    public function deposit($data){
        $data['method'] = 'transfer';
        $data = $this->combineDefaultParams($data);

        $result = $this->send_post($data);
        // $result = '';
         writelog("?? deposit ??,??:".json_encode($data).',??:'.$result);
        return $result;
    }

    public function withdrawal($data){
        $data['method'] = 'transfer';
        $data = $this->combineDefaultParams($data);

        $result = $this->send_post($data);
         writelog("?? withdrawal ??,??:".json_encode($data).',??:'.$result);
        return $result;
    }

    /**
    public function transfer($billno,$api_code,$username,$password,$amount,$type = 1){
        writelog("?? transfer ??,??:".json_encode(func_get_args()));

        $result = [
            'status' => [
                'errorCode' => 0,
                'msg' => '??????'
            ]
        ];

        return json_encode($result);
    }
    */

    // app(App\Services\SelfService::class)->credit('IG')
    // ????:{"status":{"errorCode":0,"msg":"??"},"data":"13.00","url":""}
    public function credit($api_code){
        $params = $this->combineDefaultParams([
            'method' => 'credit',
            'api_code' => $api_code
        ]);

        $json = $this->send_post($params);
        return $json;
    }

    public function combineDefaultParams($data){
        // ?? api_code ????? api_id
        if(array_key_exists('api_code',$data) && $data['api_code']) {
            $api = Api::where('api_name',$data['api_code'])->first();

            if(!$api) throw new InvalidRequestException(trans('res.api.common.server_error'));

            $data['api_id'] = $api->api_id;
        }

        return array_merge([
            'api_account' => $this->config['remote_api_id'],
            'api_key' => $this->config['remote_api_key'],
        ],$data);
    }

    // ?????????????
    public function refreshApiMoney($api_code){
        $res = json_decode($this->credit($api_code),1);

        if(!is_array($res)) throw new InvalidRequestException(trans('res.api.common.net_again_err'));

        if($res['status']['errorCode'] != '20000') throw new InvalidRequestException(trans('res.api.common.err_code').$res['status']['errorCode'].','.trans('res.api.common.err_msg').$res['status']['msg']);

        // ???????
        Api::where('api_name',$api_code)->update([
            'api_money' => $res['data']
        ]);

        return $res['data'];
    }

    // ????
    // app(App\Services\SelfService::class)->checktransfer(App\Models\Member::find(7))
    /**
     * {
            "status": {
                "errorCode": 0,
                "msg": "??"
            },
            "data": [],
            "url": ""
        }
     *
     * @param $member
     * @param $end_at
     * @param string $bill_no
     * @return bool|mixed
     */
    public function checktransfer($member,$end_at = '',$start_at = '',$bill_no = '',$api_code = ''){
        $params = $this->combineDefaultParams([
            'username' => $member->name,
            // 'password' => $member->original_password,
            'method' => 'transferrecord',
            'api_code' => $api_code,
            'end_at' => $end_at,
            'start_at' => $start_at,
            // 'lang' => $member->lang
            //'end_at' => '2020-07-02 21:44:04'
        ]);

        if($bill_no) $params['merchant_bill_no'] = $bill_no;
        $result = $this->send_post($params);
        // writelog("?? checktransfer ??,??:".json_encode($params).',??:'.$result);

        return $result;
    }

    // app(App\Services\SelfService::class)->getGamelist('AG')
    public function getGamelist($api_code){
        $params = $this->combineDefaultParams([
            'method' => 'gamelist',
            'api_code' => $api_code,
        ]);

        $result = $this->send_post($params);
        // writelog("?? gamelist ??,??:".json_encode($data).',??:'.$result);

        return $result;
        //return curls($this->config['remote_api_domain'],$params,1);
    }

    public function getLotteryApiResult($method,$data = []){
        $params = $this->combineDefaultParams([
            'method' => $method,
            'api_code' => Api::LY_LOTTERY
        ]);
        $params = array_merge($params,$data);
        return $this->send_post($params);
    }

    // app(App\Services\SelfService::class)->gamerecord('AG')

    /**
     * $api_code,$start_at,$end_at,$page,$pageSize = 500
     * @param $data
     * @return bool|mixed
     */
    public function gamerecord($data){
        $params = $this->combineDefaultParams([
            'method' => 'gamerecord',
            'api_code' => $data['api_code'],
            'start_at' => isset_and_not_empty($data,'start_at',date('Y-m-d H:i:s',time() - 1 * 3600 * 24)),
            'end_at' => isset_and_not_empty($data,'end_at',date('Y-m-d H:i:s')),
            'page' => isset_and_not_empty($data,'page',1),
            'page_size' => isset_and_not_empty($data,'pageSize',500)
        ]);

        //$json = curls($this->config['remote_api_domain'],$params,1);
        $json = $this->send_post($params);
        // writelog('????:'.$json);
        return $json;
    }

    /**
     * {
            "bill_no": "13434344545",
            "api_id": 4,
            "api_code": "BBIN5",
            "player_name": "xxxuser2",
            "name": "user1",
            "merchant_id": 1,
            "bet_amount": "89023.00",
            "net_amount": "23.00",
            "net_win_loss": "2323.00",
            "valid_bet_amount": "3443.00",
            "bet_time": "2021-04-19 16:28:26",
            "bet_time_bj": "2021-04-19 06:28:28",
            "game_type": 1,
            "game_code": null,
            "game_name": "?????",
            "description": null,
        }
     *
     */
    public function savegamerecord($data){
        $api_list = Api::pluck('api_name','api_id')->toArray();

        foreach ($data as $v){
            $mod = GameRecord::where('billNo',$v['bill_no'])->first();

            // ??????
            if ($mod) {
                if ($mod->status == 'X' || $mod->api_name == 'LY') {
                    $mod->update($this->getUpdatedFields([], $v));
                }
                continue;
            }

            $memberName = substr($v['name'],strlen($this->config['remote_api_prefix']));
            $member = Member::where('name',$memberName)->first();

            if($member && $member->is_demo) continue;

            $record = [
                'billNo' => $v['bill_no'],
                'name' => $memberName,
                'playerName' => $v['name'],
                'betAmount' => $v['bet_amount'],
                'gameType' => convertGameType($v['game_type']),
                // 'roundNo' => $v['roundNo'],
                'playDetail' => $v['game_name'],
                //'wagerDetail' => $v['wagerDetail'],
                'gameResult' => $v['description'] ?: $v['game_name'],
                'betTime' => $v['bet_time_bj'],
                'confirmTime' => $v['bet_time_bj'],

                'member_id' => $member->id ?? 0,
                'api_name' => Arr::get($api_list,$v['api_id'],''),
            ];

            $record = $this->getUpdatedFields($record,$v);
            GameRecord::create($record);
        }
    }

    public function getUpdatedFields($record,$data){
        $record['playDetail'] = $data['game_name'];
        $record['gameResult'] = $data['description'];

        $record['lastUpdateTime'] = $data['bet_time_bj'];
        $record['validBetAmount'] = $data['valid_bet_amount'];
        $record['netAmount'] = $data['net_amount'];
        $record['status'] = $data['status'];
        $record['result'] = json_encode($data);
        return $record;
    }

    // "errorCode": 20000, ??????
    public function send_post($data){
        if($data['api_code'] == Api::JZ_LOTTERY) return app(JzService::class)->convertApiRequest($data);

        $url = $this->config['remote_api_domain'];

        // ?????????
        $params = $this->getFormatterPostData($data);

        $json = curls($url,$params,1);

        if(!in_array($data['method'],['gamelist','gamerecord','balance']) || ($data['method'] == 'transferrecord' && !Arr::get($data,'merchant_bill_no')))
            writelog('????:'.$json);
        return $json;
    }

    /**
    public function send_post($data){
        $url = '';
        if($data['api_code'] == Api::LY_LOTTERY){
            $api = Api::where('api_name',Api::LY_LOTTERY)->first();
            if(!$api) throw new \Exception(trans('res.api.game.lottery_api_not_exist'));
            $url = $api->remark;

            if(!Str::startsWith($url,'http')) throw new InvalidRequestException(trans('res.api.game.lottery_error'));

            $data['top'] = 'LyGame';
            $data['source'] = 'api';
            $data['website'] = env('APP_URL');

            if(array_key_exists('username',$data))  $data['username'] = $this->config['remote_api_prefix'].\Arr::get($data,'username');
        }else{
            $url = $this->config['remote_api_domain'];

            // ?????????
            $data = $this->getFormatterPostData($data);
        }

        $json = curls($url,$data,1);

        if($data['api_code'] == Api::LY_LOTTERY){
            if(!$json) return json_encode(['status' => ['errorCode' => -1,'msg' => '????']]);

            $res = json_decode($json,1);
            $res['status']['errorCode'] = \Arr::get($res,'code');
            $res['status']['msg'] = \Arr::get($res,'msg',\Arr::get($res,'message'));
            return json_encode($res);
        }else{
            return $json;
        }
    }
     */

    public function getFormatterPostData($data){
        $data = array_filter($data);
        ksort($data);

        $str = '';
        foreach ($data as $key => $value) {
            $str .= $key . '=' . $value . '|';
        }
        $str = $str . Arr::get($data,'api_key');

        $sign_str = $this->encryption($str);

        if(!in_array($data['method'],['gamelist','gamerecord','balance']))
            writelog('['.$data['method'].']????:'.json_encode($data,320));

        return [
            's' => $sign_str,
            'k' => Arr::get($data,'api_key')
        ];
    }

    public function encryption($string = "")
    {
        return base64_encode($string);
    }
}