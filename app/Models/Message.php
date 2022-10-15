<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    protected $guarded = ['id'];

    // 站内信列表
    public static $list_field = [
        // 'member_id' => ['name' => '会员id', 'type' => 'number', 'is_show' => true],
        'user_id' => ['name' => 'ID quản trị viên', 'type' => 'number', 'is_show' => true],

        'pid' => ['name' => 'ID tin nhắn cuối cùng','type' => 'number','is_show' => false],
        'url' => ['name' => 'Url','type' => 'string','is_show' => false],
        'title' => ['name' => 'Tiêu đề thư trang web','type' => 'string','is_show' => true],
        'content' => ['name' => 'Nội dung gửi','type' => 'string','is_show' => false],
        'visible_type' => ['name' => 'Loại có thể nhìn thấy','type' => 'select','is_show' => true,'data' => 'platform.message_visible_type'],
        'send_type' => ['name' => 'Loại gửi','type' => 'select','is_show' => true,'data' => 'platform.message_send_type'],
        'lang' => ['name' => '语言','type' => 'select','is_show' => false,'data' => 'platform.lang_fields'],
    ];

    // 会员站内信反馈
    public static $member_field = [
        'member_id' => ['name' => 'ID thành viên', 'type' => 'number', 'is_show' => true],
        'title' => ['name' => 'Tiêu đề thư trang web','type' => 'string','is_show' => true],
        'content' => ['name' => 'Nội dung gửi','type' => 'string','is_show' => true],
        'status' => ['name' => 'Trạng thái trả lời','type' => 'select','is_show' => true,'data' => 'platform.message_status']

    ];

    const VISIBLE_TYPE_ALL = 1; // 所有会员可见
    const VISIBLE_TYPE_MEMBER = 2; // 单个会员可见
    const VISIBLE_TYPE_ADMIN = 3; // 管理员可见

    const SEND_TYPE_ADMIN = 1;// 管理员发送
    const SEND_TYPE_MEMBER = 2;// 会员发送

    const STATUS_NOT_DEAL = 0;// 待回复
    const STATUS_DEALED = 1; // 已回复
    const STATUS_MARK_DEALED = 2; // 标记回复

    public $appends = ['format_created_at'];

    public function parent()
    {
        return $this->belongsTo('App\Models\Message','pid');
    }

    public function child(){
        return $this->hasMany('App\Models\Message','pid','id');
    }

    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }

    public function member()
    {
        return $this->belongsTo('App\Models\Member','member_id','id');
    }

    public function member_message(){
        return $this->hasMany('App\Models\MemberMessage','message_id','id');
    }

    public function getIsRepliedAttribute(){
        return $this->where('pid',$this->id)->count() > 0 ? true:false;
    }

    public function scopeMemberName($query,$name){
        return $name ? $query->whereHas('member',function($q) use($name){
            $q->where('name','like','%'.$name.'%');
        }) : $query;
    }

    public function scopeReplyStatus($query,$status){
        if($status == 1){
            return $query->whereHas('child');
        }else if($status == 0){
            return $query->doesntHave('child');
        }else{
            return $query;
        }
    }

    // 获取用户的未读信息
    public function scopeMemberRead($query,$member_id,$is_read){
        return $query->with('parent:id,title,content')->where('visible_type','!=',Message::VISIBLE_TYPE_ADMIN)
            ->whereHas('member_message',function($query) use ($member_id,$is_read){
                $query->where('is_read',$is_read)->where('member_id',$member_id);
            });
    }

    // public

    public function scopeMemberMessage($query, $member_id){
        // return $query->with('member_message:id,is_read');
        return $this->join('member_messages','member_messages.message_id','=','messages.id')
            ->with('parent:id,member_id,url,user_id,title,content,created_at')
            ->select([
                'messages.id','messages.title','messages.url','messages.content','messages.created_at',
                'member_messages.is_read','messages.pid','messages.user_id','member_messages.deleted_at'])
            ->where('member_messages.member_id',$member_id)
            ->where('member_messages.deleted_at',null)
            ->latest();
    }

    // public function getMemberMessageAttribute($member_id){
    //     return $this->member_message->where('member_id',$member_id)->first();
    // }

    protected function serializeDate(\DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }

    public function getFormatCreatedAtAttribute(){
        return $this->created_at->diffForHumans();
    }
}
