<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('order', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nim',14);
            $table->string('name');
            $table->string('email');
            $table->integer('id_bulan_pembayaran');
            $table->integer('id_uang_kas');
            $table->string('no_telepon');
            $table->string('transaction_id');
            $table->string('transaction_status');
            $table->string('transaction_time');
            $table->string('order_id');
            $table->string('status_code');
            $table->string('status_message')->nullable();
            $table->string('gross_amount');
            $table->string('payment_type');
            $table->string('payment_code')->nullable();
            $table->string('pdf_url')->nullable();
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
         Schema::dropIfExists('order');
    }
};
