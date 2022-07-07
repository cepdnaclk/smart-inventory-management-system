<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEquipmentItemStationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('equipment_item_stations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('equipment_item_id')->constrained()->references('id')->onDelete('cascade')->on('equipment_items');
            $table->foreignId('stations_id')->constrained()->references('id')->onDelete('cascade')->on('stations');
        });
    }
    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('equipment_item_stations');
    }
}
