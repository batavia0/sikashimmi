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
        Schema::create('bulan_pembayaran', function (Blueprint $table) {
            $table->increments('id_bulan_pembayaran');
            $table->enum('nama_bulan', ['januari', 'februari','maret','april','mei','juni','juli','agustus','september','oktober','november','desember']);
            $table->integer('tahun');
            $table->integer('nominal_bulanan');
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
