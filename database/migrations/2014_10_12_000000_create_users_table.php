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
    {if(!Schema::hasTable('users')){
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('wallet_address')->unique();
            $table->string('name')->nullable();
            $table->string('email')->nullable();
            $table->string('profile_image')->nullable();
            $table->integer('country_id');
            $table->string('phone')->nullable();
            $table->string('register_id');
            $table->integer('parent_id')->default(0);
            $table->text('parent_str')->nullable();
            $table->float('income_cap')->nullable()->comment('3x of the packages');
            $table->float('aitp_token',20,3)->default(0);
            $table->boolean('status')->default(1)->comment('1=>Active,0=>Deactive');
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
};
