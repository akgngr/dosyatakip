<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTahsilatsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tahsilats', function (Blueprint $table) {
            $table->engine = "InnoDB";
            $table->increments('id')->unsigned()->index();
            $table->string('alan_kisi');
            $table->integer('icra_id')->unsigned()->index();
            $table->integer('infaz_id')->unsigned()->index();
            $table->string('veren_kisi');
            $table->string('veren_kisi_iletisim');
            $table->string('ucret');
            $table->timestamps();

            $table->foreign('icra_id')
                ->references('id')
                ->on('icra_dosyasi')
                ->onDelete('cascade');

            $table->foreign('infaz_id')
                ->references('id')
                ->on('infaz_dosyasi_table')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tahsilats');
    }
}
