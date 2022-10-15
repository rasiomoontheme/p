<?php

namespace App\Http\Controllers\Backend\Admin;

use App\Http\Controllers\Controller;
use App\Models\ApiGame;
use App\Models\BetHistories;
use App\Models\GameRecord;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class GameRecordsController extends AdminBaseController
{
    protected $create_field = ['billno','api_name','name','betAmount','validBetAmount','netAmount','gameType','flag','betTime'];
    protected $update_field = ['billno','api_name','name','betAmount','validBetAmount','netAmount','gameType','flag','betTime'];

    public function __construct(GameRecord $model){
        $this->model = $model;
        parent::__construct();
    }

    /*
    public function index(Request $request)
    {
        $params = $request->all();
        $data = $this->model
            ->where($this->convertWhere($params))
            ->latest()
            ->paginate(5);
        return view("{$this->view_folder}.index", compact('data', 'params'));
    }
    */

    public function index(Request $request)
    {
        $params = $request->all();
        $query = BetHistories::with('member', 'apiGame');

        if (request('member_name')) {
            $query->where('member_name', 'like', '%' . request('member_name') . '%');
        }

        if (request('member_id')) {
            $query->where('member_id', request('member_id'));
        }

        if (request('result_bet_status')) {
            $query->where('result_bet_status', request('result_bet_status'));
        }

        if (request('api_name')) {
            $query->where('api_name', request('api_name'));
        }

        if (request('bet_product')) {
            $query->where('bet_product', request('bet_product'));
        }

        $data = $query->orderBy(BetHistories::getTableName() . '.id', 'desc')->paginate(apiPaginate());

        return view('admin.gamerecord.index', compact('data', 'params'));
    }

    public function destroy(Request $request, $id)
    {
        $id = $request->get("ids") ?? $id;

        if (BetHistories::whereIn('id', $id)->delete()) {
            return $this->success(["reload" => true], trans('res.base.delete_success'));
        }

        return $this->failed(trans('res.base.delete_fail'));
    }
}
