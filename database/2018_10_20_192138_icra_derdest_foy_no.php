<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class IcraDerdestFoyNo extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('icra_derdest_foy_no', function (Blueprint $table) {
            $table->engine = "InnoDB";
            $table->increments('id');
            $table->unsignedInteger('icra_id');
            $table->unsignedInteger('kategori');
            $table->timestamps();

            $table->foreign('icra_id')
                ->references('id')
                ->on('icra_dosyasi');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
         Schema::dropIfExists('icra_derdest_foy_no');
    }
}
