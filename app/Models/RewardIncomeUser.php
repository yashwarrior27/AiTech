<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RewardIncomeUser extends Model
{
    use HasFactory;

    protected $table='reward_income_users';

    protected $fillable=[
        'reward_income_id',
        'user_id',
        'count',
        'monthly_count',
        'next_reward_id',
        'status',
    ];

    public function rewardIncome()
    {
        return $this->hasOne(RewardIncome::class,'id','reward_income_id');
    }

    public function user()
    {
        return $this->hasOne(User::class,'id','user_id');
    }

    public static function AllRewarduser($relation=[])
    {
        return static::with($relation)->where('status',1)->get();
    }

    public static function UserTotalRewardIncomes($id,$relation=[])
    {
         return static::with($relation)->where('user_id',$id)->orderBy('id','Desc')->get();
    }
}
