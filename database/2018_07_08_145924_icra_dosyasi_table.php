<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class IcraDosyasiTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('icra_dosyasi', function (Blueprint $table) {
            $table->engine = "InnoDB";
            $table->increments('id')->unsigned()->index();
            $table->string('dosya_no');
            $table->string('ili');
            $table->string('mahkeme');
            $table->string('alacakli');
            $table->string('borclu');
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
        Schema::dropIfExists('icra_dosyasi');
    }
}
