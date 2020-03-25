<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class InfazDosyasiTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('infaz_dosyasi_table', function (Blueprint $table) {
            $table->engine = "InnoDB";
            $table->increments('id');
            $table->string('dosya_no');
            $table->string('ili');
            $table->string('mahkeme');
            $table->string('davaci');
            $table->string('davali');
            $table->string('kategori');
            $table->string('user_id');
            $table->string('durum')->default('Derdest');
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
        Schema::dropIfExists('infaz_dosyasi_table');
    }
}
