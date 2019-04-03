<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateArmyRostersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('army_rosters', function (Blueprint $table) {
            $table->unsignedBigInteger('army_id');
            $table->unsignedBigInteger('unit_id');
            $table->timestamps();

            $table->foreign('army_id')->references('id')->on('armies')->onUpdate('cascade')->onDelete('restrict');
            $table->foreign('unit_id')->references('id')->on('units')->onUpdate('cascade')->onDelete('restrict');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('army_rosters');
    }
}
