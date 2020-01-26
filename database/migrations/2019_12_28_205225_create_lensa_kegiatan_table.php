<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLensaKegiatanTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lensa_kegiatan', function (Blueprint $table) {
            $table->bigIncrements('lensa_kegiatan_id');
            $table->string('lensa_kegiatan_judul')->unique();
            $table->longText('lensa_kegiatan_file');
            $table->date('lensa_kegiatan_tanggal');
            $table->string('operator');
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
        Schema::dropIfExists('lensa_kegiatan');
    }
}
