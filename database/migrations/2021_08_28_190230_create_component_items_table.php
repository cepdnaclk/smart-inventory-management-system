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
            $table->integer("quantity")->nullable();

            $table->text("specifications")->nullable();
            $table->text("description")->nullable();
            $table->text("instructions")->nullable();
            

            $table->boolean("isAvailable")->default(true);
            $table->boolean("isElectrical")->default(true);
            $table->float("powerRating");
            $table->float("price")->nullable(); // in LKR
            $table->string('thumb')->nullable();

            // Physical size in terms of appearance [small, medium, large] kind of
            //!tendable
            $table->enum('size', ['very small', 'small',  'medium','regular', 'large', 'very large']);



            
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
