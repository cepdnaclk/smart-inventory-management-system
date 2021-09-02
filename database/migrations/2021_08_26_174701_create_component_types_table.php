<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateComponentTypesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('component_types', function (Blueprint $table) {
            $table->id()->startingValue(10);
            $table->integer("parent_id")->nullable();
            $table->char("code", 8)->default('');
            $table->string("title");
            $table->string("subtitle")->nullable();
            $table->string("description")->nullable();
            $table->string("thumb")->nullable();
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
        Schema::dropIfExists('{_component_type}');
    }
}
