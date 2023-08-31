<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Helpdesk extends Model
{
    use HasFactory;
    protected $table='helpdesks';
    protected $fillable=['user_id','subject','image','message','status','email'];

    public function user()
    {
        return $this->hasOne(User::class,'id','user_id');
    }
}
