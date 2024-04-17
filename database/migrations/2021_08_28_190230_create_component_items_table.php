<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateComponentItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('component_items', function (Blueprint $table) {
            $table->id()->startingValue(1000);;
            $table->char("code", 8)->default('');

            $table->string("title");
            $table->string("brand")->nullable();
            $table->string("productCode")->nullable();
            $table->integer("quantity")->nullable()->default(0);

            $table->text("specifications")->nullable();
            $table->text("description")->nullable();
            $table->text("datasheet")->nullable();

            $table->float("price")->nullable(); // in LKR
            $table->string('thumb')->nullable();

            $table->timestamps();

            $table->foreignId('component_type_id')
                ->constrained()
                ->references('id')
                ->onDelete('cascade')
                ->on('component_types');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('component_items');
    }
}