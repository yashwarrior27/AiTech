<?php

namespace App\Http\Controllers\Api\CryptoTransection;

use App\Helper\Helper;
use App\Http\Controllers\Controller;
use App\Models\Currency;
use App\Models\MetaTransection;
use App\Models\Package;
use App\Models\Transection;
use App\Models\User;
use App\Models\Withdrawal;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Validator;


class CryptoTransectionController extends Controller
{

   public function CreateMetaTransection(Request $request){

    try
    {
         DB::beginTransaction();

        $validator=Validator::make($request->all(),[
            'package'=>'required|numeric|exists:packages,id',
            'currency'=>'required|numeric|exists:currencies,id',
            'transection_id'=>'required|unique:meta_transections,transection_id',
        ]);

        if($validator->fails())
            return \ResponseBuilder::fail($validator->errors()->first(),$this->badRequest);

           $user=Auth::user();

           $package=Package::find($request->package);


        $metaTrans=MetaTransection::create([
         'user_id'=>$user->id,
         'transection_id'=>$request->transection_id,
         'currency_id'=>$request->currency,
         'package_id'=>$request->package,
         'amount'=>$package->invest_amount,
         'token_amount'=>$package->invest_amount.'000000000000000000',
         'wallet_address'=>$user->wallet_address,
        ]);

         DB::commit();

         $data=['trans_id'=>$metaTrans->id];

        return \ResponseBuilder::success(trans('message.SUCCESS'),$this->success,$data);

    }
    catch(\Exception $e)
    {
        DB::rollBack();

        return \ResponseBuilder::fail($this->ErrorMessage($e),$this->serverError);
    }

   }

   public function FailMetaTransection(Request $request){
       try
       {
           DB::beginTransaction();
           $validator=Validator::make($request->all(),
           [
             'trans_id'=>'required|numeric|exists:meta_transections,id,status,pending',
           ]);

           if($validator->fails())
              return \ResponseBuilder::fail($validator->errors()->first(),$this->badRequest);

           $metaTrans=MetaTransection::findOrFail($request->trans_id);

           $metaTrans->status='rejected';
           $metaTrans->error_response=isset($request->response)?$request->response:'';
           $metaTrans->save();
           DB::commit();

           return \ResponseBuilder::success(trans('message.FAILED'),$this->success);

       }
       catch(\Exception $e)
       {
           DB::rollBack();
           return \ResponseBuilder::fail($this->ErrorMessage($e),$this->serverError);
       }
   }

   public function SuccessMetaTransection(Request $request){

    try
    {
        DB::beginTransaction();

        $validator= Validator::make($request->all(),[

            'trans_id'=>'required|numeric|exists:meta_transections,id,status,pending',
            'response'=>'required'
        ]);

        if($validator->fails())
           return \ResponseBuilder::fail($validator->errors()->first(),$this->badRequest);

           $metaTrans=MetaTransection::findOrFail($request->trans_id);

           $response=Http::timeout(60)->get(env('Node_url').'/trx-details',[
                   'trans_id'=>$metaTrans->transection_id
           ]);

           $data=$response->json();

          

          if($data['status']  && $data['from']==$metaTrans->wallet_address && $data['to']==env('Contract_address')){


            $log=collect($data['log'])->filter(function($collect)use($metaTrans){
                
                return $collect['address']==$metaTrans->currency->address && (hexdec($collect['data'])/10**18)==$metaTrans->package->invest_amount;
            });
            if(count($log)>0){
                $metaTrans->status='success';
                $metaTrans->curl_response=isset($request->response)?$request->response:'';
                $metaTrans->save();

              Transection::create([

                 'user_id'=>$metaTrans->user_id,
                 'meta_transection_id'=>$metaTrans->id,
                 'amount'=>$metaTrans->amount,
                 'trans'=>config('transection.package',0),
                 'type_id'=>$metaTrans->package_id,
              ]);

              $user=User::findOrFail($metaTrans->user_id);

              $user->income_cap+=$metaTrans->amount*env('IncomeCap',3);
              $user->save();
              $user->packages()->attach($metaTrans->package_id,['meta_transection_id'=>$metaTrans->id]);

              Helper::LevelIncome($user,$metaTrans->package_id);

              DB::commit();
              return \ResponseBuilder::success(trans('message.SUCCESS'),$this->success);
            }
            else
            {
                $metaTrans->status='rejected';
                $metaTrans->error_response=json_encode($data);
                $metaTrans->save();
                DB::commit();
                return \ResponseBuilder::fail(trans('message.FAILED'),$this->badRequest);
            }
          }
          else{
            $metaTrans->status='rejected';
            $metaTrans->error_response=isset($request->response)?$request->response:'';
            $metaTrans->save();
            DB::commit();
            return \ResponseBuilder::fail(trans('message.FAILED'),$this->badRequest);
          }

    }
    catch(\Exception $e)
    {
        DB::rollBack();

        return \ResponseBuilder::fail($this->ErrorMessage($e),$this->serverError);
    }
   }

// public function SuccessMetaTransection(Request $request){

//     try
//     {
//         DB::beginTransaction();

//         $validator= Validator::make($request->all(),[

//             'trans_id'=>'required|numeric|exists:meta_transections,id',
//         ]);

//         if($validator->fails())
//            return \ResponseBuilder::fail($validator->errors()->first(),$this->badRequest);

//            $metaTrans=MetaTransection::findOrFail($request->trans_id);

//            $metaTrans->status='success';
//            $metaTrans->curl_response=isset($request->response)?$request->response:'';
//            $metaTrans->save();

//          Transection::create([

//             'user_id'=>$metaTrans->user_id,
//             'meta_transection_id'=>$metaTrans->id,
//             'amount'=>$metaTrans->amount,
//             'trans'=>config('transection.package',0),
//             'type_id'=>$metaTrans->package_id,
//          ]);

//          $user=User::findOrFail($metaTrans->user_id);

//          $user->income_cap+=$metaTrans->amount*env('IncomeCap',3);
//          $user->save();
//          $user->packages()->attach($metaTrans->package_id,['meta_transection_id'=>$metaTrans->id]);

//          Helper::LevelIncome($user,$metaTrans->package_id);

//          DB::commit();

//          return \ResponseBuilder::success(trans('message.SUCCESS'),$this->success);

//     }
//     catch(\Exception $e)
//     {
//         DB::rollBack();

//         return \ResponseBuilder::fail($this->ErrorMessage($e),$this->serverError);
//     }
//    }
   public function CheckMetaTransection(){

       try
       {
           $user=Auth::user();

           $metaTrans=MetaTransection::where('user_id',$user->id)->where('status','pending')->first();

           if($metaTrans)
           {
            $data=['transection_id'=>$metaTrans->transection_id,'trans_id'=>$metaTrans->id];

            return \ResponseBuilder::success(trans('message.SUCCESS'),$this->success,$data);
           }

             return \ResponseBuilder::fail(trans('message.SUCCESS'),$this->success);

       }
       catch(\Exception $e)
       {
           return \ResponseBuilder::fail($this->ErrorMessage($e),$this->serverError);
       }

   }

   public function UpdateMetaTransection(Request $request){

    try
    {

       $validator=Validator::make($request->all(),[
               'status'=>'required',
               'response'=>'required',
               'trans_id'=>'required|numeric|exists:meta_transections,id,status,pending',
       ]);

       if($validator->fails())
          return \ResponseBuilder::fail($validator->errors()->first(),$this->badRequest);
       
         
      if($request->status=='true')
      {
        return $this->SuccessMetaTransection($request);
      }
      else{
        
        return $this->FailMetaTransection($request);
      }

    }
    catch(\Exception $e)
    {
        return \ResponseBuilder::fail($this->ErrorMessage($e),$this->serverError);
    }
   }

   public function WithdrawalRequest(Request $request)
   {
       try
      {
          DB::beginTransaction();

           $user=Auth::user();

           if($user->status==0)
              return \ResponseBuilder::fail(trans('message.BLOCKED'),$this->badRequest);

          $validator=Validator::make($request->all(),[
             'amount'=>'required|numeric|min:20'
          ]);
          if($validator->fails())
             return \ResponseBuilder::fail($validator->errors()->first(),$this->badRequest);

          $Income=Helper::UserIncomes($user->id);

         
          if($Income['available_income']<$request->amount)
             return \ResponseBuilder::fail(trans('message.INSUFFICIENT'),$this->badRequest);

           $prev_withdrawal=Withdrawal::where('user_id',$user->id)->where('status','pending')->first();

           if($prev_withdrawal)
              return \ResponseBuilder::fail(trans('message.PENDING'),$this->badRequest);

             $amount=(float)$request->amount-((float)$request->amount*(env('Withdrawal_per',5)/100));

             $currency=Currency::find(env('Withdrawal_currency_id',1));

             $response=Http::timeout(120)->post(env('Node_url').'/withdrawal',[
                'token'=>$currency->address,
                'amount'=>$amount,
                'to_address'=>$user->wallet_address
              ]);

              $data=$response->json();
             
              if($data['success'])
{
             $withdrawal=Withdrawal::create([
                'user_id'=>$user->id,
                'currency_id'=>env('Withdrawal_currency_id',1),
                'amount'=>$amount,
                'token_amount'=>$amount,
                'wallet_address'=>$user->wallet_address,
                'transection_id'=>$data['data']
            ]);

            $transection=Transection::create([
                'user_id'=>$user->id,
                'amount'=>$request->amount,
                'trans'=>config('transection.withdrawal',7),
                'type_id'=>$withdrawal->id,
            ]);

            $withdrawal->trans_id=$transection->id;
            $withdrawal->save();
            DB::commit();

            return \ResponseBuilder::success(trans('message.SUCCESS'),$this->success);
        }
        else
        {
            return \ResponseBuilder::fail('Something went wrong.',$this->badRequest);
        }

       }
       catch(\Exception $e)
       {
           DB::rollBack();
           return \ResponseBuilder::fail($this->ErrorMessage($e),$this->serverError);
       }

   }

   public function CheckWithdrawal(){

    try
    {
        $user=Auth::user();

        $withdrawal=Withdrawal::where('user_id',$user->id)->where('status','pending')->first();

        if($withdrawal)
        {

         return \ResponseBuilder::success(trans('message.SUCCESS'),$this->success);
        }

          return \ResponseBuilder::fail(trans('message.SUCCESS'),$this->success);

    }
    catch(\Exception $e)
    {
        return \ResponseBuilder::fail($this->ErrorMessage($e),$this->serverError);
    }

}

}
