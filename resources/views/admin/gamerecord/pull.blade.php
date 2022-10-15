<?php
// ?? ??,????,????,????,????
$service = app(\App\Services\SelfService::class);

$count = 0;$errMsg = "";

// ?????????
$params = [
    'page' => 1
];

/**
{
"status": {
"errorCode": 0,
"msg": "??"
},
"data": {
"total_count": 1,
"page": "1",
"pageSize": "500",
"pageCount": 1,
"data": [{
"id": 176,
"rowid": "0",
"billNo": "8200701036698657",
"api_type": 3,
"api_name": "AG",
"member_id": 116111,
"name": "1iatest03",
"top_id": 116098,
"playerName": "4m01iatest03",
"betAmount": "0.10",
"validBetAmount": "0.10",
"netAmount": "0.00",
"status": "COMPLETE",
"localGameType": "3",
"roundNo": "",
"playDetail": "????",
"wagerDetail": "",
"gameResult": "",
"origin": "",
"betTime": "2020-07-01 15:57:00",
"lastUpdateTime": "2020-07-01 16:06:01",
"confirmTime": "2020-07-01 03:56:23",
"recalcuTime": null,
"stringex": null,
"result": "{\"BillNo\":\"8200701036698657\",\"ProductID\":\"HE8\",\"UserName\":\"4m01iatest03\",\"BillTime\":\"2020-07-01T03:56:23\",\"ReckonTime\":\"2020-07-01T03:56:23\",\"SlotType\":\"1\",\"Currency\":\"CNY\",\"GameType\":\"AV01\",\"BetIP\":\"171.43.167.219\",\"Account\":0.1,\"CusAccount\":-0.1,\"ValidAccount\":0.1,\"AccountBase\":0.1,\"AccountBonus\":0,\"CusAccountBase\":-0.1,\"CusAccountBonus\":0,\"SrcAmount\":19.9,\"DstAmount\":\"\",\"Flag\":1,\"PlatformType\":\"SLOT\",\"DeviceType\":0,\"ExttxID\":\"\",\"CreateDateTime\":\"2020-07-01T15:57:00.383\",\"UpdateDateTime\":\"2020-07-01T16:06:01.227\"}",
"remark": "",
"created_at": "2020-07-01 17:53:51",
"updated_at": "2020-07-01 17:53:51"
}]
},
"url": ""
}
 */
// ??????

try{
    $res = json_decode($service->gamerecord($params),1);
writelog('$res: '.$res);
    if(!is_array($res)) throw new Exception('????,???');

    if($res['Code'] != 0) throw new \Exception($res['Message'],$res['Code']);

    if(!$res['Data']['data'] || count($res['Data']['data']) <= 0) throw new \Exception('??????',$res['Code']);

    $service->savegamerecord($res['Data']['data']);

    $count += $res['Data']['total_count'];

    if($res['Data']['lastPage'] > 1){

        for ($i = 2; $i <= $res['Data']['lastPage']; $i++){
            $params['page'] = $i;

            $res = json_decode($service->gamerecord($params),1);

            if(!is_array($res)) throw new Exception('????,???');

            if($res['Code'] != 0) throw new \Exception($res['Message'],$res['Code']);

            if(count($res['Data']['data']) <= 0) throw new \Exception('??????',$res['Code']);

            // $service->savegamerecord($res['Data']['record'],$params);
            $service->savegamerecord($res['Data']['data']);

            //$count += $res['Data']['total_count'];
        }

    }

}catch (Exception $e){
    $errMsg = '????:'.$e->getMessage().',????:'.$e->getCode();
}
?>

<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <title></title>
    <style type="text/css">
        body,td,th {
            font-size: 12px;
        }
        body {
            margin-left: 0px;
            margin-top: 0px;
            margin-right: 0px;
            margin-bottom: 0px;
        }
    </style>
</head>
<body>
<script>
    // ????
    var limit="300";

    if (document.images){
        var parselimit=limit
    }
    function beginrefresh(){
        if (!document.images)
            return
        if (parselimit==1)
            window.location.reload()
        else{
            parselimit-=1
            curmin=Math.floor(parselimit)
            if (curmin!=0)
                curtime=curmin+"??????!"
            else
                curtime=cursec+"??????!"
            timeinfo.innerText=curtime
            setTimeout("beginrefresh()",1000)
        }
    }

    window. onload=beginrefresh;
</script>
<table width="100%"border="0" cellpadding="0" cellspacing="0">
    <tr>
        <td align="left">
            <input type='button' name='button' value="??" onClick="window.location.reload()">
        <!--input type="button" name='button2' value="??" onclick="window.open('{{ route('admin.gamerecord.pull',array_merge(request()->all(),['start_at' => Carbon\Carbon::now()->subDay()->toDateTimeString(),'end_at' => \Carbon\Carbon::now()->toDateTimeString()])) }}')"!-->
            ???:?????<?=$count?>????
            <span id="timeinfo"></span>

            @if($errMsg)
                <span id="errMsg" style="color:red;">{{ $errMsg }}</span>
            @endif
        </td>
    </tr>
</table>
</body>
</html>