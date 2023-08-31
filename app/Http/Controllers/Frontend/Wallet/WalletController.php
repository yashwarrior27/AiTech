<?php

namespace App\Http\Controllers\Frontend\Wallet;

use App\Helper\Helper;
use App\Http\Controllers\Controller;
use App\Models\Transection;
use App\Models\Withdrawal;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class WalletController extends Controller
{
    public function Index()
    {
        try
        {
            $user=Auth::user();

            $Incomes=Helper::UserIncomes($user->id);

            $results=Transection::WalletHistory($user->id,['packageUser','RewardIncome','LevelIncome','RewardIncome.rewardIncome','packageUser.package'])->paginate(env('Pagination',10));

            $withdrawals=Withdrawal::UserWithdrawal($user->id,['currency','trans']);

            return view('FrontendDashboard.pages.wallet.index',compact('Incomes','results','withdrawals'));
        }
        catch(\Exception $e)
        {
            return $this->ErrorMessage($e);
        }
    }
}
