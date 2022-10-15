<?php

namespace App\Console\Commands;

use App\Models\Api;
use App\Models\GameList;
use App\Models\SystemConfig;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

class GetGameList extends Command
{
    protected $signature = 'get-game-list';

    protected $description = 'Get list game';
    protected $config;
    public $gameType = [];
    public $gameTypeOther = 7; // map with platform.php

    public function __construct()
    {
        $this->config = SystemConfig::getConfigGroup('remote_api');
        parent::__construct();
    }

    public function handle()
    {
        $gameType = config('platform.game_type_other');
        foreach ($gameType as $key => $type) {
            $gameType[$key] = strtolower(Str::slug($type));
        }
        $this->gameType = $gameType;

        try {
            $providercodes = Api::query()->pluck('api_name')->toArray();
            $urlapi = configPlatform('domain_api');
            $operatorcode = $this->config['remote_api_id'];
            $sercretkey = $this->config['remote_api_key'];
            $listGameInsert = [];

            foreach ($providercodes as $providercode) {
                $tmp = [];
                $signature = strtoupper(MD5($operatorcode.$providercode.$sercretkey));

                $dataQuery = array(
                    'operatorcode' => $operatorcode,
                    'providercode' => $providercode,
                    'signature' => $signature,
                    'reformatJson' => 'no',
                );
                $url = "$urlapi/getGameList.aspx?" . http_build_query($dataQuery);

                $result = $this->curl_geturl($url);
                $res = json_decode($result, true);
                if (!empty($res['gamelist'])) {
                    $listGame = json_decode($res['gamelist']);
                    foreach ($listGame as $game) {
                        $game = (array)$game;
                        $game['api_name'] = $providercode;
                        array_push($tmp, $game);
                    }
                    $listGameInsert[$providercode] = $tmp;
                }
            }

            $this->storeGameListAG(data_get($listGameInsert, 'AG', []));
            $this->storeGameListPR(data_get($listGameInsert, 'PR', []));
            $this->storeGameListVV(data_get($listGameInsert, 'VV', []));
            $this->storeGameListPZ(data_get($listGameInsert, 'PZ', []));
            $this->storeGameListDS(data_get($listGameInsert, 'DS', []));
            $this->storeGameListSY(data_get($listGameInsert, 'SY', []));
            $this->storeGameListCQ(data_get($listGameInsert, 'CQ', []));
            $this->storeGameListJD(data_get($listGameInsert, 'JD', []));
            $this->storeGameListFK(data_get($listGameInsert, 'FK', []));
            $this->storeGameListPG(data_get($listGameInsert, 'PG', []));
            $this->storeGameListWM(data_get($listGameInsert, 'WM', []));
            $this->storeGameListG8(data_get($listGameInsert, 'G8', []));
            $this->storeGameListCE(data_get($listGameInsert, 'CE', []));

            Log::info('SUCCESS: Get list game success at: ', [date('d-m-Y H:i:s')]);
        } catch (\Exception $e) {
            Log::info('ERROR: Get list game error at: ', [date('d-m-Y H:i:s')]);
            Log::error($e);
        }
    }

    public function curl_geturl($url)
    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
        //curl_setopt($ch, CURLOPT_POST, 1);
        $data = curl_exec($ch);
        curl_close($ch);
        return $data;
    }

    public function storeGameListAG($listGame)
    {
        foreach ($listGame as $game) {
            $entity = GameList::where('game_code', data_get($game, 'Mode1Code'))->where('api_name', data_get($game, 'api_name'))->first();
            if (!empty($entity)) {
                continue;
            }
            GameList::create([
                'api_name' => data_get($game, 'api_name'),
                'name' => data_get($game, 'NameCN'),
                'en_name' => data_get($game, 'Name'),
                'game_code' => data_get($game, 'Mode1Code'),
                'game_type' => array_search(strtolower(Str::slug(data_get($game, 'category'))), $this->gameType)
            ]);
        }
    }

    public function storeGameListPR($listGame)
    {
        foreach ($listGame as $game) {
            $entity = GameList::where('game_code', data_get($game, 'gameID'))->where('api_name', data_get($game, 'api_name'))->first();
            if (!empty($entity)) {
                continue;
            }
            GameList::create([
                'api_name' => data_get($game, 'api_name'),
                'name' => data_get($game, 'gameName'),
                'en_name' => data_get($game, 'gameName'),
                'game_code' => data_get($game, 'gameID'),
                'game_type' => array_search(strtolower(Str::slug(data_get($game, 'typeDescription'))), $this->gameType),
                'platform' => data_get($game, 'platform'),
            ]);
        }
    }

    public function storeGameListVV($listGame)
    {
        return;
    }

    public function storeGameListPZ($listGame)
    {
        foreach ($listGame as $game) {
            $entity = GameList::where('game_code', data_get($game, 'Game Code'))->where('api_name', data_get($game, 'api_name'))->first();
            $gameType = array_search(strtolower(Str::slug(data_get($game, 'Game Type'))), $this->gameType);
            if (empty($gameType)) {
                $gameType = array_search(strtolower(Str::slug(data_get($game, 'Game Group'))), $this->gameType);
            }
            if (!empty($entity)) {
                continue;
            }
            GameList::create([
                'api_name' => data_get($game, 'api_name'),
                'name' => data_get($game, 'name_CN'),
                'en_name' => data_get($game, 'name_EN'),
                'game_code' => data_get($game, 'Game Code'),
                'game_type' => !empty($gameType) ? $gameType : $this->gameTypeOther
            ]);
        }
    }

    public function storeGameListDS($listGame)
    {
        foreach (data_get($listGame, 1, []) as $game) {
            $game = (array)$game;
            $entity = GameList::where('game_code', data_get($game, 'id'))->where('api_name', "DS")->first();
            if (!empty($entity)) {
                continue;
            }
            GameList::create([
                'api_name' => "DS",
                'name' => data_get((array)(data_get($game, 'names')), 'zh_cn'),
                'en_name' => data_get((array)(data_get($game, 'names')), 'en_us'),
                'game_code' => data_get($game, 'id'),
                'game_type' => data_get($game, 'type', $this->gameTypeOther)
            ]);
        }
    }

    public function storeGameListSY($listGame)
    {
        foreach ($listGame as $game) {
            $entity = GameList::where('game_code', data_get($game, 'gameid'))->where('api_name', data_get($game, 'api_name'))->first();
            if (!empty($entity)) {
                continue;
            }
            GameList::create([
                'api_name' => data_get($game, 'api_name'),
                'name' => data_get($game, 'gamenamecn'),
                'en_name' => data_get($game, 'gamenameen'),
                'game_code' => data_get($game, 'gameid'),
                'game_type' => array_search(strtolower(Str::slug(data_get($game, 'gameCAT'))), $this->gameType)
            ]);
        }
    }

    public function storeGameListCQ($listGame)
    {
        foreach (data_get($listGame, 0, []) as $game) {
            $game = (array)$game;
            $entity = GameList::where('game_code', data_get($game, 'gamecode'))->where('api_name', "CQ")->first();
            if (!empty($entity)) {
                continue;
            }
            GameList::create([
                'api_name' => "CQ",
                'name' => data_get($game, 'gamename'),
                'en_name' => data_get($game, 'gamename'),
                'game_code' => data_get($game, 'gamecode'),
                'game_type' => array_search(strtolower(Str::slug(data_get($game, 'gametype') . '-game')), $this->gameType)
            ]);
        }
    }

    public function storeGameListJD($listGame)
    {
        return;
    }

    public function storeGameListFK($listGame)
    {
        foreach (data_get($listGame, 2, []) as $game) {
            $game = (array)$game;
            $entity = GameList::where('game_code', data_get($game, 'gameCode'))->where('api_name', "FK")->first();
            if (!empty($entity)) {
                continue;
            }
            GameList::create([
                'api_name' => "FK",
                'name' => data_get($game, 'gameName'),
                'en_name' => data_get($game, 'gameName'),
                'game_code' => data_get($game, 'gameCode'),
                'img_path' => data_get($game, 'demoGameUrl'),
                'game_type' => array_search(strtolower(Str::slug(data_get($game, 'gameTypeDescription'))), $this->gameType)
            ]);
        }
    }

    public function storeGameListPG($listGame)
    {
        foreach ($listGame as $game) {
            $entity = GameList::where('game_code', data_get($game, 'gameCode'))->where('api_name', data_get($game, 'api_name'))->first();
            if (!empty($entity)) {
                continue;
            }
            GameList::create([
                'api_name' => data_get($game, 'api_name'),
                'name' => data_get($game, 'gameName'),
                'en_name' => data_get($game, 'gameName'),
                'game_code' => data_get($game, 'gameCode'),
                'game_type' => $this->gameTypeOther
            ]);
        }
    }

    public function storeGameListWM($listGame)
    {
        foreach ($listGame as $game) {
            $entity = GameList::where('game_code', data_get($game, 'Code'))->where('api_name', data_get($game, 'api_name'))->first();
            if (!empty($entity)) {
                continue;
            }
            GameList::create([
                'api_name' => data_get($game, 'api_name'),
                'name' => data_get($game, 'Name'),
                'en_name' => data_get($game, 'Name'),
                'game_code' => data_get($game, 'Code'),
                'img_path' => data_get($game, 'ThumbnailUrl'),
                'game_type' => array_search(strtolower(Str::slug(data_get($game, 'GameType'))), $this->gameType)
            ]);
        }
    }

    public function storeGameListG8($listGame)
    {
        foreach ($listGame as $game) {
            $entity = GameList::where('game_code', data_get($game, 'gameid (Game Loader)'))->where('api_name', data_get($game, 'api_name'))->first();
            if (!empty($entity)) {
                continue;
            }
            GameList::create([
                'api_name' => data_get($game, 'api_name'),
                'name' => data_get($game, 'Chinese Name'),
                'en_name' => data_get($game, 'Game'),
                'game_code' => data_get($game, 'gameid (Game Loader)'),
                'game_type' => 3
            ]);
        }
    }

    public function storeGameListCE($listGame)
    {
        foreach ($listGame as $game) {
            $entity = GameList::where('game_code', data_get($game, 'gameCode'))->where('api_name', data_get($game, 'api_name'))->first();
            if (!empty($entity)) {
                continue;
            }
            GameList::create([
                'api_name' => data_get($game, 'api_name'),
                'name' => data_get($game, 'langZHCN'),
                'en_name' => data_get($game, 'langENUS'),
                'game_code' => data_get($game, 'gameid (Game Loader)'),
                'game_type' => array_search(strtolower(Str::slug(data_get($game, 'category'))), $this->gameType)
            ]);
        }
    }
}
