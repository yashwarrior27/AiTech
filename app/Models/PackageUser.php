<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PackageUser extends Model
{
    use HasFactory;
    protected $table='package_users';
    protected $fillable=[
       'package_id',
       'user_id',
       'meta_transection_id',
       'status',
       'booster_activate_date',
       'fastrack_activate_date',
       'booster_status',
       'fastrack_status',
    ];

    public function package()
    {
        return $this->hasOne(Package::class,'id','package_id');
    }

    public function metaTransection()
    {
        return $this->hasOne(MetaTransection::class,'id','meta_transection_id');
    }

    public static function AllUserPackages($id,$relation=[])
    {
       return static::with($relation)->where('user_id',$id)->orderByDesc('id')->get();

    }
    public function User()
    {
        return $this->hasOne(User::class,'id','user_id');
    }
}
