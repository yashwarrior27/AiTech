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
    {if(!Schema::hasTable('packages')){
        Schema::create('packages', function (Blueprint $table) {
            $table->id();
            $table->float('invest_amount');
            $table->integer('monthly_roi')->comment('In percentage');
            $table->float('daily_roi',8,4)->comment('percentage convert into daily');
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
        Schema::dropIfExists('packages');
    }
};
