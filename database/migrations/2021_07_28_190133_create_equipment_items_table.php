<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEquipmentItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('equipment_items', function (Blueprint $table) {
            $table->id();

            $table->string("title");
            $table->char("brand", 32)->nullable();
            $table->string("specifications");
            $table->string("description");
            $table->string("instructions");

            $table->float("powerRating")->nullable(); // in Watts
            $table->float("price")->nullable(); // in LKR

            // Dimensions and Physical Properties
            $table->float("width")->nullable()->default(0);
            $table->float("length")->nullable()->default(0);
            $table->float("height")->nullable()->default(0);
            $table->float("weight")->nullable()->default(0);

            $table->boolean("isElectrical")->default(false);
            $table->foreignId('equipment_type_id')->constrained()->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('equipment_items');
    }
}
