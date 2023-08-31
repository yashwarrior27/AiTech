<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Withdrawal extends Model
{
    use HasFactory,SoftDeletes;
    protected $table='withdrawals';
    protected $fillable=[
      'user_id',
      'transection_id',
      'currency_id',
      'amount',
      'token_amount',
      'wallet_address',
      'status',
      'checkout',
      'curl_response',
      'error_responnse',
      'trans_id',
    ];

    public function currency()
    {
        return $this->hasOne(Currency::class,'id','currency_id');
    }
    public function trans()
    {
        return $this->hasOne(Transection::class,'id','trans_id');
    }

    public static function UserWithdrawal($id,$relation=[])
    {
        return static::with($relation)->where('user_id',$id)->orderBy('id','Desc')->get();
    }
    public function User()
    {
        return $this->hasOne(User::class,'id','user_id');
    }
}
