<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTablesForUpgrades extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('upgrade_types', function (Blueprint $table) {
            $table->string('id')->primary();
            $table->string('name');
            $table->string('icon_asset_url')->nullable();
        });
        Schema::create('upgrades', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->string('upgrade_card_image_asset_url');
            $table->string('upgrade_type_id');

            $table->foreign('upgrade_type_id')->references('id')->on('upgrade_types')
                ->onDelete('cascade')
                ->onUpdate('cascade');
        });
        Schema::create('unit_upgrade_slots', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('unit_id');
            $table->string('upgrade_type_id');

            $table->foreign('unit_id')->references('id')->on('units')
                ->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('upgrade_type_id')->references('id')->on('upgrade_types')
                ->onDelete('cascade')->onUpdate('cascade');
        });
        Schema::create('army_roster_equipped_upgrades', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('army_roster_id');
            $table->unsignedBigInteger('unit_upgrade_slot_id');
            $table->unsignedBigInteger('upgrade_id');

            $table->foreign('army_roster_id')->references('id')->on('army_rosters')
                ->onUpdate('cascade')->onUpdate('cascade');
            $table->foreign('unit_upgrade_slot_id')->references('id')->on('unit_upgrade_slots')
                ->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('upgrade_id')->references('id')->on('upgrades')
                ->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('upgrade_types');
        Schema::dropIfExists('upgrades');
        Schema::dropIfExists('unit_upgrade_slots');
        Schema::dropIfExists('army_roster_equipped_upgrades');
    }
}
