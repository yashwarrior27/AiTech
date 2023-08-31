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
    {
        Schema::create('meta_transections', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->text('transection_id');
            $table->integer('currency_id');
            $table->integer('package_id');
            $table->float('amount');
            $table->string('token_amount');
            $table->text('wallet_address');
            $table->enum('status',['success','pending','rejected'])->default('pending');
            $table->text('curl_response')->nullable();
            $table->text('error_response')->nullable();
            $table->integer('checkout')->default(0);
            $table->timestamps();
            $table->timestamp('deleted_at')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('meta_transections');
    }
};
