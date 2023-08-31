<?php

namespace App\Helper;

use App\Models\LevelIncome;
use App\Models\Package;
use App\Models\Transection;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class Helper{

    public static function LevelIncome($user,$package_id)
    {
        try
        {
            $parentids=array_reverse(explode(',',$user->parent_str));
            array_pop($parentids);
            $parentids = count($parentids)>22?array_slice($parentids,2,22):array_slice($parentids,2);

            // parentid get user parent str and split seprated by coma and remove extra 2 index and then count 20 level ids by reverse from end to start

           $parentUsers= User::AllLevelParentUser($parentids,['packages','DirectUser','TotalLevelIncome']);

           $package=Package::findOrFail($package_id);
           $levels=LevelIncome::all();

           $transData=[];

           foreach($parentUsers as $key=>$parentuser)
           { // start parent user loop

              $packages= $parentuser->packages;
              $directUser=$parentuser->DirectUser;
              $level=$levels[$key]; // level by index

              if($packages->count()==0)
                 continue;

              if($level->direct_count > $directUser->count())
                  continue;

                $levelamount=$package->invest_amount*($level->income/100);

               $parentuser->TotalLevelIncome()->attach($level->id,['amount'=>$levelamount,'from_user_id'=>$user->id]);

               $transData[]=[
                  'user_id'=>$parentuser->id,
                  'amount'=>$levelamount,
                  'trans'=>config('transection.total_level_income',4),
                  'type_id'=>$level->id
               ];
           }//end parent user loop

           Transection::insert($transData);
          return true;
        }
        catch(\Exception $e)
        {
            return $e->getMessage();
        }
    }

    public static function TotalIncome($user_id)
    {
        try
        {
            $trans_ids=[config('transection.roi_income',1),config('transection.level_income',3)];
            $TotalIncome=Transection::where('user_id',$user_id)->whereIn('trans',$trans_ids)->get()->sum('amount');

            return round($TotalIncome,4);

        }
        catch(\Exception $e)
        {
            return $e->getMessage();
        }
    }


    public static function LevelwiseTeam($id)
    {
        try
        {

            $Team=User::TotalTeam($id,['AllPackages','parent']);

            $TotalTeam=$Team->count();

            $levelData=[];

            for($i=1;$i<=20;$i++){

               $levelTeam= $Team->filter(function($collect)use($i,$id){

                      $parent_str=explode(',',$collect->parent_str);
                      $length=count($parent_str)-2;
                      $index=array_search($id,$parent_str);
                      return $length-$index==$i;

                    });

                    $levelData[]=['level'=>$levelTeam->count(),'team'=>$levelTeam];

                }

           $TotatBusiness=$Team->map(function($collect){
                  return $collect->AllPackages->sum('invest_amount');
           })->sum();

           $TotalActive=$Team->filter(function($collect){
              return $collect->AllPackages->count()>0;
           })->count();

           $TotalInActive=$Team->filter(function($collect){
            return $collect->AllPackages->count()==0;
           })->count();

        //    dd($levelData);

           return [
             'total_team'=>$TotalTeam,
             'total_business'=>$TotatBusiness,
             'total_active'=>$TotalActive,
             'total_inactive'=>$TotalInActive,
             'levels'=>$levelData
           ];

        }
        catch(\Exception $e)
        {
            return $e->getMessage();
        }
    }

   public static function UserIncomes($user_id)
   {
       try
       {
           $query=Transection::where('user_id',$user_id)->where('status',1);

           $data=[
               'total_package'=>0,
               'roi_income'=>0,
               'level_income'=>0,
               'reward_income'=>0,
               'aitp_token'=>0,
               'income_percent'=>0,
               'total_income'=>0,
               'withdrawal'=>0,
               'available_income'=>0
           ];
           foreach($query->cursor() as $key=> $value)
           {
                if($value->trans==config('transection.package',0))
                   $data['total_package']+=$value->amount;
                if($value->trans==config('transection.roi_income',1))
                   $data['roi_income']+=$value->amount;
                if($value->trans==config('transection.level_income',3))
                   $data['level_income']+=$value->amount;
                if($value->trans==config('transection.reward_income',5))
                   $data['reward_income']+=$value->amount;
                if($value->trans==config('transection.aitp_token',6))
                   $data['aitp_token']+=$value->amount;
                if($value->trans==config('transection.withdrawal',7))
                   $data['withdrawal']+=$value->amount;
            }

            if($data['total_package']>0)
              $data['income_percent']=round(($data['roi_income']+$data['level_income'])/($data['total_package']*env('IncomeCap',3))*100,2);

              $data['total_income']=(float)number_format($data['roi_income']+$data['level_income']+$data['reward_income'],4);
              $data['available_income']=(float) number_format($data['total_income']-$data['withdrawal'],4);

         return $data;

       }
       catch(\Exception $e)
       {
          return $e->getMessage();
       }
   }

   public static function BoosterCheck($user_id)
   {
       try
       {   DB::beginTransaction();
           $user=User::with('packages','DirectUser','Directuser.packages')->where('id',$user_id)->first();

           $package=$user->packages->pop(); // get last package

           $directusers=$user->DirectUser; // get all user direct

           
           $data=[
               'booster'=>0,
               'direct_count'=>0,
               'booster_time'=>0
           ];

           if(!$package)
              return $data;

            if($package->pivot->booster_status=='1')
               {
                   $data['booster']=2;
                   $data['direct_count']=3;
                   return $data;
               }

             if($package->pivot->booster_status=='2')
             {
                 $data['booster']=3;
                 return $data;
             }

               $packageboostertime=$package->pivot->created_at->timestamp+(86400*env('Booster_time',7));
               $data['booster']=1;
               $data['booster_time']=$packageboostertime;


           if($directusers->count()==0)
              return $data;

           $afterpackagedirect=$directusers->filter(function($collect)use($package){
            $directpackage=$collect->packages->pop();
            if(!$directpackage)
               return false;

            return $directpackage->pivot->created_at->timestamp > $package->pivot->created_at->timestamp && $directpackage->invest_amount >= $package->invest_amount;
         });

        $data['direct_count']=$afterpackagedirect->count();

            if(time()>$packageboostertime)
                  {
                    $package->pivot->booster_status=2;
                    $package->pivot->save();
                    DB::commit();
                 }
                 else{
                    if($afterpackagedirect->count() >= env('Booster_count',3))
                    {
                        $package->pivot->booster_status=1;
                        $package->pivot->booster_activate_date=date('Y-m-d H:i:s');
                        $package->pivot->save();
                        DB::commit();
                        $data['booster']=2;
                        $data['direct_count']=3;
                    }
                 }
        return $data;

       }
       catch(\Exception $e)
       {
           DB::rollBack();
           return $e->getMessage();
       }
   }
}
