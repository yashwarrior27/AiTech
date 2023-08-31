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
    {  if(!Schema::hasTable('level_income_users')){
        Schema::create('level_income_users', function (Blueprint $table) {
            $table->id();
            $table->foreignId('level_income_id')->references('id')->on('level_incomes')->onDelete('cascade');
            $table->foreignId('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreignId('from_user_id')->references('id')->on('users')->onDelete('cascade');
            $table->float('amount',20,5);
            $table->integer('count')->default(0);
            $table->boolean('status')->default(1);
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrent();
        });
    }
    }
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('level_income_users');
    }
};
