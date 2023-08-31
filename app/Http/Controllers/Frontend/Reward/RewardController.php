<?php

namespace App\Http\Controllers\Frontend\Reward;

use App\Http\Controllers\Controller;
use App\Models\RewardIncomeUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RewardController extends Controller
{
    public function Index()
    {
        try
        {
           $user=Auth::user();

           $results=RewardIncomeUser::UserTotalRewardIncomes($user->id,['rewardIncome']);

            return view('FrontendDashboard.pages.rewards.index',compact('results'));
        }
        catch(\Exception $e)
        {
            return $this->ErrorMessage($e);
        }
    }
}
