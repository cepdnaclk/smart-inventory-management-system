<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateComponentItemOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('component_item_orders', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->timestamps();

            $table->integer('quantity')->default(0);

            $table->foreignId('component_item_id')
                ->constrained()
                ->references('id')
                ->onDelete('cascade')
                ->on('component_items');

            $table->foreignId('order_id')
                ->constrained()
                ->references('id')
                ->onDelete('cascade')
                ->on('orders');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('component_item_orders');
    }
}
