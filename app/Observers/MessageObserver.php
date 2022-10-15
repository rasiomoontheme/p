<?php

namespace App\Observers;

use App\Models\MemberMessage;
use App\Models\Message;

class MessageObserver
{
    // 删除消息的时候，同时删除用户的提醒
    public function deleting(Message $message){
        if($message->member_message){
            MemberMessage::destroy($message->member_message->pluck('id')->toArray());
        }
    }

    // 创建时，如果是单独发送给用户，则创建member_message
    public function created(Message $message){
        if($message->visible_type == Message::VISIBLE_TYPE_MEMBER && $message->member_id){
            MemberMessage::create([
                'member_id' => $message->member_id,
                'message_id' => $message->id
            ]);
        }
    }
}
