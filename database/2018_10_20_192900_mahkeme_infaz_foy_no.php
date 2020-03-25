<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class MahkemeInfazFoyNo extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mahkeme_infaz_foy_no', function (Blueprint $table) {
            $table->engine = "InnoDB";
            $table->increments('id');
            $table->unsignedInteger('mahkeme_id');
            $table->unsignedInteger('kategori');
            $table->timestamps();

            $table->foreign('mahkeme_id')
                ->references('id')
                ->on('infaz_dosyasi_table');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('mahkeme_infaz_foy_no');
    }
}
