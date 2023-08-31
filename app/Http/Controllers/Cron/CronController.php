<?php

namespace App\Http\Controllers\Cron;

use App\Helper\Helper;
use App\Http\Controllers\Controller;
use App\Models\Currency;
use App\Models\LevelIncomeUser;
use App\Models\MetaTransection;
use App\Models\RewardIncome;
use App\Models\RewardIncomeUser;
use App\Models\Transection;
use App\Models\User;
use App\Models\Withdrawal;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;

class CronController extends Controller
{

    public function BoosterFastrackCron()
    {
        try
        {  DB::beginTransaction();

          $allusers=User::AllUser(['Directuser','Directuser.packages','packages']);
             
         

          foreach($allusers as $key => $user)
          {// start user loop

             $package=$user->packages->pop(); // get last package

             $directusers=$user->DirectUser; // get all user direct

             if(!$package || $package->pivot->fastrack_status !='0')
                 continue;

            $packagefastracktime=$package->pivot->created_at->timestamp+(86400*env('Package_time',15)); // 15 days time

             if(time()>$packagefastracktime)
               {
                   $package->pivot->fastrack_status=2;
                   $package->pivot->save();
                   DB::commit();
                   continue;
               }
               
              $packageboostertime=$package->pivot->created_at->timestamp+(86400*env('Booster_time',7)); // 7 days time
            
              if($package->pivot->booster_status == 0)
              { // start booster code

                if(time()>$packageboostertime)
                 {
                    $package->pivot->booster_status=2;
                    $package->pivot->save();
                    DB::commit();
                 }
                 else
                 {     if( $directusers->count()<env('Direct_count',3))
                    {
                     $afterpackagedirect=$directusers->filter(function($collect)use($package){

                        $directpackage=$collect->packages->pop();
                        if(!$directpackage)
                           return false;
                        return $directpackage->pivot->created_at->timestamp > $package->pivot->created_at->timestamp && $directpackage->invest_amount >= $package->invest_amount;
                     });
                      // check user direct that are come after package purchase and they also have same or greater amount of parent package;

                      if($afterpackagedirect->count() >= env('Booster_count',3))
                      {
                          $package->pivot->booster_status=1;
                          $package->pivot->booster_activate_date=date('Y-m-d H:i:s');
                          $package->pivot->save();
                          DB::commit();
                      }
                    }
                 }

              }// end booster code
               
              if( $directusers->count()<env('Direct_count',3)){
               $afterboosterdirect=$directusers->filter(function($collect)use($package){

                return $collect->packages->filter(function($col)use($package){
                   return strtotime($col->pivot->booster_activate_date) > $package->pivot->created_at->timestamp;
                })->count() > 0 ;

                 // && $col->invest_amount >= $package->invest_amount ;
               });
               // check the direct that have booster active date is grater than package date and have same or above amount invest.

              if($afterboosterdirect->count()>= env('Fastrack_count',3))
              {
                  $package->pivot->fastrack_status=1;
                  $package->pivot->fastrack_activate_date=date('Y-m-d H:i:s');
                  $package->pivot->save();
                  DB::commit();
              }
            }
          }// end user loop

          return 'Sucessfully Done.';
        }
        catch(\Exception $e)
        {
            DB::rollBack();
            return $this->ErrorMessage($e);
        }
    }


   public function RoiCron()
   {
       try
       {
           DB::beginTransaction();

           $allusers=User::AllUser(['packages','RoiIncome','LevelIncome']);

           foreach($allusers as $key => $user)
           {// start users loop

               $packages=$user->packages;

               if(count($packages)==0)
               continue;

               $totalIncome=round($user->RoiIncome->sum('amount')+$user->LevelIncome->sum('amount'),4);

               $incomeCap=$user->income_cap;


               if($totalIncome>=$incomeCap)
               {
                    $user->packages->each(function ($collect){
                        $collect->pivot->status = 0;
                        $collect->pivot->save();
                    });
                    DB::commit();
                    continue;
               }


              foreach($packages as $key=>$package)
              { // start packages loop

                  $roi=$package->daily_roi;

                  if($package->pivot->fastrack_status==1)
                    $roi=$roi*(env('Fastrack',200)/100);
                  elseif($package->pivot->booster_status==1)
                    $roi=$roi*(env('Booster',150)/100);

                  $roiAmount=$package->invest_amount*($roi/100);

                  $totalinc=Helper::TotalIncome($user->id);

                  if($roiAmount+$totalinc>=$incomeCap)
                  {
                      $roiAmount=$incomeCap-$totalinc;

                      Transection::create([
                        'user_id'=>$user->id,
                        'amount'=>$roiAmount,
                        'trans'=>config('transection.roi_income',1),
                        'type_id'=>$package->pivot->id
                      ]);

                      $user->packages->each(function ($collect){
                        $collect->pivot->status = 0;
                        $collect->pivot->save();
                    });
                    DB::commit();
                    break;
                  }
                  else
                  {
                   Transection::create([
                        'user_id'=>$user->id,
                        'amount'=>$roiAmount,
                        'trans'=>config('transection.roi_income',1),
                        'type_id'=>$package->pivot->id
                      ]);
                      DB::commit();
                  }
              }// end packages loop

           }// end users loop

           return 'Sucessfully Done.';

       }
       catch(\Exception $e)
       {
           DB::rollBack();
         return $this->ErrorMessage($e);
       }
   }

    public function LevelIncomeCron()
    {
        try
        {
            DB::beginTransaction();

            $levelIncomes=LevelIncomeUser::AllLevelIncomes(['user','LevelIncome','user.packages']);

            foreach($levelIncomes as $key => $levelIncome)
            { // start level income loop

                $package=$levelIncome->user->packages;

                $totalIncome=Helper::TotalIncome($levelIncome->user->id);

                  $incomeCap=$levelIncome->user->income_cap;

                if($package->count()== 0 || $totalIncome >= $incomeCap ||$levelIncome->count == $levelIncome->LevelIncome->days )
                {

                     $levelIncome->status = 0;
                     $levelIncome->save();
                      DB::commit();
                      continue;
                }
                $income=$levelIncome->amount*($levelIncome->LevelIncome->daily_income/100);

                if(($income+$totalIncome)>=$incomeCap)
                  {

                      $income=$incomeCap-$totalIncome;

                      Transection::create([
                          'user_id'=>$levelIncome->user_id,
                          'amount'=>$income,
                          'trans'=>config('transection.level_income',3),
                          'type_id'=>$levelIncome->id,
                      ]);
                      $levelIncome->count+=1;
                      $levelIncome->status=0;
                      $levelIncome->save();

                      DB::commit();

                  }
                  else
                  {
                    Transection::create([
                        'user_id'=>$levelIncome->user_id,
                        'amount'=>$income,
                        'trans'=>config('transection.level_income',3),
                        'type_id'=>$levelIncome->id,
                    ]);
                    $levelIncome->count+=1;
                    $levelIncome->save();
                      DB::commit();
                  }
            }// end level income loop

            return 'Successfully Done.';
        }
        catch(\Exception $e)
        {
            DB::rollBack();
            return $this->ErrorMessage($e);
        }
    }

    public function RewardCron()
    {
        try
        {
            DB::beginTransaction();

            $allusers=User::AllUser(['DirectUser','TotalRewardIncome','DirectUser.AllPackages']);
            $trans=[];

            foreach($allusers as $key => $user)
            { // start user loop

               $directs=$user->DirectUser;
              
               if($directs->count()< env('Reward_direct_count',10))
                  continue;
 

                $userRewards=$user->TotalRewardIncome; // previous rewards

                $secondrewardcount=0; // if they achive two rewads in single day

                $rewards=RewardIncome::whereNotIn('id',$userRewards->pluck('id')->toArray())->where('status',1)->get();

                foreach($rewards as $key1=>$reward)
                { // start reward loop

                     $TotalTeamBusiness=0;
                     $rewardBusiness=$reward->total_business+$userRewards->sum('total_business')+$secondrewardcount;
                     $maxMatching=$reward->total_business*(env('MaxMatchingBusiness',50)/100);

                    foreach($directs as $key2 => $direct)
                    {// start direct loop
                         $totalTeamDirect=User::TotalTeam($direct->id,['AllPackages']);

                         $totalTeamDirectBusiness=$totalTeamDirect->map(function($team){
                            return $team->AllPackages->sum('invest_amount');
                         })->sum();

                         $totalTeamDirectBusiness+=$direct->AllPackages->sum('invest_amount');

                         if($maxMatching<=$totalTeamDirectBusiness)
                           $TotalTeamBusiness+=$maxMatching;
                           else
                           $TotalTeamBusiness+=$totalTeamDirectBusiness;
                    }//end direct loop
                   
                   if($TotalTeamBusiness<$rewardBusiness)
                      break;

                    $trans[]=[
                       'user_id'=>$user->id,
                       'amount'=>$reward->reward_amount,
                       'trans'=>config('transection.total_reward_income',4),
                       'type_id'=>$reward->id
                    ];

                    if($userRewards->count()>0){
                        $user->TotalRewardIncome[0]->pivot->next_reward_id=$reward->id;
                        $user->TotalRewardIncome[0]->pivot->save();
                    }// update previous next reward id

                    $user->TotalRewardIncome()->attach($reward->id);

                    if($reward->id==1)
                    {

                        $trans[]=[
                           'user_id'=>$user->id,
                           'amount'=>config('aitp_token.REWARD',200),
                           'trans'=>config('transection.aitp_token',6),
                           'type_id'=>$reward->id
                        ];
                        $user->aitp_token+=config('aitp_token.REWARD',200);
                        $user->save();
                    }

                    DB::commit();
                   $secondrewardcount+=$reward->total_business;
                }// end reward loop

            }//end user loop

            Transection::insert($trans);
            DB::commit();
          return 'Successfully Done.';
        }

        catch(\Exception $e)
        {
            DB::rollBack();

            return $this->ErrorMessage($e);
        }
    }

    public function RewardIncomeCron()
    {
        try
        {  DB::beginTransaction();

            $rewardIncomes=RewardIncomeUser::AllRewarduser(['rewardIncome','user']);

            $trans=[];

            foreach($rewardIncomes as $key => $rewardIncome)
            {
                $reward=$rewardIncome->rewardIncome;
                $user=$rewardIncome->user;

                if($rewardIncome->count>=$reward->days)
                  {
                     $rewardIncome->status=0;
                     $rewardIncome->save();
                     DB::commit();
                     continue;
                  }

                 if(!$rewardIncome->next_reward_id)
                 {
                     $days=$rewardIncome->monthly_count*env('RewardMonthlyCheck',30);

                     $endDate=$rewardIncome->created_at->addDays((int)$days);

                     $startDate=$rewardIncome->created_at->addDays((int)$days)->subDays(env('RewardMonthlyCheck',30));

                     if(date('Y-m-d',strtotime($endDate))<=date('Y-m-d'))
                     {
                        $totalTeam=User::TotalTeam($user->id,['AllPackages']);

                        $monthlyTotal=$totalTeam->map(function($collect)use($startDate){

                           return  $collect->AllPackages->filter(function($package)use($startDate){
                              return $package?->pivot?->created_at?->timestamp > $startDate?->timestamp;
                           })->sum('invest_amount');
                        })->sum();

                        $monthlyBusiness=$reward->total_business*(env('RewardMonthlyBusiness',10)/100);

                       if($monthlyTotal<$monthlyBusiness)
                       {
                         $rewardIncome->status=0;
                         $rewardIncome->save();
                         DB::commit();
                         continue;

                       }else
                       {
                          $rewardIncome->monthly_count+=1;
                          $rewardIncome->save();
                          DB::commit();
                       }
                     }
                 }

                 $rewardAmt=$reward->reward_amount*($reward->per_day/100);

                 $trans[]=[
                     'user_id'=>$user->id,
                     'amount'=>$rewardAmt,
                     'trans'=>config('transection.reward_income',5),
                     'type_id'=>$rewardIncome->id,
                 ];

                 $rewardIncome->count+=1;
                 $rewardIncome->save();
                 DB::commit();

            }
            Transection::insert($trans);
            DB::commit();

            return 'Successfully done.';
        }
        catch(\Exception $e)
        {
            DB::rollBack();

            return $this->ErrorMessage($e);
        }
    }


    public function WithdrawalUpdate()
    {
        try
        {
            $withdrawals=Withdrawal::where('status','pending')->get();
        
            if($withdrawals->count()>0){

                foreach($withdrawals as $key=>$withdrawal)
                {

                 $check=Http::get(env('Node_url').'/trx-details',[
                    'trans_id'=>$withdrawal->transection_id
            ]);
            $checkdata=$check->json();

            if($checkdata['status'])
            {
                $withdrawal->status='success';
                $withdrawal->curl_response=json_encode($checkdata);
                $withdrawal->save();
                DB::commit();
            }
            else
            {
                $transection= Transection::findOrFail($withdrawal->trans_id);
                $transection->status=0;
                $transection->save();
                
                $withdrawal->status='rejected';
                $withdrawal->error_responnse=json_encode($checkdata);
                $withdrawal->save();
                DB::commit();
            }

         }
         }
         return 'Success Done.';

        }
        catch(\Exception $e)
        {
            return $e->getMessage();
        }
    }

    public function InvestCron()
    {
        try
        {  DB::beginTransaction();

            $query=MetaTransection::with('User','package','currency')->where('status','pending')->where('transection_id','!=','buy_through_admin');

            foreach($query->cursor() as $key=>$metaTrans)
            {
                $user=$metaTrans->User;

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
                 $metaTrans->curl_response=json_encode($data);
                 $metaTrans->save();

               Transection::create([

                  'user_id'=>$metaTrans->user_id,
                  'meta_transection_id'=>$metaTrans->id,
                  'amount'=>$metaTrans->amount,
                  'trans'=>config('transection.package',0),
                  'type_id'=>$metaTrans->package_id,
               ]);

               $user->income_cap+=$metaTrans->amount*env('IncomeCap',3);
               $user->save();
               $user->packages()->attach($metaTrans->package_id,['meta_transection_id'=>$metaTrans->id]);

               Helper::LevelIncome($user,$metaTrans->package_id);

               DB::commit();
            }
            else
            {
                $metaTrans->status='rejected';
                $metaTrans->error_response=json_encode($data);
                $metaTrans->save();
                DB::commit();
            }

            }
            else
            {
                $metaTrans->status='rejected';
                $metaTrans->error_response=json_encode($data);
                $metaTrans->save();
                DB::commit();
            }
        }
      return 'Success Done';
        }
        catch(\Exception $e)
        {
            DB::rollBack();
            return $this->ErrorMessage($e);
        }
    }
    
    public function RejectInvestCron()
    {
        try
        {  DB::beginTransaction();

            $query=MetaTransection::with('User','package','currency')->where('transection_id','!=','buy_through_admin')->where('status','rejected')->where('checkout',0);

            foreach($query->cursor() as $key=>$metaTrans)
            {
                $user=$metaTrans->User;

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
                 $metaTrans->curl_response=json_encode($data);
                 $metaTrans->save();

               Transection::create([

                  'user_id'=>$metaTrans->user_id,
                  'meta_transection_id'=>$metaTrans->id,
                  'amount'=>$metaTrans->amount,
                  'trans'=>config('transection.package',0),
                  'type_id'=>$metaTrans->package_id,
               ]);

               $user->income_cap+=$metaTrans->amount*env('IncomeCap',3);
               $user->save();
               $user->packages()->attach($metaTrans->package_id,['meta_transection_id'=>$metaTrans->id]);

               Helper::LevelIncome($user,$metaTrans->package_id);

               DB::commit();
            }
            else
            {
                $metaTrans->status='rejected';
                $metaTrans->checkout=1;
                $metaTrans->error_response=json_encode($data);
                $metaTrans->save();
                DB::commit();
            }

            }
            else
            {
                $metaTrans->status='rejected';
                $metaTrans->checkout=1;
                $metaTrans->error_response=json_encode($data);
                $metaTrans->save();
                DB::commit();
            }
        }
      return 'Success Done';
        }
        catch(\Exception $e)
        {
            DB::rollBack();
            return $this->ErrorMessage($e);
        }
    }
}

