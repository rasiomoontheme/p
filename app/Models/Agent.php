<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Agent extends Model
{
    use SoftDeletes;

    protected $guarded = ['id'];

    public static $list_field = [
        'member_id' => ['name' => 'Mã thành viên','type' => 'text','is_show' => true,'validate' => 'required'],
        // 'agent_uri' => ['name' => '代理链接','type' => 'text','is_show' => true,'validate' => 'required'],
        'agent_pc_uri' => ['name' => 'Liên kết máy tính proxy','type' => 'text','is_show' => false],
        'agent_wap_uri' => ['name' => 'Liên kết WAP proxy','type' => 'text','is_show' => false],
        'agent_real_pc_url' => ['name' => 'Liên kết máy tính proxy','type' => 'text','is_show' => true],
        'agent_real_wap_url' => ['name' => 'Liên kết WAP proxy','type' => 'text','is_show' => true],
        'agent_uri_pre' => ['name' => 'Tiền tố liên kết proxy','type' => 'text','is_show' => true,'validate' => 'required'],
        'apply_data' => ['name' => 'Thông tin ứng dụng','type' => 'text','is_show' => false],
        'remark' => ['name' => 'Nhận xét','type' => 'text']
    ];

    const ASSIGN_TYPE_NEWER = 1; // 新建
    const ASSING_TYPE_OLDER = 2; // 旧账号

    public function member()
    {
        return $this->belongsTo('App\Models\Member');
    }

    public function getAgentRealPcUrlAttribute(){
        return $this->agent_pc_uri ? $this->agent_pc_uri : '【默认】'.$this->getAgentUri();
    }

    public function getAgentRealWapUrlAttribute(){
        return $this->agent_wap_uri ? $this->agent_wap_uri : '【默认】'.$this->getAgentUri(1);
    }

    public function getAgentUri($isMobile = ''){
        /**
        if($this->agent_pc_uri || $this->){
        return $this->agent_uri;
        }else{
        if(\Str::startsWith(systemconfig('site_domain'),'http')){

        }
        return is_Mobile() ? quicklink('wap_register') : quicklink('pc_register').'?i='.$this->member->invite_code;
        }**/
        if(!$this->member) return '';
        $isMobile = $isMobile ?? is_Mobile();
        return $isMobile ? ($this->agent_wap_uri ?? quicklink('wap_register').'?i='.$this->member->invite_code ) : ($this->agent_pc_uri ?? quicklink('pc_register').'?i='.$this->member->invite_code);
    }

    public function yjlogs(){
        return $this->hasMany('App\Models\AgentYjLog','agent_id','id');
    }
}
