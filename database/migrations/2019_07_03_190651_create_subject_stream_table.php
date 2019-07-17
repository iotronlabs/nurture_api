<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSubjectStreamTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('subject_stream', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('sub_code');
            $table->string('sub_name');
            $table->string('stream_name')->nullable();
            $table->string('department_name')->nullable();
            $table->string('t_ref_id')->nullable();
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
        Schema::dropIfExists('subject_stream');
    }
}
