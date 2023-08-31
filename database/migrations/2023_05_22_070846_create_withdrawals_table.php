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
        Schema::create('withdrawals', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->integer('currency_id');
            $table->float('amount');
            $table->float('token_amount');
            $table->text('wallet_address');
            $table->text('transection_id')->nullable();
            $table->integer('trans_id')->nullable();
            $table->enum('status',['pending','success','rejected'])->default('pending');
            $table->text('curl_response')->nullable();
            $table->text('error_responnse')->nullable();
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
        Schema::dropIfExists('withdrawals');
    }
};
