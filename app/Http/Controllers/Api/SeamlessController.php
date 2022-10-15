<?php

namespace App\Http\Controllers\Api;

use App\Models\BonusHistory;
use App\Models\SystemConfig;
use App\Models\TransactionHistory;
use App\Models\Member;
use App\Models\TipHistory;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

/**
 * Seamless Wallet Flow
 *
 * Class SeamlessController
 * @package App\Http\Controllers\Api
 */
class SeamlessController extends MemberBaseController
{
    protected $params = null;

    protected $member = null;

    protected $memberModel = null;

    protected $transactionHistoryModel = null;

    protected $tipHistoryModel = null;

    protected $bonusHistoryModel = null;

    public function __construct()
    {
        parent::__construct();
        $this->setParams(request()->all());
        $this->memberModel = app(Member::class);
        $this->transactionHistoryModel = app(TransactionHistory::class);
        $this->tipHistoryModel = app(TipHistory::class);
        $this->bonusHistoryModel = app(BonusHistory::class);
    }

    public function setParams($params = [])
    {
        $this->params = $params;
    }

    public function getParam($key = null)
    {
        return data_get($this->params, $key);
    }

    public function getParams()
    {
        return $this->params;
    }

    /**
     * Get member's balance
     * @return \Illuminate\Http\JsonResponse
     */
    public function getBalance()
    {
        // validate params
        $valid = $this->validateUser();
        if ($valid !== true) {
            return $valid;
        }

        // return member's balance
        return $this->respond([
            'AccountName' => $this->getParam('Username'),
            'Balance' => $this->member->money,
            'ErrorCode' => getConst('ERROR_CODE.NO_ERROR'),
            'ErrorMessage' => "No Error"
        ]);
    }

    /**
     * Bet process
     * @return \Illuminate\Http\JsonResponse
     */
    public function deduct()
    {
        // validate params
        $valid = $this->validateUser();
        if ($valid !== true) {
            return $valid;
        }

        // check balance
        if (blank($this->member->money) || $this->member->money < $this->getParam('Amount')) {
            return $this->respond([
                'AccountName' => $this->getParam('Username'),
                'Balance' => 0,
                'ErrorCode' => getConst('ERROR_CODE.NOT_ENOUGH_BALANCE'),
                'ErrorMessage' => "Not enough balance"
            ]);
        }

        // get history from db
        $conditions = [];
        $history = $this->getTransactionHistory($conditions);
        if (!blank($history)) {
            // check status
            // Sport game & Virtual Sport game can't deduct twice
            // 3rd Wan Mei (Seamless game provider) can deduct twice but with different transactionId
            $checkStatus = $this->getParam('TransactionId') == $history->transaction_id && in_array($history->status, [TransactionHistory::STATUS_WIN, TransactionHistory::STATUS_LOST, TransactionHistory::STATUS_TIE, TransactionHistory::STATUS_CANCEL]);
            $checkSportGame = in_array($this->getParam('ProductType'), [getConst('PRODUCT_TYPE.SPORT_BOOK'), getConst('PRODUCT_TYPE.VIRTUAL_SPORTS')]);
            $checkSeamlessGame = $this->getParam('ProductType') == getConst('PRODUCT_TYPE.SEAMLESS_GAME_PROVIDER') && $this->getParam('TransactionId') == $history->transaction_id;
            if ($checkStatus || $checkSportGame || $checkSeamlessGame) {
                return $this->respond([
                    'AccountName' => $this->getParam('Username'),
                    'Balance' => 0,
                    'ErrorCode' => getConst('ERROR_CODE.BET_REFNO_EXIST'),
                    'ErrorMessage' => "Bet With Same RefNo Exists"
                ]);
            }
            // Casino and RNG Game (SBO Game) can deduct twice but but 2nd deduct amount must be greater than 1st deduct
            if (in_array($this->getParam('ProductType'), [getConst('PRODUCT_TYPE.SBO_GAME'), getConst('PRODUCT_TYPE.SBO_LIVE_CASINO')]) && $this->getParam('Amount') < $history->amount) {
                return $this->respond([
                    'AccountName' => $this->getParam('Username'),
                    'Balance' => 0,
                    'ErrorCode' => getConst('ERROR_CODE.INTERNAL_ERROR'),
                    'ErrorMessage' => "Internal Error"
                ]);
            }
        }
        if (blank($history) || $this->getParam('TransactionId') != $history->transaction_id) {
            $history = $this->transactionHistoryModel;
        }

        DB::beginTransaction();
        try {
            // bet process
            $diffAmount = $this->getParam('Amount');
            if ($history->id) {
                $diffAmount = $this->getParam('Amount') - $history->amount;
            }
            $history->member_id = $this->member->id;
            $history->product_type = $this->getParam('ProductType');
            $history->game_type = $this->getParam('GameType');
            $history->game_id = $this->getParam('GameId');
            $history->game_provider = $this->getParam('Gpid');
            $history->game_round_id = $this->getParam('GameRoundId');
            $history->game_period_id = $this->getParam('GamePeriodId');
            $history->transfer_code = $this->getParam('TransferCode');
            $history->transaction_id = $this->getParam('TransactionId');
            $history->amount = $this->getParam('Amount');
            $history->transaction_time = $this->parseTime($this->getParam('BetTime'));
            $history->order_detail = $this->getParam('OrderDetail');
            $history->game_type_name = $this->getParam('GameTypeName');
            $history->ip = $this->getParam('PlayerIp');
            $history->status = TransactionHistory::STATUS_WAITING;
            $history->save();

            // update db and response
            $this->member->money = $this->member->money - $diffAmount;
            $this->member->save();
            DB::commit();

            return $this->respond([
                'AccountName' => $this->getParam('Username'),
                'Balance' => $this->member->money,
                'ErrorCode' => 0,
                'ErrorMessage' => "No Error",
                "BetAmount" => $this->getParam('Amount')
            ]);
        } catch (\Exception $exception) {
            DB::rollBack();
            Log::error($exception->getMessage());
        }

        return $this->respond([
            'AccountName' => $this->getParam('Username'),
            'Balance' => 0,
            'ErrorCode' => getConst('ERROR_CODE.INTERNAL_ERROR'),
            'ErrorMessage' => "Internal Error"
        ]);
    }

    /**
     * Update member's balance after bet
     * @return \Illuminate\Http\JsonResponse
     */
    public function settle()
    {
        // validate params
        $valid = $this->validateUser();
        if ($valid !== true) {
            return $valid;
        }

        // check balance
        if ($this->getParam('ResultType') == TransactionHistory::STATUS_LOST && (blank($this->member->money) || $this->member->money < $this->getParam('WinLoss'))) {
            return $this->respond([
                'AccountName' => $this->getParam('Username'),
                'Balance' => 0,
                'ErrorCode' => getConst('ERROR_CODE.NOT_ENOUGH_BALANCE'),
                'ErrorMessage' => "Not enough balance"
            ]);
        }

        // check histories
        $histories = $this->getTransactionHistory(['getAll' => true]);
        if (blank($histories)) {
            return $this->respond([
                'AccountName' => $this->getParam('Username'),
                'Balance' => 0,
                'ErrorCode' => getConst('ERROR_CODE.BET_NOT_EXIST'),
                'ErrorMessage' => "Bet not exists"
            ]);
        }

        DB::beginTransaction();
        try {
            // settle process
            $checkCancel = $checkSettle = false;
            $hasMultiHistories = $histories->count() > 1;
            foreach ($histories as $history) {
                // check settle status
                if ($history->status == TransactionHistory::STATUS_WIN || $history->status == TransactionHistory::STATUS_LOST || $history->status == TransactionHistory::STATUS_TIE) {
                    if (!$hasMultiHistories || $checkSettle) {
                        DB::rollBack();
                        return $this->respond([
                            'AccountName' => $this->getParam('Username'),
                            'Balance' => 0,
                            'ErrorCode' => getConst('ERROR_CODE.BET_ALREADY_SETTLED'),
                            'ErrorMessage' => "Bet Already Settled"
                        ]);
                    } else {
                        $checkSettle = true;
                        continue;
                    }
                }
                // check cancel status
                if ($history->status == TransactionHistory::STATUS_CANCEL) {
                    if (!$hasMultiHistories || $checkCancel) {
                        DB::rollBack();
                        return $this->respond([
                            'AccountName' => $this->getParam('Username'),
                            'Balance' => 0,
                            'ErrorCode' => getConst('ERROR_CODE.BET_ALREADY_CANCELED'),
                            'ErrorMessage' => "Bet Already Canceled"
                        ]);
                    } else {
                        $checkCancel = true;
                        continue;
                    }
                }
                $history->status = $this->getParam('ResultType');
                $history->win_loss = $this->getParam('WinLoss');
                $history->result_time = $this->getParam('ResultTime');
                $history->save();
            }

            // update db and response
            $this->member->money = $this->member->money + $this->getParam('WinLoss');
            $this->member->save();
            DB::commit();

            return $this->respond([
                'AccountName' => $this->getParam('Username'),
                'Balance' => $this->member->money,
                'ErrorCode' => 0,
                'ErrorMessage' => "No Error"
            ]);
        } catch (\Exception $exception) {
            DB::rollBack();
            Log::error($exception->getMessage());
        }

        return $this->respond([
            'AccountName' => $this->getParam('Username'),
            'Balance' => 0,
            'ErrorCode' => getConst('ERROR_CODE.INTERNAL_ERROR'),
            'ErrorMessage' => "Internal Error"
        ]);
    }

    /**
     * Rollback bet
     * @return \Illuminate\Http\JsonResponse
     */
    public function rollback()
    {
        // validate params
        $valid = $this->validateUser();
        if ($valid !== true) {
            return $valid;
        }

        // check bet history exist
        $histories = $this->getTransactionHistory(['getAll' => true]);
        if (blank($histories)) {
            return $this->respond([
                'AccountName' => $this->getParam('Username'),
                'Balance' => 0,
                'ErrorCode' => getConst('ERROR_CODE.BET_NOT_EXIST'),
                'ErrorMessage' => "Bet not exists"
            ]);
        }

        DB::beginTransaction();
        try {
            // rollback process
            $stake = 0;
            foreach ($histories as $history) {
                if ($history->status == TransactionHistory::STATUS_CANCEL) {
                    $stake += $history->amount;
                }
                if (in_array($history->status, [TransactionHistory::STATUS_WIN, TransactionHistory::STATUS_LOST, TransactionHistory::STATUS_TIE])) {
                    $stake = $history->win_loss;
                }
                if (!blank($history->rollback_time)) {
                    DB::rollBack();
                    return $this->respond([
                        'AccountName' => $this->getParam('Username'),
                        'Balance' => 0,
                        'ErrorCode' => getConst('ERROR_CODE.BET_ALREADY_ROLLBACK'),
                        'ErrorMessage' => "Bet Already Rollback"
                    ]);
                }

                $history->win_loss = null;
                $history->status = TransactionHistory::STATUS_WAITING;
                $history->rollback_time = Carbon::now();
                $history->save();
            }

            // update db and response
            $this->member->money = $this->member->money - $stake;
            $this->member->save();
            DB::commit();

            return $this->respond([
                'AccountName' => $this->getParam('Username'),
                'Balance' => $this->member->money,
                'ErrorCode' => 0,
                'ErrorMessage' => "No Error"
            ]);
        } catch (\Exception $exception) {
            DB::rollBack();
            Log::error($exception->getMessage());
        }

        return $this->respond([
            'AccountName' => $this->getParam('Username'),
            'Balance' => 0,
            'ErrorCode' => getConst('ERROR_CODE.INTERNAL_ERROR'),
            'ErrorMessage' => "Internal Error"
        ]);
    }

    /**
     * Cancel bet
     * @return \Illuminate\Http\JsonResponse
     */
    public function cancel()
    {
        // validate params
        $valid = $this->validateUser();
        if ($valid !== true) {
            return $valid;
        }

        // check bet history exist
        $histories = $this->getTransactionHistory(['getAll' => true]);
        if (blank($histories)) {
            return $this->respond([
                'AccountName' => $this->getParam('Username'),
                'Balance' => 0,
                'ErrorCode' => getConst('ERROR_CODE.BET_NOT_EXIST'),
                'ErrorMessage' => "Bet not exists"
            ]);
        }

        DB::beginTransaction();
        try {
            // cancel process
            $diffAmount = $winLoss = 0;
            $transactionId = $this->getParam('TransactionId');
            foreach ($histories as $history) {
                if ($this->getParam('IsCancelAll') && $history->transaction_id == $transactionId && $history->status == TransactionHistory::STATUS_CANCEL) {
                    DB::rollBack();
                    return $this->respond([
                        'AccountName' => $this->getParam('Username'),
                        'Balance' => 0,
                        'ErrorCode' => getConst('ERROR_CODE.BET_ALREADY_CANCELED'),
                        'ErrorMessage' => "Bet Already Canceled"
                    ]);
                }
                $winLoss = $history->win_loss;
                // check if not cancel all
                if (!$this->getParam('IsCancelAll')) {
                    if ($history->transaction_id != $transactionId) {
                        continue;
                    }
                    if ($history->status == TransactionHistory::STATUS_CANCEL) {
                        DB::rollBack();
                        return $this->respond([
                            'AccountName' => $this->getParam('Username'),
                            'Balance' => 0,
                            'ErrorCode' => getConst('ERROR_CODE.BET_ALREADY_CANCELED'),
                            'ErrorMessage' => "Bet Already Canceled"
                        ]);
                    }
                    $diffAmount = $history->amount;
                    $history->status = TransactionHistory::STATUS_CANCEL;
                    $history->cancel_time = Carbon::now();
                    $history->save();
                    break;
                }

                $diffAmount += $history->amount;
                $history->status = TransactionHistory::STATUS_CANCEL;
                $history->cancel_time = Carbon::now();
                $history->save();
            }

            // update db and response
            $this->member->money = $this->member->money + $diffAmount - $winLoss;
            $this->member->save();
            DB::commit();

            return $this->respond([
                'AccountName' => $this->getParam('Username'),
                'Balance' => $this->member->money,
                'ErrorCode' => 0,
                'ErrorMessage' => "No Error"
            ]);
        } catch (\Exception $exception) {
            DB::rollBack();
            Log::error($exception->getMessage());
        }

        return $this->respond([
            'AccountName' => $this->getParam('Username'),
            'Balance' => 0,
            'ErrorCode' => getConst('ERROR_CODE.INTERNAL_ERROR'),
            'ErrorMessage' => "Internal Error"
        ]);
    }

    /**
     * Tip process
     * @return \Illuminate\Http\JsonResponse
     */
    public function tip()
    {
        // validate params
        $valid = $this->validateUser();
        if ($valid !== true) {
            return $valid;
        }

        // check balance
        if (blank($this->member->money) || $this->member->money < $this->getParam('Amount')) {
            return $this->respond([
                'AccountName' => $this->getParam('Username'),
                'Balance' => 0,
                'ErrorCode' => getConst('ERROR_CODE.NOT_ENOUGH_BALANCE'),
                'ErrorMessage' => "Not enough balance"
            ]);
        }

        DB::beginTransaction();
        try {
            // tip process
            $history = $this->tipHistoryModel;
            $history->member_id = $this->member->id;
            $history->product_type = $this->getParam('ProductType');
            $history->game_type = $this->getParam('GameType');
            $history->game_provider = $this->getParam('Gpid');
            $history->transfer_code = $this->getParam('TransferCode');
            $history->transaction_id = $this->getParam('TransactionId');
            $history->amount = $this->getParam('Amount');
            $history->tip_time = $this->parseTime($this->getParam('TipTime'));
            $history->save();

            // update db and response
            $this->member->money = $this->member->money - $this->getParam('Amount');
            $this->member->save();
            DB::commit();

            return $this->respond([
                'AccountName' => $this->getParam('Username'),
                'Balance' => $this->member->money,
                'ErrorCode' => 0,
                'ErrorMessage' => "No Error"
            ]);
        } catch (\Exception $exception) {
            DB::rollBack();
            Log::error($exception->getMessage());
        }

        return $this->respond([
            'AccountName' => $this->getParam('Username'),
            'Balance' => 0,
            'ErrorCode' => getConst('ERROR_CODE.INTERNAL_ERROR'),
            'ErrorMessage' => "Internal Error"
        ]);
    }

    /**
     * Bonus process
     * @return \Illuminate\Http\JsonResponse
     */
    public function bonus()
    {
        // validate params
        $valid = $this->validateUser();
        if ($valid !== true) {
            return $valid;
        }

        // check bonus exist
        $bonusHistory = $this->bonusHistoryModel
            ->where('member_id', $this->member->id)
            ->where('transfer_code', $this->getParam('TransferCode'))
            ->where('product_type', $this->getParam('ProductType'))
            ->where('game_type', $this->getParam('GameType'))
            ->where('game_id', $this->getParam('GameId'))
            ->first();
        if (!blank($bonusHistory)) {
            return $this->respond([
                'AccountName' => $this->getParam('Username'),
                'Balance' => 0,
                'ErrorCode' => getConst('ERROR_CODE.BET_REFNO_EXIST'),
                'ErrorMessage' => "Bet With Same RefNo Exists"
            ]);
        }

        DB::beginTransaction();
        try {
            // bonus process
            $history = $this->bonusHistoryModel;
            $history->member_id = $this->member->id;
            $history->product_type = $this->getParam('ProductType');
            $history->game_type = $this->getParam('GameType');
            $history->game_id = $this->getParam('GameId');
            $history->game_provider = $this->getParam('Gpid');
            $history->transfer_code = $this->getParam('TransferCode');
            $history->transaction_id = $this->getParam('TransactionId');
            $history->amount = $this->getParam('Amount');
            $history->bonus_time = $this->parseTime($this->getParam('BonusTime'));
            $history->save();

            // update db and response
            $this->member->money = $this->member->money + $this->getParam('Amount');
            $this->member->save();
            DB::commit();

            return $this->respond([
                'AccountName' => $this->getParam('Username'),
                'Balance' => $this->member->money,
                'ErrorCode' => 0,
                'ErrorMessage' => "No Error"
            ]);
        } catch (\Exception $exception) {
            DB::rollBack();
            Log::error($exception->getMessage());
        }

        return $this->respond([
            'AccountName' => $this->getParam('Username'),
            'Balance' => 0,
            'ErrorCode' => getConst('ERROR_CODE.INTERNAL_ERROR'),
            'ErrorMessage' => "Internal Error"
        ]);
    }

    /**
     * Return stake
     * @return bool|\Illuminate\Http\JsonResponse
     */
    public function returnStake()
    {
        // validate params
        $valid = $this->validateUser();
        if ($valid !== true) {
            return $valid;
        }

        // check bet history exist
        $history = $this->getTransactionHistory(['transaction_id' => $this->getParam('TransactionId')]);
        if (blank($history)) {
            return $this->respond([
                'AccountName' => $this->getParam('Username'),
                'Balance' => 0,
                'ErrorCode' => getConst('ERROR_CODE.BET_NOT_EXIST'),
                'ErrorMessage' => "Bet not exists"
            ]);
        }
        if ($history->status == TransactionHistory::STATUS_RETURN_STAKE) {
            return $this->respond([
                'AccountName' => $this->getParam('Username'),
                'Balance' => 0,
                'ErrorCode' => getConst('ERROR_CODE.BET_ALREADY_RETURNED_STAKE'),
                'ErrorMessage' => "Bet Already Returned Stake"
            ]);
        }
        if ($history->status == TransactionHistory::STATUS_CANCEL) {
            return $this->respond([
                'AccountName' => $this->getParam('Username'),
                'Balance' => 0,
                'ErrorCode' => getConst('ERROR_CODE.BET_REFNO_EXIST'),
                'ErrorMessage' => "Bet With Same RefNo Exists"
            ]);
        }

        DB::beginTransaction();
        try {
            $diffBalance = $history->amount - request()->get('CurrentStake');
            // update db and response
            $history->amount = request()->get('CurrentStake');
            $history->return_stake_time = $this->parseTime(request()->get('ReturnStakeTime'));
            $history->status = TransactionHistory::STATUS_RETURN_STAKE;
            $history->save();

            $this->member->money = $this->member->money + $diffBalance;
            $this->member->save();
            DB::commit();

            return $this->respond([
                'AccountName' => $this->getParam('Username'),
                'Balance' => $this->member->money,
                'ErrorCode' => 0,
                'ErrorMessage' => "No Error"
            ]);
        } catch (\Exception $exception) {
            DB::rollBack();
            Log::error($exception->getMessage());
        }

        return $this->respond([
            'AccountName' => $this->getParam('Username'),
            'Balance' => 0,
            'ErrorCode' => getConst('ERROR_CODE.INTERNAL_ERROR'),
            'ErrorMessage' => "Internal Error"
        ]);
    }

    /**
     * LiveCoin transaction
     * @return bool|\Illuminate\Http\JsonResponse
     */
    public function liveCoinTransaction()
    {
        // validate params
        $valid = $this->validateUser();
        if ($valid !== true) {
            return $valid;
        }

        // check balance
        if (blank($this->member->money) || $this->member->money < $this->getParam('Amount')) {
            return $this->respond([
                'AccountName' => $this->getParam('Username'),
                'Balance' => 0,
                'ErrorCode' => getConst('ERROR_CODE.NOT_ENOUGH_BALANCE'),
                'ErrorMessage' => "Not enough balance"
            ]);
        }

        // get history from db
        $history = $this->getTransactionHistory();
        if (!blank($history)) {
            return $this->respond([
                'AccountName' => $this->getParam('Username'),
                'Balance' => 0,
                'ErrorCode' => getConst('ERROR_CODE.BET_REFNO_EXIST'),
                'ErrorMessage' => "Bet With Same RefNo Exists"
            ]);
        }
        if (blank($history)) {
            $history = $this->transactionHistoryModel;
        }

        DB::beginTransaction();
        try {
            // buy livecoin process
            $history->member_id = $this->member->id;
            $history->product_type = $this->getParam('ProductType');
            $history->game_type = $this->getParam('GameType');
            $history->transfer_code = $this->getParam('TransferCode');
            $history->transaction_id = $this->getParam('TransactionId');
            $history->amount = $this->getParam('Amount');
            $history->transaction_time = $this->parseTime($this->getParam('TranscationTime'));
            $history->section = $this->getParam('Selection');
            $history->status = TransactionHistory::STATUS_LIVE_COIN;
            $history->save();

            // update db and response
            $this->member->money = $this->member->money - $this->getParam('Amount');
            $this->member->save();
            DB::commit();

            return $this->respond([
                'AccountName' => $this->getParam('Username'),
                'Balance' => $this->member->money,
                'ErrorCode' => 0,
                'ErrorMessage' => "No Error",
            ]);
        } catch (\Exception $exception) {
            DB::rollBack();
            Log::error($exception->getMessage());
        }

        return $this->respond([
            'AccountName' => $this->getParam('Username'),
            'Balance' => 0,
            'ErrorCode' => getConst('ERROR_CODE.INTERNAL_ERROR'),
            'ErrorMessage' => "Internal Error"
        ]);
    }

    /**
     * Get bet status
     * @return bool|\Illuminate\Http\JsonResponse
     */
    public function getBetStatus()
    {
        // validate params
        $valid = $this->validateUser();
        if ($valid !== true) {
            return $valid;
        }

        // get history from db
        $history = $this->getTransactionHistory(['transaction_id' => $this->getParam('TransactionId')]);
        if (blank($history)) {
            return $this->respond([
                'AccountName' => $this->getParam('Username'),
                'Balance' => 0,
                'ErrorCode' => getConst('ERROR_CODE.BET_NOT_EXIST'),
                'ErrorMessage' => "Bet not exists"
            ]);
        }
        $status = 'void';
        if ($history->status == TransactionHistory::STATUS_WAITING) {
            $status = 'running';
        }
        if (in_array($history->status, [TransactionHistory::STATUS_WIN, TransactionHistory::STATUS_LOST])) {
            $status = 'settled';
        }
        return $this->respond([
            'TransferCode' => $history->transfer_code,
            'TransactionId' => $history->transaction_id,
            'Status' => $status,
            'WinLoss' => $history->win_loss,
            'Stake' => $history->amount,
            'ErrorCode' => 0,
            'ErrorMessage' => "No Error"
        ]);
    }

    protected function parseTime($time)
    {
        try {
            return Carbon::parse($time);
        } catch (\Exception $exception) {
        }
        return null;
    }

    protected function validateUser()
    {
        // validate username
        if (blank(request()->get('Username'))) {
            return $this->respond([
                'AccountName' => $this->getParam('Username'),
                'Balance' => 0,
                'ErrorCode' => getConst('ERROR_CODE.USERNAME_EMPTY'),
                'ErrorMessage' => "Username empty"
            ]);
        }

        // validate company key
        if (blank($this->getParam('CompanyKey'))) {
            return $this->respond([
                'AccountName' => $this->getParam('Username'),
                'Balance' => 0,
                'ErrorCode' => getConst('ERROR_CODE.COMPANY_KEY_ERROR'),
                'ErrorMessage' => "CompanyKey Error"
            ]);
        }
        $config = SystemConfig::where('name', 'remote_api_key')->first();
        if ($this->getParam('CompanyKey') != data_get($config, 'value')) {
            return $this->respond([
                'AccountName' => $this->getParam('Username'),
                'Balance' => 0,
                'ErrorCode' => getConst('ERROR_CODE.COMPANY_KEY_ERROR'),
                'ErrorMessage' => "CompanyKey Error"
            ]);
        }

        // check member exist
        $member = $this->memberModel->where('name', request()->get('Username'))->first();
        if (blank($member)) {
            return $this->respond([
                'AccountName' => $this->getParam('Username'),
                'Balance' => 0,
                'ErrorCode' => getConst('ERROR_CODE.MEMBER_NOT_EXIST'),
                'ErrorMessage' => "Member not exist"
            ]);
        }
        $this->member = $member;

        return true;
    }

    protected function getTransactionHistory($conditions = [])
    {
        $transaction = $this->transactionHistoryModel
            ->where('member_id', $this->member->id)
            ->where('transfer_code', $this->getParam('TransferCode'))
            ->where('product_type', $this->getParam('ProductType'));

        if (in_array($this->getParam('ProductType'), [1, 3, 7])) {
            $transaction->where('game_type', $this->getParam('GameType'));
        }
        if (!blank($conditions)) {
            foreach ($conditions as $field => $value) {
                if ($field == 'getAll') {
                    continue;
                }
                $transaction->where($field, $value);
            }
        }
        return data_get($conditions, 'getAll') ? $transaction->get() : $transaction->first();
    }
}
