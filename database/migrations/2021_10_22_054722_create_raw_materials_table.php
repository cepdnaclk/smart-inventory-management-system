<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRawMaterialsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('raw_materials', function (Blueprint $table) {
            $table->id();
            $table->char("code", 8)->default('');
            $table->string("title");
            $table->string("color")->nullable();
            $table->text("description")->nullable();
            $table->text("specifications")->nullable();
            $table->float("quantity")->nullable();  // in units
            $table->string("unit")->nullable();
            $table->string('thumb')->nullable();
            $table->enum('availability', array_keys(\App\Models\RawMaterials::availabilityOptions()));
            $table->text("notes")->nullable();
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
        Schema::dropIfExists('raw_materials');
    }
}
