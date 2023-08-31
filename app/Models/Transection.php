<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Transection extends Model
{
    use HasFactory,SoftDeletes;

    protected $table='transections';
    protected $fillable=[
      'user_id',
      'meta_transection_id',
      'amount',
      'trans',
      'type_id',
      'status'
    ];

    public function metaTransection()
    {
        return $this->hasOne(MetaTransection::class,'id','meta_transection_id');
    }

    public function package()
    {
        return $this->hasOne(Package::class,'id','type_id');
    }

    public function packageUser()
    {
        return $this->hasOne(PackageUser::class,'id','type_id');
    }

    public function RewardIncome()
    {
        return $this->hasOne(RewardIncomeUser::class,'id','type_id');
    }

    public function LevelIncome()
    {
        return $this->hasOne(LevelIncomeUser::class,'id','type_id');
    }

    public static function Incomes($id,$trans,$relations=[])
    {
         return static::with($relations)->where('user_id',$id)->where('trans',$trans)->orderBy('id','Desc');
    }

    public static function WalletHistory($id,$relations=[])
    {
        return static::with($relations)->where('user_id',$id)->where('trans','!=',config('transection.package',0))->where('trans','!=',config('transection.total_level_income',2))->where('trans','!=',config('transection.total_reward_income',4))->where('trans','!=',config('transection.aitp_token',6))->orderBy('id','DESC');
    }
    public function User()
    {
        return $this->hasOne(User::class,'id','user_id');
    }

}
