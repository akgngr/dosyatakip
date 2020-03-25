<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class IcraInfazFoyNo extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('icra_infaz_foy_no', function (Blueprint $table) {
            $table->engine = "InnoDB";
            $table->increments('id');
            $table->unsignedInteger('icra_id');
            $table->unsignedInteger('kategori');
            $table->Integer('foy_no');
            $table->timestamps();

            $table->foreign('icra_id')
                ->references('id')
                ->on('icra_dosyasi')
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
        Shcema::dropIfExists('icra_infaz_foy_no');
    }
}
