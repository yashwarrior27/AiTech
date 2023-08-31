<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LevelIncomeUser extends Model
{
    use HasFactory;

    protected $table='level_income_users';
    protected $fillable=['level_income_id','user_id','from_user_id','amount','count','status'];

    public function user()
    {
        return $this->hasOne(User::class,'id','user_id');
    }

    public function FromUser()
    {
        return $this->hasOne(User::class,'id','from_user_id');
    }

    public function LevelIncome()
    {
        return $this->hasOne(LevelIncome::class,'id','level_income_id');
    }

    public static function AllLevelIncomes($relation=[])
    {
        return static::with($relation)->where('status',1)->get();
    }

    public static function UserTotalLevelIncomes($id,$relation=[])
    {
       return static::with($relation)->where('user_id',$id)->orderBy('id','DESC')->get();
    }

}
