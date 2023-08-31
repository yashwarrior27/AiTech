<?php

use App\Http\Controllers\Api\Auth\AuthController;
use App\Http\Controllers\Api\CryptoTransection\CryptoTransectionController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::controller(AuthController::class)->group(function(){

    Route::post('/login','login')->middleware('encryptCookie','startSession');
    Route::get('/logout','Logout')->middleware('encryptCookie','startSession');
    Route::post('/register','register');
    Route::post('/check-referral-no','CheckReferralNo');
});

Route::group(['prefex' => '/', 'middleware' => ['auth','encryptCookie','startSession']], function () {

    Route::controller(CryptoTransectionController::class)->group(function (){

        Route::post('/create-meta-trans','CreateMetaTransection');
        Route::post('/fail-meta-trans','FailMetaTransection');
        Route::post('/success-meta-trans','SuccessMetaTransection');
        Route::get('/check-meta-trans','CheckMetaTransection');
        Route::post('/update-meta-trans','UpdateMetaTransection');
        Route::post('/withdrawal-request','WithdrawalRequest');
        Route::get('/check-withdrawal','CheckWithdrawal');
        Route::get('/update-withdrawal','UpdateWithdrawal');

    });

});


