<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateYorumsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('yorums', function (Blueprint $table) {
            $table->engine = "InnoDB";
            $table->increments('id');
            $table->integer('icra')->unsigned()->index();
            $table->integer('infaz')->unsigned()->index();
            $table->integer('user_id');
            $table->string('kategori');
            $table->string('name');
            $table->text('govde');
            $table->timestamps();

            $table->foreign('icra')
                ->references('id')
                ->on('icra_dosyasi')
                ->onDelete('cascade');

            $table->foreign('infaz')
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
        Schema::dropIfExists('yorums');
    }
}
