<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePendapatSaranTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pendapat_saran', function (Blueprint $table) {
            $table->bigIncrements('pendapat_saran_id');
            $table->string("pendapat_saran_judul")->unique();
            $table->date("pendapat_saran_tanggal");
            $table->string("pendapat_saran_laporan_nomor");
            $table->string("operator");
            $table->timestamps();
        });
        Schema::create('pendapat_saran_proses', function (Blueprint $table) {
            $table->unsignedBigInteger('pendapat_saran_id');
            $table->date("pendapat_saran_proses_tanggal");
            $table->string("pendapat_saran_proses_status");
            $table->longtext("pendapat_saran_proses_deskripsi");
            $table->string("operator");
            $table->timestamps();
            $table->primary(['pendapat_saran_id', 'pendapat_saran_proses_status'], 'pendapat_saran_proses_primary_key');
            $table->foreign('pendapat_saran_id')->references('pendapat_saran_id')->on('pendapat_saran')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pendapat_saran_proses');
        Schema::dropIfExists('pendapat_saran');
    }
}
