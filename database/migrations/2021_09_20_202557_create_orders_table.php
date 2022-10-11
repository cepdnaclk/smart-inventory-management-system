<?php

use App\Models\Order;
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
            $table->enum('status', Order::STATUS)->default('PENDING');
            $table->timestamps();

            $table->foreignId('user_id')
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
        Schema::dropIfExists('orders');
    }
}
