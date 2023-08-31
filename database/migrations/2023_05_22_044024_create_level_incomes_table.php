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
    {   if(!Schema::hasTable('level_incomes')){
        Schema::create('level_incomes', function (Blueprint $table) {
            $table->id();
            $table->integer('level');
            $table->integer('income')->comment('in percentage');
            $table->float('daily_income')->default(0.5)->comment('in percentage');
            $table->integer('days')->default(200);
            $table->integer('direct_count');
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
        Schema::dropIfExists('level_incomes');
    }
};
