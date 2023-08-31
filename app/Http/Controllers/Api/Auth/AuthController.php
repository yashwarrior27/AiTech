<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use App\Models\Transection;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth ;
use Illuminate\Support\Facades\Session;

class AuthController extends Controller
{
    public function login(Request $request){
        try
        {
            $validator=Validator::make($request->all(),[
              'walletAddress'=>'required|exists:users,wallet_address'
            ]);
           if($validator->fails())
              return \ResponseBuilder::fail($validator->errors()->first(),$this->badRequest);

              $user=User::where('wallet_address',$request->walletAddress)->first();

            if($user->status==0)
                return \ResponseBuilder::fail(trans('message.BLOCKED'),$this->badRequest);

             $user=Auth::loginUsingId($user->id);
              
             $logincheck=md5(time());
             Session::put('logincheck',$logincheck);
             $user->login_check_token=$logincheck;
             $user->save();

            return \ResponseBuilder::success(trans('message.LOGIN_SUCCESS'),$this->success);

        }
        catch(\Exception $e)
        {
            return $this->ErrorMessage($e);
        }

    }

    public function register(Request $request){
        try
        {   DB::beginTransaction();

            $validator=Validator::make($request->all(),[
                'walletAddress'=>'required|unique:users,wallet_address',
                'country_code'=>'required|numeric|exists:countries,id',
                'phone'=>'required|numeric|digits_between:8,12',
                'referral_code'=>'required|exists:users,register_id'
            ]);

            if($validator->fails())
              return \ResponseBuilder::fail($validator->errors()->first(),$this->badRequest);

              $referral=isset($request->referral_code)&&!empty($request->referral_code)?$request->referral_code:env('Admin_Register_ID','AI100000');

              $parentuser=User::where('register_id',$referral)->first();

            $user=User::create([
                'wallet_address'=>strtolower($request->walletAddress),
                'country_id'=>$request->country_code,
                'phone'=>$request->phone,
                'register_id'=>'AI'.rand(1000,9999).rand(100,999),
                'parent_id'=>$parentuser->id,
                'aitp_token'=>config('aitp_token.SELF_BONUS',5)
            ]);

            $trans=[];

            $trans[]=[
                'user_id'=>$user->id,
                'amount'=>config('aitp_token.SELF_BONUS',5),
                'trans'=>config('transection.aitp_token',6),
                'type_id'=>$user->id
             ];

            $user->parent_str=$parentuser->parent_str."$user->id,";
            $user->save();

            $trans[]=[
                'user_id'=>$parentuser->id,
                'amount'=>config('aitp_token.LEVEL_1',3),
                'trans'=>config('transection.aitp_token',6),
                'type_id'=>$user->id
             ];

            $parentuser->aitp_token+=config('aitp_token.LEVEL_1',3);
            $parentuser->save();

            if($parentuser->parent_id!='0')
            {
                 $grandparentuser=  $parentuser->parent;

                 $trans[]=[
                    'user_id'=>$grandparentuser->id,
                    'amount'=>config('aitp_token.LEVEL_2',2),
                    'trans'=>config('transection.aitp_token',6),
                    'type_id'=>$user->id
                 ];

                 $grandparentuser->aitp_token+=config('aitp_token.LEVEL_2',2);
                 $grandparentuser->save();
            }

            Transection::insert($trans);
            DB::commit();

            return \ResponseBuilder::success(trans('message.REGISTER'),$this->success);
        }
        catch(\Exception $e)
        {
            DB::rollBack();
            return \ResponseBuilder::fail($this->ErrorMessage($e),$this->serverError);
        }
    }

    public function Logout(){
        try
        {
            if(Auth::check())
                Auth::logout();
            return \ResponseBuilder::success(trans('message.LOGOUT'),$this->success);
        }
        catch(\Exception $e)
        {
            return \ResponseBuilder::fail($this->ErrorMessage($e),$this->serverError);
        }
    }

    public function CheckReferralNo(Request $request)
    {
        try
        {
            $validator=Validator::make($request->all(),[
              'referral_code'=>'required|exists:users,register_id'
            ]);

            if($validator->fails())
                return \ResponseBuilder::fail($validator->errors()->first(),$this->badRequest);

             return \ResponseBuilder::success(trans('message.SUCCESS'),$this->success);
        }
        catch(\Exception $e)
        {
            return \ResponseBuilder::fail($this->ErrorMessage($e),$this->serverError);
        }
}
}
