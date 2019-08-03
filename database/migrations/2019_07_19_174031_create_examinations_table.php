<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateExaminationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('examinations', function (Blueprint $table) {
           $table->Increments('id');


            $table->string('exam_name');
            $table->string('course_name');
            $table->string('subject_name');

            $table->date('start_date');
            $table->date('end_date');
            $table->integer('duration')->nullable();
            $table->integer('pass_mark')->nullable();

            $table->string('description');
            $table->integer('t_questions')->default(0);
            $table->string('status')->default('Active');


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
        Schema::dropIfExists('examinations');
    }
}
