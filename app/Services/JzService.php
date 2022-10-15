<?php

namespace App\Services;

use App\Exceptions\InvalidRequestException;
use App\Models\Api;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;

class JzService {

    public $api_name;
    public $domain;
    public $play_domain;
    public $fund_domain;
    public $game_domain;

    public $ClientId;
    public $SecretKey;

    public $api;
    public $prefix;

    public function __construct()
    {
        $this->api_name = Api::JZ_LOTTERY;
        $this->api = Api::where('api_name',Api::JZ_LOTTERY)->first();
        if(!$this->api)throw new InvalidRequestException('系统未发现该游戏，未开通本地彩票功能，请联系开户人员');

        $config = $this->api->remark;
        if(!$config) throw new InvalidRequestException('系统彩配置错误，未开通本地彩票功能，请联系开户人员');

        $config = json_decode($config,1);
        if(!is_array($config) || !array_key_exists('id',$config)
            || !array_key_exists('key',$config)
            || !array_key_exists('api',$config)
            || !array_key_exists('game',$config)) throw new InvalidRequestException('系统彩配置错误，未开通本地彩票功能，请联系开户人员');

        $this->domain = $config['api'];
        $this->ClientId = $config['id'];
        $this->SecretKey = $config['key'];
        $this->game_domain = $config['game'];

        /**
        $this->domain = 'https://lingametestapi.jzklapi.com';
        $this->ClientId = '8f304289-de0a-4723-bb98-54ce54d2c147';
        $this->SecretKey = '1NnIyxEHOWHbKbOEG1KErNwhNWA=';
        $this->game_domain = 'https://lingametestplayer.jzklapi.com';
         **/

        $this->play_domain = $this->domain.'/api/merchant_client/player/account/';
        $this->fund_domain = $this->domain.'/api/merchant_client/player/fund/';

        $this->prefix = systemconfig('remote_api_prefix');
        if(!$this->prefix) throw new InvalidRequestException('请先配置API接口基础配置');
    }

    /**
     * 转换前的参数格式为：
     * {
    "api_id": "**",
    "api_key": "**",
    "username": "vvv123",
    "password": "***",
    "method": "checktransfer",
    "api_code": "ZNWG",
    "bill_no": "2103292015461665"
    }
     */
    // app(App\Services\JzService::class)->convertApiRequest([])
    public function convertApiRequest($data){
        // writelog('[jz] data:'.json_encode($data));
        $method = Arr::get($data,'method');

        if(!method_exists($this,$method)) throw new InvalidRequestException(trans('res.api.common.server_error'));

        if(array_key_exists('name',$data)) $data['username'] = $this->prefix.$data['name'];
        $json = $this->$method($data);

        return $this->convertApiResponse($json, $method);
    }

    public function convertApiResponse($json,$func = ''){
        if(!$json) return $this->foramtApiResponse(-1,trans('res.api.common.net_again_err'));

        $data = json_decode($json,1);

        if(!is_array($data)) return $this->foramtApiResponse(-1,trans('res.api.common.net_again_err'));

        $code = $data['code'];
        $code = $code == 200 ? 20000 : $code;

        $msg = $data['msg'];
        $msg = $msg ? $msg : '';

        switch ($func){
            case 'login':
                return $this->foramtApiResponse($code,$msg,$code != 20000 ? '' : $this->getLoginUrl($data));
            case 'gamerecord':
                return $this->foramtApiResponse($code,$msg, $code != 20000 ? '' : $this->getGameData($data));
            case 'balance':
                return $this->foramtApiResponse($code,$msg, $code != 20000 ? '' : $this->getBalance($data));
            case 'credit':
                return $this->foramtApiResponse($code,$msg, $code != 20000 ? '' : $this->getBalance($data));
                default:
                return $this->foramtApiResponse($code,$msg);
        }
    }

    // 转换为：{"status":{"errorCode":0,"msg":"成功"},"data":"","url":""}
    public function foramtApiResponse($code, $msg, $data = '', $url = ''){
        return json_encode([
            'status' => [
                'errorCode' => $code == 200 ? 20000 : $code,
                'msg' => $msg
            ],
            'data' => $data,
            'url' => $url
        ],JSON_UNESCAPED_UNICODE);
    }

    public function getLoginUrl($data){
        $token = Arr::get($data['data'] ?? [], 'token');

        // writelog('isMobile:'.request()->get('isMobile',0));
        $url = $this->game_domain;
        $url = Str::endsWith($url,'/') ? $url : $url .'/';
        $url = request()->get('isMobile',0) ? ($url . 'mobile/') : $url;
        $url .= '?token='.$token.'&lang=zh_cn';
        return $url;
    }

    public function getBalance($data){
        $t = $data['data']['accounts'];
        return current($t)['redis_balance'];
    }

    /**
     *  "player_id": 0,
    "player_name": "string",
    "order_no": "string",
    "lottery_name": "string",
    "issue_no": "string",
    "play_name": "string",
    "amount": 0,
    "order_status": 0,
    "order_status_text": "string",
    "player_bonus": 0,
    "create_time": 0,
    "settlement_time": 0,
    "is_can_cancel": true
     *
     * @param $data
     * @return mixed
     */
    public function convertGameRecord($data){
        $data['result'] = json_encode($data,JSON_UNESCAPED_UNICODE);
        $data['api_name'] = $this->api_name;
        $data['bill_no'] = $data['order_no'];
        // name 带前缀的会员游戏账号
        $data['name'] = $data['player_name'];
        $data['bet_amount'] = $data['amount'];
        $data['game_type'] = 99;
        // roundNo 场次信息
        $data['description'] = $data['lottery_name'].' - '.$data['issue_no'].'期';
        // playDetail 玩法详情
        $data['game_name'] = $data['play_name'];
        // wagerDetail
        $data['wagerDetail'] = '';
        $data['gameResult'] = '';
        $data['bet_time_bj'] = date('Y-m-d H:i:s',$data['create_time']);
        $data['bet_time_bj'] = date('Y-m-d H:i:s',$data['settlement_time'] ?? $data['create_time']);
        $data['lastUpdateTime'] = $data['confirmTime'];
        $data['valid_bet_amount'] = $data['betAmount'];
        $data['net_amount'] = $data['player_bonus'];
        $data['status'] = $this->convertOrderStatus($data['order_status']);
        return $data;
    }

    // 转为为本地的订单状态
    public function convertOrderStatus($order_status){
        switch ($order_status){
            case 1:
                return 'X';
            case 2:
            case 3:
                return 'COMPLETE';
            case 4:
                return 'CANCEL';
            case 5:
                return 'N';
            default:
                return 'X';
        }
    }

    public function register($data){
        $params = [
            'player_name' => $data['username']
        ];

        return $this->send_post($this->play_domain.'register',$params);
    }

    public function autotransfer($data){
        return '{"data": {},"code": 200,"msg": null,"err_msg": null,"tid": null}';
    }

    /**
     * @param $name
     *  {
    "data": {
    "player_id": 0,
    "player_name": "string",
    "token": "string",
    "expires_in": 0,
    },
    "code": 200,
    "msg": null,
    "err_msg": null,
    "tid": null
    }
     */
    public function login($data){
        $params = [
            'player_name' => $data['username'],
            // 'rebate' => 2000
        ];

        return $this->send_post($this->play_domain.'login',$params);
    }

    public function deposit($data){
        $params = [
            'player_name' => $data['username'],
            'amount' => $data['amount']
        ];

        $before_json = $this->send_post($this->fund_domain.'transfer/prepare/in', $params);
        $before_arr = json_decode($before_json,1);

        $params['order_no'] = $before_arr['data']['order_no'] ?? '';

        return $this->send_post($this->fund_domain.'transfer/confirm/in', $params);
    }

    public function transfer($data){
        if($data['transfer_type'] == 1){
            return $this->deposit($data);
        }else if($data['transfer_type'] == 2){
            return $this->withdrawal($data);
        }
    }

    public function withdrawal($data){
        $params = [
            'player_name' => $data['username'],
            'amount' => $data['amount']
        ];

        $before_json = $this->send_post($this->fund_domain.'transfer/prepare/out', $params);
        $before_arr = json_decode($before_json,1);

        $params['order_no'] = $before_arr['data']['order_no'] ?? '';

        return $this->send_post($this->fund_domain.'transfer/confirm/out', $params);
    }

    // current($data['data']['accounts'])['redis_balance']
    public function balance($data){
        $params = [
            'player_name' => $data['username'],
        ];

        return $this->send_post($this->fund_domain.'detail',$params);
    }

    public function credit($data){
        return '{"data":{"accounts":[{"redis_balance":9999999.00}]},"code":200,"msg":null,"err_msg":null,"tid":null}';
    }

    // app(App\Services\JzService::class)->hotlist([])
    public function hotlist($data){
        $params = [
            'nav_menu_id' => 1,
            'count' => 5
        ];

        return $this->send_post($this->domain.'/api/merchant_client/navigation/sub_menu_lottery_list',$params);
    }

    // app(App\Services\JzService::class)->gamelist([])
    public function gamelist($data){
        $params = [];

        return $this->send_post($this->domain.'/api/merchant_client/navigation/list',$params);
    }

    // $data['data']['data'] 表示游戏记录列表

    /**
     *  {
     *      "status":{
     *          "errorCode":"",
     *          "msg":""
     *      },
     *      "data":{
     *          "total_count":1,
     *          "page":1,
     *          "pageSize":500,
     *          "pageCount":1,
     *          "data":[
     *              {...},{...}
     *          ]
     *      }
     * }
     */
    public function getGameData($data){
        $data = $data['data'];
        return [
            'total' => $data['paging']['total'],
            'from' => $data['paging']['page_index'],
            'per_page' => $data['paging']['page_size'],
            'last_page' => ceil($data['paging']['total'] / $data['paging']['page_size']),
            'data' => $data['records']
        ];
    }

    /*
     * @param $page
     * @param $start_at
     * @param $end_at
     * @return string
     */
    public function gamerecord($data){
        $params = [
            'page_index' => $data['page'],
            'player_name' => request('username',''),
            'page_size' => request('page_size',500),
            'time_type' => request('time_type',1),
            'begin_time' => strtotime($data['start_at']),
            'end_time' => strtotime($data['end_at']),
        ];

        return $this->send_post($this->domain.'/api/merchant_client/bet_order/page_list', $params);
    }

    public function getApiDomain(){
        return $this->domain;
    }

    // 每一个接口请求，HttpHeader 中，要有 ClientId、SecretKey，ClientId=客户端 Id，
    //SecretKey=密钥，X-APP-AGENT=浏览器 User-Agent，X-APP-IP=用户真实 IP，密钥不正确
    //无法访问。
    // remark: {"ClientId":"xxx","SecretKey":"xxx"}
    public function send_post($url, $data){
        $header = [
            'Content-Type: application/json; charset=utf-8',
            'ClientId:'.$this->ClientId,
            'SecretKey:'.$this->SecretKey,
            'X-APP-AGENT:'.$_SERVER['HTTP_USER_AGENT'],
            'X-APP-IP:'.get_client_ip()
        ];

        $curl = curl_init();
        curl_setopt($curl, CURLOPT_TIMEOUT, 30);
        curl_setopt($curl, CURLOPT_CONNECTTIMEOUT, 30);
        curl_setopt($curl, CURLOPT_HTTPHEADER, $header);
        curl_setopt($curl, CURLOPT_HEADER,0);
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_POST, true);
        // 如果是多维数组需要进行处理
        curl_setopt($curl, CURLOPT_POSTFIELDS, json_encode($data));
        curl_setopt($curl, CURLOPT_URL, $url);
        // curl_setopt($curl, CURLOPT_ENCODING, "gzip");
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        $output = curl_exec($curl);
        curl_close($curl);

        // if(!Str::contains($url,'bet_order'))
        //   writelog('[jz] url:'.$url.',request data:'.json_encode($data).',response:'.$output);

        return $output;
    }
}