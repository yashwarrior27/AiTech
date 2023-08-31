<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {if(!Schema::hasTable('transections')){
        Schema::create('transections', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->integer('meta_transection_id')->nullable();
            $table->float('amount',20,4);
            $table->integer('trans')->comment('0=>packagePurchase,1=>roiIncome,2=>levelIncome,3=>rewardIncome,4=>withdrawal');
            $table->integer('type_id')->comment('relation id of there own type');
            $table->boolean('status')->default(1);
            $table->timestamps();
            $table->timestamp('deleted_at')->nullable();
        });
    }
    }
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transections');
    }
};
