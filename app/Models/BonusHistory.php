<?php

namespace App\Models;

use Illuminate\Database\Eloquent\SoftDeletes;

class BonusHistory extends Base
{
    use SoftDeletes;

    public $table = 'bonus_histories';

    protected $fillable = [
        'member_id', 'product_type', 'game_type', 'game_id', 'game_provider', 'transfer_code', 'transaction_id', 'amount', 'bonus_time'
    ];

    public function member()
    {
        return $this->belongsTo(Member::class);
    }
}
