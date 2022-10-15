<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    public $guarded = ['id'];

    public static $list_field = [
        'title' => ['name' => 'Chức danh nhiệm vụ','type' => 'text','is_show' => true],
        'condition_type' => ['name' => 'Điều kiện nhiệm vụ','type' => 'select','is_show' => 'true','data' => 'platform.task_condition_types'],
        'condition_number' => ['name' => 'Số nhiệm vụ đã hoàn thành mỗi ngày','type' => 'number'],
        'condition_money' => ['name' => 'Số tiền tình trạng hoàn thành','type' => 'number','is_show' => true],
        'condition_day' => ['name' => 'Số ngày tích lũy để hoàn thành nhiệm vụ','type' => 'number'],
        'award_type' => ['name' => 'Loại phần thưởng','type' => 'select','data' => 'platform.task_award_type','is_show' => true],
        //'award_number' => ['name' => '奖励可领取次数','type' => 'number'],
        //'award_money' => ['name' => '奖励金额','type' => 'number'],
        'award_content' => ['name' => 'Nội dung thưởng','type' => 'string'],
        //'award_per_day' => ['name' => '奖励间隔天数','type' => 'number'],
        //'award_name' => ['name' => '奖励称号','type' => 'string'],
        'remark' => ['name' => 'Nhận xét','type' => 'string']
    ];

    const TYPE_SINGLE_RECHARGE = 1; // 单笔充值
    const TYPE_SUM_RECHARGE = 2; // 累计充值
    const TYPE_SUM_DRAWING = 3; // 累计提款
    const TYPE_SUM_PROFIT = 4; // 累计盈利
    const TYPE_SUM_LOSS = 5;// 累计亏损
    const TYPE_SUM_TRANSACTION = 6; // 累计流水

    const AWARD_TYPE_NAME = 1;// 称号奖励
    const AWARD_TYPE_MONEY = 2; // 金额奖励
    const AWARD_TYPE_FD = 3;// 返点奖励
    const AWARD_TYPE_BORROW = 4;// 信用额度奖励

    const LEVEL_TYPE_LEVEL = 'level_award'; // 等级礼金 可领取次数为1，间隔天数随意
    const LEVEL_TYPE_WEEK = 'week_award'; // 周俸禄 可领取次数为0，间隔天数为7
    const LEVEL_TYPE_MONTH = 'month_award'; // 月俸禄 可领取次数为0，间隔天数为30
    const LEVEL_TYPE_NAME = 'name_award'; // 称号奖励
    const LEVEL_TYPE_BORROW = 'borrow_award'; // 信用额度奖励，可领取次数为1，间隔天数不限

    // 金额奖励时： {"money":"1","money_times":"1","money_per_day":"2"}
    // 返点奖励时 game_type,fd_percent
    public function getAwardContentAttribute(){
        return json_decode($this->attributes['award_content'],1);
    }

    // 获取任务的奖励描述
    public function getTaskDescription(){
        if($this->award_type == self::AWARD_TYPE_MONEY){
            return "【现金奖励】获得现金".$this->award_content['money']."元";
        }else if($this->award_type == self::AWARD_TYPE_FD){
            return "【返点奖励】您游戏类型【".config('platform.game_type')[$this->award_content['game_type']]."】的返点比例已提升至".$this->award_content['fd_percent']."%";
        }
        return "";
    }

    public function membertasks(){
        return $this->hasMany('App\Models\MemberTask','task_id','id');
    }

    public function scopeSystemLevel($query){
        return $query->where('level','>',0)->whereIn('level_award_type',array_keys(config('platform.level_award_type')));
    }

    public function scopeNotSystem($query){
        return $query->where('level','')->where('level_award_type','');
    }

    // 判断是否是 系统晋级奖励
    public function isSystemTask(){
        return ($this->level > 0) && in_array($this->level_award_type, array_keys(config('platform.level_award_type')));
    }

    public function scopeSystemLevelAndType($query,$level,$type){
        return $query->where('level',$level)->where('level_award_type',$type);
    }

    public function getLevelDataByType($level,$ml_money,$award_money,$type){
        switch ($type){
            case self::LEVEL_TYPE_LEVEL:
                return $this->getLevelAwardData($level,$ml_money,$award_money);
                break;
            case self::LEVEL_TYPE_WEEK:
                return $this->getLevelWeekData($level,$ml_money,$award_money);
                break;
            case self::LEVEL_TYPE_MONTH:
                return $this->getLevelMonthData($level,$ml_money,$award_money);
                break;
            case self::LEVEL_TYPE_NAME:
                return $this->getLevelNameData($level,$ml_money);
                break;
            case self::LEVEL_TYPE_BORROW:
                return $this->getLevelBorrowData($level,$ml_money,$award_money);
                break;
        }
    }

    public function getLevelAwardData($level,$ml_money,$award_money){
        return [
            'title' => "第{$level}级".config('platform.level_award_type')[self::LEVEL_TYPE_LEVEL],
            'condition_type' => self::TYPE_SUM_TRANSACTION,
            'condition_number' => 0,
            'condition_money' => $ml_money,
            'condition_day' => 1,
            'award_type' => self::AWARD_TYPE_MONEY,
            'award_content' => json_encode([
                "money" => $award_money,
                "money_times" => 1,
                "money_per_day" => 0
            ]),
            'level' => $level,
            'level_award_type' => self::LEVEL_TYPE_LEVEL,
            'remark' => "第{$level}级".config('platform.level_award_type')[self::LEVEL_TYPE_LEVEL]
        ];
    }

    public function getLevelWeekData($level,$ml_money,$award_money){
        return [
            'title' => "第{$level}级".config('platform.level_award_type')[self::LEVEL_TYPE_WEEK],
            'condition_type' => self::TYPE_SUM_TRANSACTION,
            'condition_number' => 0,
            'condition_money' => $ml_money,
            'condition_day' => 1,
            'award_type' => self::AWARD_TYPE_MONEY,
            'award_content' => json_encode([
                "money" => $award_money,
                "money_times" => 0,
                "money_per_day" => 7
            ]),
            'level' => $level,
            'level_award_type' => self::LEVEL_TYPE_WEEK,
            'remark' => "第{$level}级".config('platform.level_award_type')[self::LEVEL_TYPE_WEEK]
        ];
    }

    public function getLevelMonthData($level,$ml_money,$award_money){
        return [
            'title' => "第{$level}级".config('platform.level_award_type')[self::LEVEL_TYPE_MONTH],
            'condition_type' => self::TYPE_SUM_TRANSACTION,
            'condition_number' => 0,
            'condition_money' => $ml_money,
            'condition_day' => 1,
            'award_type' => self::AWARD_TYPE_MONEY,
            'award_content' => json_encode([
                "money" => $award_money,
                "money_times" => 0,
                "money_per_day" => 30
            ]),
            'level' => $level,
            'level_award_type' => self::LEVEL_TYPE_MONTH,
            'remark' => "第{$level}级".config('platform.level_award_type')[self::LEVEL_TYPE_MONTH]
        ];
    }

    public function getLevelBorrowData($level,$ml_money,$award_money){
        return [
            'title' => "第{$level}级".config('platform.level_award_type')[self::LEVEL_TYPE_BORROW],
            'condition_type' => self::TYPE_SUM_TRANSACTION,
            'condition_number' => 0,
            'condition_money' => $ml_money,
            'condition_day' => 1,
            'award_type' => self::AWARD_TYPE_BORROW,
            'award_content' => json_encode([
                "money" => $award_money,
                "money_times" => 1,
                "money_per_day" => 0
            ]),
            'level' => $level,
            'level_award_type' => self::LEVEL_TYPE_BORROW,
            'remark' => "第{$level}级".config('platform.level_award_type')[self::LEVEL_TYPE_BORROW]
        ];
    }

    public function getLevelNameData($level,$ml_money){
        return [
            'title' => "第{$level}级".config('platform.level_award_type')[self::LEVEL_TYPE_NAME],
            'condition_type' => self::TYPE_SUM_TRANSACTION,
            'condition_number' => 0,
            'condition_money' => $ml_money,
            'award_type' => self::AWARD_TYPE_NAME,
            'level' => $level,
            'level_award_type' => self::LEVEL_TYPE_NAME,
            'remark' => "第{$level}级".config('platform.level_award_type')[self::LEVEL_TYPE_NAME]
        ];
    }
}