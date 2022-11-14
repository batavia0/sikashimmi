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
    Schema::create('riwayat', function (Blueprint $table) {
        $table->increments('id_riwayat');
        $table->integer('user_id');
        $table->integer('id_uang_kas');
        $table->text('aksi');
        $table->dateTime('tanggal');
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
