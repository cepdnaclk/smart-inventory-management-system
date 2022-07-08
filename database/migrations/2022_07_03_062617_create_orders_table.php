<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->date("ordered_date");
            $table->date("picked_date")->nullable();
            $table->date("due_date_to_return")->nullable();
            $table->date("returned_date")->nullable();
            $table->integer("otp")->nullable();
            $table->enum('status', ['WAITING_LECTURER_APPROVAL','WAITING_H_O_D_APPROVAL','APPROVED', 'READY','PICKED','SUBMITTED','FINISHED'])->default('WAITING_LECTURER_APPROVAL');
            $table->timestamps();

            $table->foreignId('user_id')
                ->constrained()
                ->references('id')
                ->onDelete('cascade')
                ->on('users');

            $table->foreignId('locker_id')
                ->nullable()    //order without locker id are avilable
                ->constrained()
                ->references('id')
                ->onDelete('cascade')
                ->on('lockers');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('orders');
    }
}
