<?php

namespace App\Http\Controllers\Backend\Admin;

use App\Exceptions\InvalidRequestException;
use App\Http\Controllers\Controller;
use App\Models\MemberMessage;
use App\Models\Message;
use App\Models\Member;
use App\Models\Base;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;

class MessagesController extends AdminBaseController
{
    protected $create_field = ['member_id','pid','url','title','content','visible_type','send_type','lang'];
    protected $update_field = ['member_id','pid','url','title','content','visible_type','send_type','lang'];

    public function __construct(Message $model){
        $this->model = $model;
        parent::__construct();
    }

    public function index(Request $request)
    {
        $params = $request->all();
        $params['send_type'] = Message::SEND_TYPE_ADMIN;

        $data = $this->model->where($this->convertWhere($params))->latest()->paginate(5);
        return view("{$this->view_folder}.index", compact('data', 'params'));
    }

    // $data = ['member_id' => 1,'title' => '测试标题','content' => '测试反馈信息','send_type' => 2];
    // App\Models\Message::create(['member_id' => 1,'title' => '测试标题','content' => '测试反馈信息','send_type' => 2,'visible_type' => 3])
    public function index_member(Request $request){
        $params = $request->all();
        $params['send_type'] = Message::SEND_TYPE_MEMBER;

        $params = array_filter($params,function($temp){
            return $temp !== null;
        });

        $data = $this->model->with('child')
            ->replyStatus(isset_and_not_empty($params,'reply_status',-1))
            ->memberName(isset_and_not_empty($params,'member_name',''))
            ->where($this->convertWhere($params))->latest()->paginate(5);
        return view('admin.message.index_member', compact('data', 'params'));
    }

    public function edit(Message $message){
        return view($this->getEditViewName(),["model" => $message]);
    }

    public function storeRule(){
        return [
            "title" => "required|min:2",
            "content" => "required|min:2",
			"visible_type" => ['required',Rule::in(array_keys(config('platform.message_visible_type')))],
		];
    }

    protected function storeHandle($data)
    {
        if($data['visible_type'] == Message::VISIBLE_TYPE_MEMBER){
            if(!$data['member_id']) throw new InvalidRequestException(trans('res.message.msg.member_select_required'));
            $data['lang'] = Member::find($data['member_id'])->lang ?? Base::LANG_CN;
        }else{
            $data['member_id'] = 0;
        }
        $data['send_type'] = Message::SEND_TYPE_ADMIN;
        $data['user_id'] = $this->guard()->user()->id;
        return $data;
    }

    public function updateRule($id){
        return [
            "title" => "required|min:2",
			"content" => "required|min:2",
			"visible_type" => ['required',Rule::in(array_keys(config('platform.message_visible_type')))],
		];
    }

    public function reply(Message $message,Request $request){
        return view('admin.message.reply',['model' => $message]);
    }

    public function post_reply(Message $message, Request $request){
        // if($message->child) return $this->failed('已经回复过该信息');

        $data = $request->only(['content', 'title', 'url']);

        $this->validateRequest($data, [
            "title" => "required|min:2",
			"content" => "required|min:2",
        ]);

        $data = array_filter($data,function($temp){
            return $temp !== null;
        });

        $data['member_id'] = $message->member_id;
        $data['send_type'] = Message::SEND_TYPE_ADMIN;
        $data['visible_type'] = Message::VISIBLE_TYPE_MEMBER;
        $data['pid'] = $message->id;
        $data['user_id'] = $this->guard()->user()->id;

        try{
            DB::transaction(function() use ($data,$message){
                Message::create($data);

                if($message->status != Message::STATUS_DEALED){
                    $message->update([
                        'status' => Message::STATUS_DEALED
                    ]);
                }

            });
        }catch(Exception $e){
            DB::rollback();
            return $this->failed('回复失败:'+$e->getMessage());
        }
        return $this->success(['close_reload' => true],trans('res.base.operate_success'));
    }

    // 批量标记已读
    public function post_mark_deal(Request $request){

        // 获取 ids 参数
        $ids = $request->get('ids');
        $ids = is_array($ids) ? $ids : [$ids];

        if(!count($ids)) return $this->failed(trans('res.message.msg.data_select_required'));

        if(Message::whereIn('id',$ids)->where('status',Message::STATUS_NOT_DEAL)->update([
            'status' => Message::STATUS_MARK_DEALED
        ])){
            return $this->success(['reload' => true],trans('res.base.operate_success'));
        }else{
            return $this->failed(trans('res.api.common.operate_again'));
        }
    }

    public function history(Message $message){
        return view('admin.message.history',['model' => $message]);
    }
}
