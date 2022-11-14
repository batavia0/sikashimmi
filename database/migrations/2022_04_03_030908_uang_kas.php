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
        Schema::create('uang_kas', function (Blueprint $table) {
            $table->increments('id_uang_kas');
            $table->integer('id_anggota');
            $table->integer('id_bulan_pembayaran');
            $table->integer('terbayar')->nullable();
            $table->integer('status_lunas')->nullable();
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
        //
    }
};
