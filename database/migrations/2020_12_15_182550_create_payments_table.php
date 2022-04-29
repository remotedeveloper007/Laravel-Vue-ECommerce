<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePaymentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('payments', function (Blueprint $table) {
            $table->string('id');
            $table->bigInteger('user_id')->unsigned(); 
            // $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade'); 
            $table->string('order_id');
            // $table->foreign('order_id')->references('id')->on('orders');
            $table->string('payer_id');
            $table->string('transaction_id');
            $table->string('payment_mode');
            $table->string('currency_code');
            $table->string('payment_status');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('payments');
    }
}
