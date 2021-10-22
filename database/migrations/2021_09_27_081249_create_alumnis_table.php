<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAlumnisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('alumnis', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->references('id')->on('users');
            $table->string('npm');
            $table->string('nama');
            $table->string('agama');
            $table->string('tempat_lahir');
            $table->date('tanggal_lahir');
            $table->enum('jenis_kelamin', ['L', 'P']);
            $table->string('alamat');
            $table->string('nama_ayah');
            $table->string('nama_ibu');
            $table->string('alamat_orang_tua');
            $table->string('pekerjaan_ayah');
            $table->string('pekerjaan_ibu');
            $table->string('no_hp');
            $table->enum('golongan_darah', ['A', 'B', 'AB', 'O']);
            $table->integer('tinggi_badan');
            $table->integer('berat_badan');
            $table->enum('status', ['Kawin', 'Belum Kawin'])->nullable();
            $table->string('judul_skripsi')->nullable();
            $table->string('asal_slta')->nullable();
            $table->date('tanggal_wisuda')->nullable();
            $table->date('tanggal_sidang')->nullable();
            $table->integer('bobot_sks')->nullable();
            $table->date('tanggal_seminar_proposal')->nullable();
            $table->date('tanggal_mulai_bimbingan')->nullable();
            $table->string('dosen_pembimbing_1')->nullable();
            $table->string('dosen_pembimbing_2')->nullable();
            $table->string('dosen_penguji_1')->nullable();
            $table->string('dosen_penguji_2')->nullable();
            $table->string('jumlah_sks')->nullable();
            $table->string('foto')->nullable();
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
        Schema::dropIfExists('alumnis');
    }
}
