<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLockersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lockers', function (Blueprint $table) {
            $table->id();
            $table->boolean('is_available')->default(0);
            $table->text('notes')->nullable();
            $table->timestamps();

            $table->foreignId('order_id')
                ->nullable()    //locker without order are avilable
                ->unique()      //one order must be placed in one location
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
        Schema::dropIfExists('lockers');
    }
}
