<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateArmyCostRankAllowancesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('army_ranks', function(Blueprint $table) {
            $table->string('id')->primary();
            $table->string('name');
        });

        Schema::create('army_cost_rank_allowances', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('points');
            $table->string('army_rank_id');
            $table->integer('allowance')->nullable(false);

            $table->unique(['points', 'army_rank_id']);
            $table->foreign('army_rank_id')->references('id')->on('army_ranks')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('army_ranks');
        Schema::dropIfExists('army_cost_rank_allowances');
    }
}
