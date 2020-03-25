<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTahsilatAnasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tahsilat_anas', function (Blueprint $table) {
            $table->engine = "InnoDB";
            $table->increments('id');
            $table->unsignedInteger('icra_id');
            $table->unsignedInteger('infaz_id');
            $table->string('anlasilan_kisi');
            $table->string('ucret');
            $table->string('iletisim');
            $table->string('alan_kisi');
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
        Schema::dropIfExists('tahsilat_anas');
    }
}
