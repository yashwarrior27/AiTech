<?php

namespace App\Http\Controllers\Frontend\Profile;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

class ProfileController extends Controller
{
   public function Index()
   {
         $user=Auth::user();
         $countries=DB::table('countries')->get();

       return view('FrontendDashboard.pages.profile.index',compact('user','countries'));
   }

   public function Update(Request $request)
   {
       $request->validate([
         'name'=>'nullable|string',
         'email'=>'nullable|email',
         'country_code'=>'required',
         'phone'=>'required'
       ]);

       try
       {  DB::beginTransaction();

        $user=Auth::user();

        $user->country_id=explode('-',$request->country_code)[0];
        $user->phone=$request->phone;
        $user->email=isset($request->email)?$request->email:'';
        $user->name=isset($request->name)?$request->name:'';
        $user->save();

        DB::commit();

        return redirect()->back()->with('success',"Update Successful.");

       }
       catch(\Exception $e)
       {
           DB::rollBack();

          return $this->ErrorMessage($e);
       }

   }

   public function ImageUpload(Request $request)
   {
       $request->validate([
      'profile_image'=>'required|image'
       ]);

       try
       {
           DB::beginTransaction();

           $user=Auth::user();

           $image=$this->uploadDocuments($request->profile_image,public_path('/assets/images/profile_images'));

           if($user->profile_image!='user.png')
           {
            if(File::exists(public_path("/assets/images/profile_images/$user->profile_image"))) {
                File::delete(public_path("/assets/images/profile_images/$user->profile_image"));
            }
           }

           $user->profile_image=$image;
           $user->save();

           DB::commit();

           return redirect()->back()->with('success','Update Successful.');

       }
       catch(\Exception $e)
       {
           DB::rollBack();
           return $this->ErrorMessage($e);
       }
   }
}
