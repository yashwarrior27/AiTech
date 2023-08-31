<?php

namespace App\Http\Controllers\Frontend\DailyIncome;

use App\Http\Controllers\Controller;
use App\Models\Transection;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DailyIncomeController extends Controller
{
  public function Index()
  {
    try
    {
        $user=Auth::user();

        $results =Transection::Incomes($user->id,config('transection.roi_income',1),['packageUser'])->paginate(env('Pagination',10));

        return view('FrontendDashboard.pages.daily_income.index',compact('results'));
    }
    catch(\Exception $e)
    {

        return $this->ErrorMessage($e);
    }

  }
}
