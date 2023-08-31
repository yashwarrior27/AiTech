<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class LevelIncome extends Model
{
    use HasFactory,SoftDeletes;

    protected $table='level_incomes';
    protected $fillable=[
      'level',
      'income',
      'daily_income',
      'days',
      'direct_count'
    ];
}
