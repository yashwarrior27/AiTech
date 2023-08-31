<?php

namespace App\Http\Controllers\Frontend\Dashboard;

use App\Helper\Helper;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
   public function Index()
   {
       try
       {
          $user=Auth::user();

          $Incomes=Helper::UserIncomes($user->id);
          $Teams=Helper::LevelwiseTeam($user->id);
          $Booster=Helper::BoosterCheck($user->id);

          $directs=$user->TotalDirect;

         $data=[
            'register_id'=>$user->register_id,
            'parent_id'=>$user->parent->register_id,
            'profile_image'=>$user->profile_image,
         ];

        $data['active_direct']=$directs->filter(function($collect){return $collect->income_cap;})->count();
        $data['inactive_direct']=$directs->filter(function($collect){ return !$collect->income_cap;})->count();

        return view('FrontendDashboard.pages.dashboard.index',compact('Incomes','Teams','Booster','data'));
       }
        catch(\Exception $e)
        {
             return $this->ErrorMessage($e);
        }

   }
}
