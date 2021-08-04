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
            $table->char("code", 8)->default('');

            $table->string("title");
            $table->char("brand", 32)->nullable();
            $table->text("specifications")->nullable();
            $table->text("description")->nullable();
            $table->text("instructions")->nullable();

            $table->boolean("isElectrical")->default(false);
            $table->float("powerRating")->nullable(); // in Watts
            $table->float("price")->nullable(); // in LKR

            // Dimensions and Physical Properties
            $table->float("width")->nullable()->default(0);
            $table->float("length")->nullable()->default(0);
            $table->float("height")->nullable()->default(0);
            $table->float("weight")->nullable()->default(0);

            $table->string('thumb')->nullable();
            $table->bigInteger('equipment_type_id')->nullable();

            $table->foreign('equipment_type_id')
                ->nullable()
                ->references('id')
                ->on('equipment_types');

            $table->timestamps();
        });

//        Schema::table('equipment_items', function($table) {
//            $table->foreignId('equipment_type_id')->constrained()->nullable();
//        });
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
