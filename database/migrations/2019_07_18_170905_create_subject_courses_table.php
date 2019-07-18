<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSubjectCoursesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('subject_courses', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('course_name')->length(100);
            $table->string('sub_name')->length(100);
            $table->timestamps();

            $table->unique(['course_name','sub_name']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('subject_courses');
    }
}
