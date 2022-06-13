<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateJobRequestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('job_requests', function (Blueprint $table) {
            $table->id();

            $table->foreignId('student')
                ->constrained()
                ->references('id')
                ->on('users');
            $table->foreignId('supervisor')
                ->constrained()
                ->references('id')
                ->on('users');

            $table->text("student_notes")->nullable();
            $table->text("supervisor_notes")->nullable();
            $table->text("other_notes")->nullable();

            $table->foreignId('machine')
                ->constrained()
                ->references('id')
                ->on('machines');

            $table->foreignId('material')
                ->constrained()
                ->references('id')
                ->on('raw_materials');

            $table->enum("status", array_keys(\App\Models\JobRequests::job_status()));

            $table->string('file'); // zip file
            $table->string('thumb')->nullable(); // preview file

            $table->timestamp('requested_time')->nullable();
            $table->timestamp('approved_time')->nullable();
            $table->timestamp('scheduled_time')->nullable();
            $table->timestamp('started_time')->nullable();
            $table->timestamp('completed_time')->nullable();
            $table->timestamp('finished_time')->nullable();

            $table->float("material_usage")->nullable()->default(0);  // in unit defined in the material
            $table->integer('machine_time')->default(0);

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
        Schema::dropIfExists('job_requests');
    }
}
