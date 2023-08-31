<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class MetaTransection extends Model
{
    use HasFactory,SoftDeletes;

    protected $table='meta_transections';
    protected $fillable=[
      'user_id',
      'transection_id',
      'currency_id',
      'package_id',
      'amount',
      'token_amount',
      'wallet_address',
      'status',
      'checkout',
      'curl_response',
      'error_response'
    ];

    public function currency()
    {
        return $this->hasOne(Currency::class,'id','currency_id');
    }

    public function package()
    {
        return $this->hasOne(Package::class,'id','package_id');
    }
    public function User()
    {
        return $this->hasOne(User::class,'id','user_id');
    }

}
