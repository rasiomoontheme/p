<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class MemberMessage extends Model
{
    use SoftDeletes;

    protected $guarded = ['id'];

    protected $appends = ['is_read_text'];

    public function getIsReadTextAttribute(){
        return isset_and_not_empty(config('platform.is_read'),$this->attributes['is_read'],$this->attributes['is_read']);
    }

    public function member()
    {
        return $this->belongsTo('App\Models\Member');
    }

    public function message()
    {
        return $this->belongsTo('App\Models\Message');
    }

    protected function serializeDate(\DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }
}
