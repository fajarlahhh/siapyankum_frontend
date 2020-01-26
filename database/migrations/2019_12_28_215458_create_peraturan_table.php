<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePeraturanTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('peraturan_jenis', function (Blueprint $table) {
            $table->bigIncrements('peraturan_jenis_id');
            $table->string('peraturan_jenis_nama')->unique();
            $table->timestamps();
            $table->softDeletes();
        });
        Schema::create('peraturan', function (Blueprint $table) {
            $table->bigIncrements('peraturan_id');
            $table->string('peraturan_judul')->unique();
            $table->longText('peraturan_file');
            $table->unsignedBigInteger('peraturan_jenis_id');
            $table->string('operator');
            $table->timestamps();
            $table->foreign('peraturan_jenis_id')->references('peraturan_jenis_id')->on('peraturan_jenis')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('peraturan');
        Schema::dropIfExists('peraturan_jenis');
    }
}
