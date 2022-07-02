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
            $table->boolean('is_approved_by_lecturer')->nullable();
            $table->boolean('is_approved_by_TO')->nullable();

            $table->foreignId('order_id')
            ->constrained()
            ->references('id')
            ->onDelete('cascade')
            ->on('orders')->unique();
     

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

           //HOD for later part



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
