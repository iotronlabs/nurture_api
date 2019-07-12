<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableCoursesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('table_courses', function (Blueprint $table) {
            $table->bigIncrements('course_id')->length(10)->unique();
            $table->string('t_ref_id')->length(10)->nullable();
            $table->string('course_name')->length(100)->unique();
            $table->string('course_duration')->length(100);
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
        Schema::dropIfExists('table_courses');
    }
}
