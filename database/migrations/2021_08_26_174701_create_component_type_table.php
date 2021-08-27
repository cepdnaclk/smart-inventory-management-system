<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateComponentTypeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('{_component_type}', function (Blueprint $table) {
            $table->id();
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
