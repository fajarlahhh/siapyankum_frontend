<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBantuanHukumTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bantuan_hukum', function (Blueprint $table) {
            $table->bigIncrements('bantuan_hukum_id');
            $table->string("bantuan_hukum_judul");
            $table->date("bantuan_hukum_tanggal");
            $table->string("bantuan_hukum_laporan_nomor");
            $table->string("bantuan_hukum_jenis", 20);
            $table->string("operator");
            $table->timestamps();
        });
        Schema::create('bantuan_hukum_proses', function (Blueprint $table) {
            $table->unsignedBigInteger('bantuan_hukum_id');
            $table->date("bantuan_hukum_proses_tanggal");
            $table->string("bantuan_hukum_proses_status");
            $table->longtext("bantuan_hukum_proses_deskripsi");
            $table->string("operator");
            $table->timestamps();
            $table->primary(['bantuan_hukum_id', 'bantuan_hukum_proses_status'], 'bantuan_hukum_proses_primary_key');
            $table->foreign('bantuan_hukum_id')->references('bantuan_hukum_id')->on('bantuan_hukum')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('bantuan_hukum_proses');
        Schema::dropIfExists('bantuan_hukum');
    }
}
