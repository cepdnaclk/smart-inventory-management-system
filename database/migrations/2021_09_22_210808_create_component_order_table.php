<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateComponentOrderTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('component_order', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            

            $table->foreignId('order_id')
                ->constrained()
                ->references('id')
                ->onDelete('cascade')
                ->on('orders');

            $table->foreignId('component_id')
                ->constrained()
                ->references('id')
                ->onDelete('cascade')
                ->on('component_items');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('component_order');
    }
}
