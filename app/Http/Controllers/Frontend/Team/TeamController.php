<?php

namespace App\Http\Controllers\Frontend\Team;

use App\Helper\Helper;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TeamController extends Controller
{
    public function Index()
    {
        try
        {
            $user=Auth::user();

           $results= Helper::LevelwiseTeam($user->id);

            return view('FrontendDashboard.pages.team.index',$results);
        }
        catch(\Exception $e)
        {
            return $this->ErrorMessage($e);
        }
    }
}
