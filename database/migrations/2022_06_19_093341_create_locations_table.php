<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLocationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('locations', function (Blueprint $table) {
            //  1 Makerspace
            // 2 Desk ----- parentlocation 1
            $table->id();
            $table->string("location");
            $table->foreignId("parent_location")->nullable()->references("id")->on("locations")->onDelete("cascade");
            $table->integer("x")->nullable();
            $table->integer("y")->nullable();
            $table->integer("z")->nullable();
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
        Schema::dropIfExists('locations');
    }
}
