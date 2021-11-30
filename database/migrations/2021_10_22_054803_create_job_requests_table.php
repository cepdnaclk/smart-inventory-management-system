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

            $table->foreignId('raw_materials')
                ->constrained()
                ->references('id')
                ->on('machines');

            $table->enum("status",
                ['PENDING', 'WAITING_SUPERVISOR_APPROVAL', 'WAITING_TO_APPROVAL', 'ON_REVISION',
                    'PENDING_FABRICATION', 'COMPLETED']);

            $table->string('file')->nullable(); // zip file

            $table->timestamp('requested_time');
            $table->timestamp('approved_time');
            $table->timestamp('scheduled_time');
            $table->timestamp('started_time');
            $table->timestamp('completed_time');
            $table->timestamp('finished_time');

            $table->float("material_usage")->nullable();  // in unit defined in the material
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
