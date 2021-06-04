<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->engine = 'InnoDB';

            $table->id();
            $table->string('name');
            $table->enum('honorific', ['Mr.', 'Miss.', 'Mrs.', 'Dr.', 'Prof.'])->nullable();
            $table->enum('status', ['active', 'pending', 'rejected', 'deactivated'])->default('pending');
            $table->string('google_id')->nullable();
            $table->string('avatar')->nullable();
            $table->string('email')->unique();
            $table->string('telephone')->nullable();
            $table->enum('type', ['student', 'lecturer', 'instructor', 'admin', 'moderator'])->default('student');
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password')->nullable();
            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
