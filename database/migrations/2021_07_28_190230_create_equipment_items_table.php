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
            $table->id()->startingValue(1000);;
            $table->char("code", 8)->default('');

            $table->string("title");

            $table->string("brand")->nullable();
            $table->string("productCode")->nullable();

            $table->integer("quantity")->default(0); // Number of copies available

            $table->text("specifications")->nullable();
            $table->text("description")->nullable();
            $table->text("instructions")->nullable();

            $table->boolean("isElectrical")->default(false);
            $table->float("powerRating")->nullable(); // in Watts
            $table->float("price")->nullable(); // in LKR

            // Dimensions and Physical Properties
            $table->float("width")->nullable();
            $table->float("length")->nullable();
            $table->float("height")->nullable();
            $table->float("weight")->nullable();

            $table->string('thumb')->nullable();
            $table->timestamps();

            $table->foreignId('equipment_type_id')
                ->constrained()
                ->references('id')
                ->onDelete('cascade')
                ->on('equipment_types');
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
