<?php
// database/migrations/2024_05_18_000003_create_mahasiswa_jurusan_pivot_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMahasiswaJurusanPivotTable extends Migration
{
    public function up()
    {
        Schema::create('mahasiswa_jurusan', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_mahasiswa');
            $table->unsignedBigInteger('id_jurusan');
            $table->timestamps();

            // Foreign key constraints
            $table->foreign('id_mahasiswa')->references('id')->on('tb_calon_mahasiswa')->onDelete('cascade');
            $table->foreign('id_jurusan')->references('id')->on('tb_jurusan')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('mahasiswa_jurusan');
    }
}

?>