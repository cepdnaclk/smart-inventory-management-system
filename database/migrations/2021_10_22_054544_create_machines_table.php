<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMachinesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('machines', function (Blueprint $table) {
            $table->id();
            $table->char("code", 8)->default('');
            $table->string("title");
            $table->enum('type', array_keys(\App\Models\Machines::types()));

            $table->float("build_width")->nullable();  // in mm
            $table->float("build_length")->nullable();  // in mm
            $table->float("build_height")->nullable();  // in mm

            $table->float("power")->nullable();  // in Watts
            $table->string('thumb')->nullable();

            $table->text("specifications")->nullable();
            $table->enum('status', array_keys(\App\Models\Machines::availabilityOptions()));
            $table->text("notes")->nullable();
            $table->float("lifespan")->default(0);  // in minutes
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
        Schema::dropIfExists('machines');
    }
}
