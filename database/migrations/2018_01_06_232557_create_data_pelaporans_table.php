<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDataPelaporansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('data_pelaporans', function (Blueprint $table) {
            $table->increments('id');
            $table->string('keterangan')->nullable();
            $table->string('noTelp')->nullable();
            $table->string('lat')->nullable();
            $table->string('lon')->nullable();
            $table->string('lokasi')->nullable();
            $table->string('kot');
            $table->string('kec');
            $table->string('ketlok')->nullable();
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
        Schema::dropIfExists('data_pelaporans');
    }
}
