<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class RewardIncome extends Model
{
    use HasFactory,SoftDeletes;

    protected $table='reward_incomes';
    protected $fillable=[
      'total_business',
      'reward_amount',
      'per_day',
      'days',
      'status'
    ];
}
