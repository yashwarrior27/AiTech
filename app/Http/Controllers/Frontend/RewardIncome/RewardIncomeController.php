<?php

namespace App\Http\Controllers\Frontend\RewardIncome;

use App\Http\Controllers\Controller;
use App\Models\Transection;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RewardIncomeController extends Controller
{
  public function Index()
  {
     try
     {
        $user=Auth::user();

        $results =Transection::Incomes($user->id,config('transection.reward_income',5),['RewardIncome','RewardIncome.rewardIncome'])->paginate(env('Pagination',10));
        return view('FrontendDashboard.pages.reward_income.index',compact('results'));
     }
     catch(\Exception $e)
     {
         return $this->ErrorMessage($e);
     }
  }
}
