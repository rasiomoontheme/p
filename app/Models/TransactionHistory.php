<?php

namespace App\Models;

use Illuminate\Database\Eloquent\SoftDeletes;

class TransactionHistory extends Base
{
    use SoftDeletes;

    public $table = 'transaction_histories';

    protected $fillable = [
        'member_id', 'product_type', 'game_type', 'game_id', 'game_provider', 'game_round_id', 'game_period_id',
        'transfer_code', 'transaction_id', 'amount', 'win_loss', 'transaction_time', 'result_time', 'return_stake_time',
        'rollback_time', 'cancel_time', 'order_detail', 'game_type_name', 'section', 'ip', 'status'
    ];

    const STATUS_WAITING = 9;
    const STATUS_WIN = 0;
    const STATUS_LOST = 1;
    const STATUS_TIE = 2;
    const STATUS_CANCEL = 3;
    const STATUS_RETURN_STAKE = 4;
    const STATUS_LIVE_COIN = 5;

    public function member()
    {
        return $this->belongsTo(Member::class);
    }

    public function apiGame()
    {
        return $this->belongsTo(ApiGame::class, 'game_id', 'id');
    }
}
