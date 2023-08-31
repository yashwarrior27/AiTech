<?php

namespace App\Http\Controllers\Admin;

use App\Helper\Helper;
use App\Http\Controllers\Controller;
use App\Models\Helpdesk;
use App\Models\LevelIncomeUser;
use App\Models\MetaTransection;
use App\Models\Package;
use App\Models\PackageUser;
use App\Models\RewardIncomeUser;
use App\Models\Transection;
use App\Models\User;
use App\Models\Withdrawal;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
    public function Index()
    {
        if(Auth::check())
           Auth::logout();

        return view('auth.login');
    }

    public function AdminLogin(Request $request)
    {
        $request->validate([
             'wallet_address'=>'required|exists:users,wallet_address,id,'.env('AdminId',1)
        ]);
        try
        {
            Auth::loginUsingId(env('AdminId',1));
            return redirect('/admin/dashboard');
        }
        catch(\Exception $e)
        {
            return $this->ErrorMessage($e);
        }
    }

    public function Dashboard()
    {
    try
    {
        return view('admin.pages.dashboard.index');
    }
    catch(\Exception $e)
    {
        return $this->ErrorMessage($e);
    }
   }

   public function Users()
   {
       try
       {   $title='All Users';
           $results=User::with('parent')->where('id','>',env('AdminId',1))->orderBy('id','DESC');
            return view('admin.pages.users.index',compact('results','title'));
       }
       catch(\Exception $e)
       {
           return $this->ErrorMessage($e);
       }
   }

   public function UserStatusUpdate(User $user)
   {
       try
       {
           if($user->id!=env('AdminId',1))
           {
              $user->status=$user->status==1?0:1;
              $user->save();
           }
           return redirect()->back()->with('success','Update Successfully.');
       }
       catch(\Exception $e)
       {
           return $this->ErrorMessage($e);
       }
   }

   public function UserPackages()
   {
       try
       {
           $title='User Packages';
           $results=PackageUser::with('User','package')->orderBy('id','Desc');
           return view('admin.pages.user_packages.index',compact('title','results'));
       }
       catch(\Exception $e)
       {
           return $this->ErrorMessage($e);
       }
   }

   public function UserLevelRewards()
   {
       try
       {
           $title='User Level Rewards';
           $results=LevelIncomeUser::with('user','FromUser')->orderBy('id','Desc');
           return view('admin.pages.user_level_rewards.index',compact('title','results'));

       }
       catch(\Exception $e)
       {
           return $this->ErrorMessage($e);
       }
   }

   public function UserRewards()
   {
       try
       {
         $title='User Rewards';
         $results=RewardIncomeUser::with('user','rewardIncome')->orderBy('id','Desc');
         return view('admin.pages.user_rewards.index',compact('title','results'));
       }
       catch(\Exception $e)
       {
           return $this->ErrorMessage($e);
       }
   }

   public function RoiIncomes()
   {
       try
       {
           $title='ROI Incomes';
           $results=Transection::with('User','packageUser','packageUser.package')->where('trans',config('transection.roi_income',1))->orderBy('id','Desc');
           return view('admin.pages.roi_incomes.index',compact('title','results'));
       }
       catch(\Exception $e)
       {
           return $this->ErrorMessage($e);
       }
   }

   public function LevelIncomes()
   {
       try
       {
           $title='Daily Level Incomes';
           $results=Transection::with('User','LevelIncome')->where('trans',config('transection.level_income',3))->orderBy('id','Desc');
           return view('admin.pages.level_incomes.index',compact('title','results'));
       }
       catch(\Exception $e)
       {
           return $this->ErrorMessage($e);
       }
   }

   public function RewardIncomes()
   {
       try
       {
          $title='Daily Reward Incomes';

          $results=Transection::with('User','RewardIncome','RewardIncome.rewardIncome')->where('trans',config('transection.reward_income',5))->orderBy('id','Desc');
          return view('admin.pages.reward_incomes.index',compact('title','results'));
       }
       catch(\Exception $e)
       {
           return $this->ErrorMessage($e);
       }
   }

   public function WithdrawalLogs()
   {
       try
       {
           $title='Withdrawal Logs';
           $results=Withdrawal::with('User','currency','trans')->orderBy('id','Desc');
           return view('admin.pages.withdrawal_logs.index',compact('title','results'));

       }
       catch(\Exception $e)
       {
           return $this->ErrorMessage($e);
       }
   }

   public function Logout()
   {
       try
       {
           if(Auth::check())
              Auth::Logout();

              return redirect('/admin');

       }
       catch(\Exception $e)
       {
           return $this->ErrorMessage($e);
       }
   }

   public function UpdateUserWallet(User $user,Request $request)
   {   
       $request->validate([
          "wallet_address{$user->id}"=>'required|unique:users,wallet_address'
       ],[
           'required'=>'This field is required.',
           'unique'=>'Wallet address already exists.'
       ]);

       try
       {
           $data=$request->all();
           $user->wallet_address= strtolower($data["wallet_address{$user->id}"]);
           $user->save();
           return redirect()->back()->with('success','Update successfuly.');
       }
       catch(\Exception $e)
       {
           return $this->ErrorMessage($e);
       }
   }

   public function BuyPackage()
   {
       try
       {   $title='Buy Package';

           return view('admin.pages.buy_package.index',compact('title'));
       }
       catch(\Exception $e)
       {
           return $this->ErrorMessage($e);
       }
   }

   public function WalletAddress(Request $request)
   {
       $request->validate([
          'wallet_address'=>'required|exists:users,wallet_address'
       ]);
       try
       {   $title='Buy Package';


           $user=User::where('wallet_address',$request->wallet_address)->first();
           $package_id=1;
           $package =$user->AllPackages->sortBy([['pivot.id','DESC']])->values()->first();
           $package_status=1;

           if($package)
           {
              $package_id=$package->id;

              $packagetime=$package->pivot->created_at->timestamp+(86400*env('Package_time',15));

              if(time()<$packagetime && $package->pivot->fastrack_status==0 && $package->pivot->status==1)
                 $package_status=0;
            }

          $packages=Package::where('status',1)->where('id','>=',$package_id)->get();
          return view('admin.pages.buy_package.index',compact('title','packages','package_status','user'));

       }
       catch(\Exception $e)
       {
           return $this->ErrorMessage($e);
       }
   }

   public function PurchasePackage(User $user,Request $request)
   {
       $request->validate([
           'package'=>'required|numeric|exists:packages,id'
       ]);

       try
       {
           DB::beginTransaction();
        $package=Package::find($request->package);

        $prev=MetaTransection::where('user_id',$user->id)->where('status','pending')->first();
        
        if($prev)
        return redirect('/admin/buy-package')->with('error','Already have pending transection.');

        $metaTrans=MetaTransection::create([
         'user_id'=>$user->id,
         'transection_id'=>'buy_through_admin',
         'currency_id'=>env('Withdrawal_currency_id',1),
         'package_id'=>$request->package,
         'amount'=>$package->invest_amount,
         'token_amount'=>$package->invest_amount.'000000000000000000',
         'wallet_address'=>$user->wallet_address,
         'status'=>'success',
        ]);

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

         return redirect('/admin/buy-package')->with('success','Package Activated.');
       }
       catch(\Exception $e)
       {
           DB::rollBack();
           return $this->ErrorMessage($e);
       }
   }

   public function HelpDeskQuery(){
    try
    {   $title='HelpDesk Queries';
        $results=Helpdesk::with('user')->OrderBy('id','Desc')->get();
        return view('admin.pages.help_desk_query.index',compact('title','results'));
    }
    catch(\Exception $e)
    {
        return $this->ErrorMessage($e);
    }
}

public function PackageTransections()
{
    try
    {
        $title='Package Transections';
        $results=MetaTransection::with('User','package','currency')->orderBy('id','Desc');
        return view('admin.pages.package_transection.index',compact('title','results'));
    }
    catch(\Exception $e)
    {
        return $this->ErrorMessage($e);
    }
}

public function HelpdeskStatus(Helpdesk $helpdesk)
{
    try
    {
        $helpdesk->status=1;
        $helpdesk->save();
        return redirect()->back()->with('success','Resolved successful.');

    }
    catch(\Exception $e)
    {
        return $this->ErrorMessage($e);
    }
}
}


