<?php

namespace App\Http\Controllers\Frontend\Package;

use App\Http\Controllers\Controller;
use App\Models\Currency;
use App\Models\Package;
use App\Models\PackageUser;
use App\Models\Transection;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PackageController extends Controller
{

   public function Index()
   {
         try
         {
             $user=Auth::user();
             $package_id=1;
             $package =$user->Allpackages->sortBy([['pivot.id','DESC']])->values()->first();
             $package_status=1;

             if($package)
             {
                $package_id=$package->id;

                $packagetime=$package->pivot->created_at->timestamp+(86400*env('Package_time',15));

                if(time()<$packagetime && $package->pivot->fastrack_status==0 && $package->pivot->status==1)
                   $package_status=0;
              }

            $packages=Package::where('status',1)->where('id','>=',$package_id)->get();

            $curriences=Currency::where('status',1)->get();

            $packageHistory=PackageUser::AllUserPackages($user->id,['package','metaTransection','metaTransection.currency']);

            return view('FrontendDashboard.pages.packages.index',compact('packages','curriences','packageHistory','package_status'));
         }
         catch(\Exception $e)
         {
             return $this->ErrorMessage($e);
         }


   }
}
