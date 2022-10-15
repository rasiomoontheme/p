<?php

namespace App\Http\Controllers\Backend\Admin;

use App\Http\Controllers\Controller;
use App\Models\BankCard;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class BankCardsController extends AdminBaseController
{
    protected $create_field = ['card_no','card_type','bank_type','phone','owner_name','bank_address','is_open'];
    protected $update_field = ['card_no','card_type','bank_type','phone','owner_name','bank_address','is_open'];

    public function __construct(BankCard $model){
        $this->model = $model;
        parent::__construct();
    }

    public function edit(BankCard $bankcard){
        return view($this->getEditViewName(),["model" => $bankcard]);
    }

    public function storeRule(){
        return [
			"card_no" => "required",
			"card_type" => Rule::in(array_keys(config('platform.card_type'))),
            "bank_type" => Rule::in(array_keys(config('platform.bank_type'))),
            "owner_name" => "required|min:2",
			"is_open" => ["required",Rule::in(array_keys(config('platform.is_open')))],
		];
    }

    public function updateRule($id){
        return [
			"card_no" => "required",
			"card_type" => Rule::in(array_keys(config('platform.card_type'))),
            "bank_type" => Rule::in(array_keys(config('platform.bank_type'))),
            "owner_name" => "required|min:2",
			"is_open" => ["required",Rule::in(array_keys(config('platform.is_open')))],
		];
    }
}
