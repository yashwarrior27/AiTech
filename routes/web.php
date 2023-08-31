<?php
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Cron\CronController;
use App\Http\Controllers\Frontend\DailyIncome\DailyIncomeController;
use App\Http\Controllers\Frontend\Dashboard\DashboardController;
use App\Http\Controllers\Frontend\Index\IndexController;
use App\Http\Controllers\Frontend\LevelIncome\LevelIncomeController;
use App\Http\Controllers\Frontend\LevelReward\LevelRewardController;
use App\Http\Controllers\Frontend\Package\PackageController;
use App\Http\Controllers\Frontend\Profile\ProfileController;
use App\Http\Controllers\Frontend\Reward\RewardController;
use App\Http\Controllers\Frontend\RewardIncome\RewardIncomeController;
use App\Http\Controllers\Frontend\Team\TeamController;
use App\Http\Controllers\Frontend\Wallet\WalletController;
use App\Http\Controllers\TestController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Artisan;
use App\Http\Controllers\Frontend\DirectTeam\DirectTeamController;
use App\Http\Controllers\Frontend\HelpDesk\HelpDeskController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::controller(IndexController::class)->group(function(){

    Route::get('/','Index');
    Route::get('/login','LoginRegister')->name('login');
    Route::get('/register/{referral_id?}','LoginRegister');

});

Route::group(['middleware' => ['auth','checkstatus','logincheck']], function () {

    Route::controller(DashboardController::class)->group(function(){

        Route::get('/dashboard','Index');
    });

    Route::controller(DailyIncomeController::class)->group(function(){

        Route::get('/daily_income','Index');

    });

    Route::controller(PackageController::class)->group(function(){

        Route::get('/packages','Index');
    });

    Route::controller(TeamController::class)->group(function(){

        Route::get('/team','Index');
    });

    Route::controller(WalletController::class)->group(function(){

        Route::get('/wallet','Index');

    });

    Route::controller(ProfileController::class)->group(function(){

        Route::get('/profile','Index');
        Route::post('/profile/update','Update');
        Route::post('/profile/image-upload','ImageUpload');
    });

    Route::controller(LevelIncomeController::class)->group(function(){

        Route::get('/level_income','Index');
    });

    Route::controller(RewardController::class)->group(function(){

        Route::get('/rewards','Index');
    });

    Route::controller(LevelRewardController::class)->group(function(){

        Route::get('/level_rewards','Index');

    });

    Route::controller(RewardIncomeController::class)->group(function(){

        Route::get('/reward_income','Index');

    });
    Route::controller(DirectTeamController::class)->group(function(){

        Route::get('/direct_team','Index');
    });

    Route::controller(HelpDeskController::class)->group(function(){

        Route::get('/help_desk','Index');
        Route::post('/help_desk/create','Store');

    });

});


//Cron Controller

 Route::controller(CronController::class)->group(function(){

    Route::get('/roi-cron','RoiCron');
    Route::get('/booster-fastrack-cron','BoosterFastrackCron');
    Route::get('/level-income-cron','LevelIncomeCron');
    Route::get('/reward-cron','RewardCron');
    Route::get('/reward-income-cron','RewardIncomeCron');
    Route::get('/withdrawal-update','WithdrawalUpdate');
    Route::get('/invest-cron','InvestCron');
    Route::get('/reject-invest-cron','RejectInvestCron');
 });

 Route::get('test',[TestController::class,'testing']);

 Route::get('/clear-cache', function () {
    Artisan::call('cache:clear');
    Artisan::call('route:clear');
    Artisan::call('view:clear');
    Artisan::call('config:clear');

    return "cache is clear";

});

 Route::controller(AdminController::class)->prefix('admin')->group(function(){

    Route::get('/','Index');
    Route::post('/login','AdminLogin');

  Route::group(['middleware'=>'adminauth'],function(){

    Route::get('/dashboard','Dashboard');
    Route::get('/users','Users');
    Route::get('/userstatus/{user}','UserStatusUpdate');
    Route::get('/user-packages','UserPackages');
    Route::get('/user-level-rewards','UserLevelRewards');
    Route::get('/user-rewards','UserRewards');
    Route::get('/roi-incomes','RoiIncomes');
    Route::get('/level-incomes','LevelIncomes');
    Route::get('/reward-incomes','RewardIncomes');
    Route::get('/withdrawal-logs','WithdrawalLogs');
    Route::get('/logout','Logout');
    Route::post('/update-wallet/{user}','UpdateUserWallet');
    Route::get('/buy-package','BuyPackage');
    Route::post('/buy-package/wallet-address','WalletAddress');
    Route::post('/buy-package/purchase/{user}','PurchasePackage');
    Route::get('/help-desk-query','HelpDeskQuery');
    Route::get('/package-transections','PackageTransections');
    Route::get('/helpdesk-status/{helpdesk}','HelpdeskStatus');
  });

 });
