<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddImageFieldLokersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('lokers', function (Blueprint $table) {
            $table->string('logo_perusahaan')->nullable();
            $table->enum('status', ['0','1'])->default('0');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('lokers', function (Blueprint $table) {
            $table->dropColumn('logo_perusahaan');
            $table->dropColumn('status');
        });
    }
}
