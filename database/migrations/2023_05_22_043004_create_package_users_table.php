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
    {if(!Schema::hasTable('package_users')){
        Schema::create('package_users', function (Blueprint $table) {
            $table->id();
            $table->foreignId('package_id')->references('id')->on('packages')->onDelete('cascade');
            $table->foreignId('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->unsignedBigInteger('meta_transection_id');
            $table->boolean('booster_status')->nullable()->comment('1=>Active,0=>Pending,2=>Expired,null=>package not purchased');
            $table->boolean('fastrack_status')->nullable()->comment('1=>Active,0=>Pending,2=>Expired,null=>package not purchased');
            $table->boolean('status')->default(1);
            $table->timestamp('booster_activate_date')->nullable();
            $table->timestamp('fastrack_activate_date')->nullable();
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
        Schema::dropIfExists('package_users');
    }
};
