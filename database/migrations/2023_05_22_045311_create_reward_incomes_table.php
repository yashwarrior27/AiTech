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
    {   if(!Schema::hasTable('reward_incomes')){
        Schema::create('reward_incomes', function (Blueprint $table) {
            $table->id();
            $table->float('total_business',20,4);
            $table->float('reward_amount',20,4)->comment('10% per of total business');
            $table->integer('per_day')->default(1)->comment('In percentage');
            $table->integer('days')->default(100);
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
        Schema::dropIfExists('reward_incomes');
    }
};
