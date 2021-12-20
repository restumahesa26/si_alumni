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
            $table->string('agama', 10);
            $table->string('tempat_lahir', 20);
            $table->date('tanggal_lahir');
            $table->enum('jenis_kelamin', ['L', 'P']);
            $table->string('alamat');
            $table->string('nama_ayah', 40);
            $table->string('nama_ibu', 40);
            $table->string('alamat_orang_tua');
            $table->string('pekerjaan_ayah', 20);
            $table->string('pekerjaan_ibu', 20);
            $table->string('no_hp', 13);
            $table->enum('golongan_darah', ['A', 'B', 'AB', 'O']);
            $table->integer('tinggi_badan');
            $table->integer('berat_badan');
            $table->string('pekerjaan', 30)->nullable();
            $table->string('tempat_pekerjaan', 50)->nullable();
            $table->enum('status', ['Kawin', 'Belum Kawin'])->nullable();
            $table->string('judul_skripsi')->nullable();
            $table->string('asal_slta', 50)->nullable();
            $table->date('tanggal_wisuda')->nullable();
            $table->date('tanggal_sidang')->nullable();
            $table->integer('bobot_sks')->nullable();
            $table->date('tanggal_seminar_proposal')->nullable();
            $table->date('tanggal_mulai_bimbingan')->nullable();
            $table->string('dosen_pembimbing_1', 40)->nullable();
            $table->string('dosen_pembimbing_2', 40)->nullable();
            $table->string('dosen_penguji_1', 40)->nullable();
            $table->string('dosen_penguji_2', 40)->nullable();
            $table->integer('jumlah_sks')->nullable();
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
