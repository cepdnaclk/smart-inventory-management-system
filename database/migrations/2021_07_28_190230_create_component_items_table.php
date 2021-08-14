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

            $table->string("name");
            $table->string("brand")->nullable();
            $table->string("productCode")->nullable();

            $table->text("specifications")->nullable();
            $table->text("description")->nullable();

            $table->boolean("isAvailable")->default(false);
            $table->float("price")->nullable(); // in LKR

            // Physical size in terms of appearance [small, medium, large] kind of
            $table->enum('size', ['very small', 'small', 'regular', 'large', 'very large']);

            // Thought to have type and family as a property rather than having different tables
            $table->string("type")->nullable();
            $table->string("family")->nullable();

            $table->string('thumb')->nullable();
            $table->timestamps();

            /*$table->foreignId('component_type_id')
                ->constrained()
                ->references('id')
                ->onDelete('cascade')
                ->on('component_types');
                */
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
