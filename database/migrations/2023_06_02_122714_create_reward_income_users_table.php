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
    {   if(!Schema::hasTable('reward_income_users')){
        Schema::create('reward_income_users', function (Blueprint $table) {
            $table->id();
            $table->foreignId('reward_income_id')->references('id')->on('reward_incomes')->onDelete('cascade');
            $table->foreignId('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->integer('count')->default(0);
            $table->integer('monthly_count')->default(1);
            $table->integer('next_reward_id')->nullable();
            $table->boolean('status')->default(1);
            $table->timestamps();
        });
    }
    }
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reward_income_users');
    }
};
