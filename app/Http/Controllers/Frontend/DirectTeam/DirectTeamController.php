<?php

namespace App\Http\Controllers\Frontend\DirectTeam;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DirectTeamController extends Controller
{
   public function Index()
   {
       try
       {
           $user=Auth::user();
           $directs=$user->TotalDirect()->with('AllPackages')->get();

           $totaldirects=[];

           if($directs->count()>0){

           foreach($directs as $key=>$direct){

            $totalTeamDirect=User::TotalTeam($direct->id,['AllPackages']);

            $totalTeamDirectBusiness=$totalTeamDirect->map(function($team){
               return $team->AllPackages->sum('invest_amount');
            })->sum();
            $totalTeamDirectBusiness+=$direct->AllPackages->sum('invest_amount');

            $totaldirects[]=['direct'=>$direct,'teambusiness'=>$totalTeamDirectBusiness];
           }
        }
        return view('FrontendDashboard.pages.direct_team.index',compact('totaldirects'));

       }
       catch(\Exception $e)
       {
           return $this->ErrorMessage($e);
       }
   }
}
