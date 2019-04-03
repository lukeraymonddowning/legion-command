<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateUnitsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('factions', function (Blueprint $table) {
            $table->string('id')->primary();
            $table->string('name');
            $table->string('force_side');
            $table->softDeletes();
            $table->timestamps();
        });

        Schema::table('units', function (Blueprint $table) {
            $table->string('faction');
            $table->foreign('faction')->references('id')->on('factions')
                ->onUpdate('cascade')
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
        //
    }
}
