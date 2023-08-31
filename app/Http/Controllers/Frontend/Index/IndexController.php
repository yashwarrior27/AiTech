<?php

namespace App\Http\Controllers\Frontend\Index;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class IndexController extends Controller
{
   public function Index()
   {
       return view('Frontend.index');
   }

   public function LoginRegister($referral_id=null)
   {
      $countries= DB::table('countries')->get();
       return view('Frontend.login-register',compact('countries','referral_id'));
   }


}
