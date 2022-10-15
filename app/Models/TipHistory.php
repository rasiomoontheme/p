<?php

namespace App\Models;

use Illuminate\Database\Eloquent\SoftDeletes;

class TipHistory extends Base
{
    use SoftDeletes;

    public $table = 'tip_histories';

    protected $fillable = [
        'member_id', 'product_type', 'game_type', 'game_provider', 'transfer_code', 'transaction_id', 'amount', 'tip_time'
    ];

    public function member()
    {
        return $this->belongsTo(Member::class);
    }
}
