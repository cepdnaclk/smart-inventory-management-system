<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrderApprovalsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('order_approvals', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->boolean('is_approved_by_lecturer')->default(false);
            $table->boolean('is_approved_by_TO')->default(false);

            $table->foreignId('order_id')
            ->constrained()
            ->references('id')
            ->onDelete('cascade')
            ->on('orders');
     

            $table->foreignId('lecturer_id')
            ->constrained()
            ->references('id')
            ->onDelete('cascade')
            ->on('users');

            $table->foreignId('technical_officer_id')
            ->constrained()
            ->references('id')
            ->onDelete('cascade')
            ->on('users');

           



        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('order_approvals');
    }
}
