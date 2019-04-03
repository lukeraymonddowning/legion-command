<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateArmyWithInventoryPreference extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('armies', function(Blueprint $table) {
            $table->boolean('limit_to_user_inventory')->default(0);
        });

        Schema::table('units', function(Blueprint $table) {
            $table->boolean('unique')->default(0);
            $table->integer('points_cost')->default(0);
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
