<?php

namespace App\Http\Controllers\Frontend\LevelReward;

use App\Http\Controllers\Controller;
use App\Models\LevelIncomeUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LevelRewardController extends Controller
{
    public function Index()
    {
        try
        {
            $user=Auth::user();

            $results=LevelIncomeUser::UserTotalLevelIncomes($user->id,['FromUser']);

            return view('FrontendDashboard.pages.level_reward.index',compact('results'));
        }
        catch(\Exception $e)
        {
            return $this->ErrorMessage($e);
        }

    }
}
