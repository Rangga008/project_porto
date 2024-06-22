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
        Schema::create('kegiatans', function (Blueprint $table) {
            $table->id();
            $table->foreignID('mahasiswa_id');
            $table->string('jabatan');
            $table->string('kegiatan');
            $table->string('periode');
            $table->string('image');
            $table->string('status', 50);
            $table->softDeletes(); //agar ketika menghapus data, tidak langsung hilang
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('kegiatans');
    }
};
