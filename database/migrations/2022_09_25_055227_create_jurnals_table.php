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
        Schema::create('jurnals', function (Blueprint $table) {
            $table->id();
            $table->foreignID('mahasiswa_id');
            $table->string('judul');
            $table->string('penulis');
            $table->string('jurnal');
            // $table->string('tahun');
            // $table->string('volume');
            // $table->string('halaman');
            $table->string('file');
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
        Schema::dropIfExists('jurnals');
    }
};
