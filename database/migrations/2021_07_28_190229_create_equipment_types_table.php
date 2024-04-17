<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEquipmentTypesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('equipment_types', function (Blueprint $table) {
            $table->id()->startingValue(10);
            $table->char("code", 8)->default('');
            $table->integer("parent_id")->nullable();

            $table->string("title");
            $table->string("subtitle")->nullable();
            $table->text("description")->nullable();
            $table->string('thumb')->nullable();

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
        Schema::dropIfExists('equipment_types');
    }
}
