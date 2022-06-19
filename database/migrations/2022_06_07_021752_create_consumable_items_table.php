<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateConsumableItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('consumable_items', function (Blueprint $table) {
            $table->id()->startingValue(1000);
            $table->char("code", 8)->nullable();
            $table->string("title");
            $table->integer("quantity")->nullable()->default(0);

            $table->text("specifications")->nullable();
            $table->text("description")->nullable();
            $table->text("instructions")->nullable();

            $table->float("powerRating")->nullable();
            $table->text("formFactor")->nullable();
            $table->text("voltageRating")->nullable();
            $table->text("datasheetURL")->nullable();
            $table->float("price")->nullable(); // in LKR
            $table->string('thumb')->nullable();

            $table->timestamps();

            $table->foreignId('consumable_type_id')
                ->constrained()
                ->references('id')
                ->onDelete('cascade')
                ->on('consumable_types');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('consumable_items');
    }
}
