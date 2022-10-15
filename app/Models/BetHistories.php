<?php

namespace App\Models;

use Illuminate\Database\Eloquent\SoftDeletes;

class BetHistories extends Base
{
    use SoftDeletes;

    public $table = 'bet_histories';

    protected $fillable = [
        'bet_id', 'bet_ref_no', 'bet_product', 'api_name', 'member_id', 'bet_game_id', 'bet_start_time', 'bet_end_time',
        'turnover', 'bet', 'payout', 'commission', 'status', 'result_bet_status', 'versionkey', 'member_name'
    ];

    const STATUS_VALID = 1;
    const STATUS_RUNNING = 0;
    const STATUS_INVALID = -1;

    const RESULT_BET_STATUS_WIN = 1;
    const RESULT_BET_STATUS_LOSE = 2;
    const RESULT_BET_STATUS_DRAW = 3;

    public function member()
    {
        return $this->belongsTo(Member::class);
    }

    public function apiGame()
    {
        return $this->belongsTo(ApiGame::class);
    }

    public function api()
    {
        return $this->belongsTo(Api::class, 'api_name', 'api_name');
    }

    public function getMemberName()
    {
        return $this->member ? $this->member->name : '';
    }

    public function getApiGameTitle()
    {
        return !empty($this->apiGame->api->api_title) ? $this->apiGame->api->api_title : '';
    }

    public function getBetStatus()
    {
        $win = '<span class="label label-success">Thắng</span>';
        $lost = '<span class="label label-warning">Thua</span>';
        $draw = '<span class="label label-dark">Hòa</span>';

        switch ($this->result_bet_status) {
            case BetHistories::RESULT_BET_STATUS_WIN:
                $label = $win;
                break;
            case BetHistories::RESULT_BET_STATUS_LOSE:
                $label = $lost;
                break;
            case BetHistories::RESULT_BET_STATUS_DRAW:
                $label = $draw;
                break;
            default:
                $label = null;
                break;
        }
        return $label;
    }

    public function getGameStatus()
    {
        $valid = '<span class="label label-success">Hợp lệ</span>';
        $running = '<span class="label label-dark">Đang cược</span>';
        $invalid = '<span class="label label-warning">Không hợp lệ</span>';
        switch ($this->status) {
            case BetHistories::STATUS_VALID:
                $label = $valid;
                break;
            case BetHistories::STATUS_RUNNING:
                $label = $running;
                break;
            case BetHistories::STATUS_INVALID:
                $label = $invalid;
                break;
            default:
                $label = null;
                break;
        }
        return $label;
    }

    public function getBetStartTime()
    {
        return $this->bet_start_time ? date('d-m-Y H:i:s', strtotime($this->bet_start_time)) : null;
    }

    public function getBetEndTime()
    {
        return $this->bet_end_time ? date('d-m-Y H:i:s', strtotime($this->bet_end_time)) : null;
    }
}