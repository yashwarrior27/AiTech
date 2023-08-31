<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\SoftDeletes;
class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $table='users';
    protected $fillable = [
        'wallet_address',
        'name',
        'email',
        'profile_image',
        'country_id',
        'phone',
        'register_id',
        'parent_id',
        'parent_str',
        'income_cap',
        'aitp_token',
        'status',
        'login_check_token'
    ];

    protected $appends=['countrycode'];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */

     public function getProfileImageAttribute($value)
     {
         return $value ?? 'user.png';
     }
     public function getCountrycodeAttribute()
  {
    return  \DB::table('countries')->where('id',$this->country_id)->first();
  }

     public function packages(){

        return $this->belongsToMany(Package::class,'package_users','user_id','package_id')->where('package_users.status',1)->withPivot('booster_status','fastrack_status','created_at','id','fastrack_activate_date','booster_activate_date','meta_transection_id');
     }

     public function TotalLevelIncome()
     {
         return $this->belongsToMany(LevelIncome::class,'level_income_users','user_id','level_income_id')->withPivot('id','created_at','amount','count','status','from_user_id');
     }

     public function TotalRewardIncome()
     {
         return $this->belongsToMany(RewardIncome::class,'reward_income_users','user_id','reward_income_id')->withPivot('id','count','monthly_count','next_reward_id','status','created_at')->orderByPivot('id','Desc');
     }

     public function AllPackages()
     {
         return $this->belongsToMany(Package::class,'package_users','user_id','package_id')->withPivot('booster_status','fastrack_status','created_at','id','fastrack_activate_date','booster_activate_date','meta_transection_id','status');
     }


     public function parent()
     {
         return $this->hasOne(self::class,'id','parent_id');
     }

     public function RoiIncome()
     {
         return $this->hasMany(Transection::class,'user_id','id')->where('trans',config('transection.roi_income',1));
     }

     public function LevelIncome()
     {
        return $this->hasMany(Transection::class,'user_id','id')->where('trans',config('transection.level_income',3));
     }

     public function DirectUser()
     {
         return $this->hasMany(static::class,'parent_id','id')->whereNotNull('income_cap');
     }

     public function TotalDirect()
     {
         return $this->hasMany(static::class,'parent_id','id');
     }

     public static function AllUser($relation=[])
     {
         return static::with($relation)->where('id','>',1)->whereNotNull('income_cap')->get();
     }

     public static function AllLevelParentUser($ids=[],$relation=[])
     {
         return static::with($relation)->wherein('id',$ids)->orderBy('id','Desc')->get();
     }

     public static function TotalTeam($id=null,$relation=[])
     {
         return static::with($relation)->where('id','>',$id)->where('parent_str','like',"%,{$id},%")->get();
     }

}
