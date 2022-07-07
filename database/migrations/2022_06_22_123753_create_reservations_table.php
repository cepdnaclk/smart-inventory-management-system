<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReservationsTable extends Migration
{
    /**
     * Run the migrations. 
     *
     * @return void
     */
    public function up()
    {
        // Schema::create('reservations', function (Blueprint $table) {
        //     $table->id();
        //     $table->timestamps();
        // });

        Schema::create('reservations', function (Blueprint $table) {
            $table->id();
            // $table->string('email');
            $table->foreignId('user_id')
                ->references('id')
                ->on('users');
            $table->dateTime('start_date');
            $table->dateTime('end_date');
            $table->foreignId('station_id')
                ->constrained()
                ->references('id')
                ->onDelete('cascade')
                ->on('stations');
            $table->string('E_numbers');
            $table->timestamps();
            
            
        });

        // Schema::table('reservations', function($table) {
        //     $table->foreign('email')->references('email')->on('users');
        // });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('reservations');
    }
}
