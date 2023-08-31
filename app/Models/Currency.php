<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Currency extends Model
{
    use HasFactory,SoftDeletes;

    protected $table='currencies';
    protected $fillable=[
      'symbol',
      'c_type',
      'name',
      'fees',
      'address',
      'chain_id',
      'status'
    ];
}
