<?php

namespace App\Http\Controllers\Frontend\LevelIncome;

use App\Http\Controllers\Controller;
use App\Models\Transection;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LevelIncomeController extends Controller
{
    public function Index()
    {
        try
        {
            $user=Auth::user();

        $results =Transection::Incomes($user->id,config('transection.level_income'),['LevelIncome','LevelIncome.FromUser'])->paginate(env('Pagination',10));

            return view('FrontendDashboard.pages.level_income.index',compact('results'));
        }
        catch(\Exception $e)
        {
            return $this->ErrorMessage($e);
        }
    }
}
