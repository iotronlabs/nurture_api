<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateQuestionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
       Schema::create('questions', function (Blueprint $table) {

           //$table->increments('q_id');
           $table->Increments('question_id');
           $table->integer('exam_id');
           $table->string('type');
           $table->string('question')->nullable();
           $table->string('option_1')->nullable();
           $table->string('option_2')->nullable();
           $table->string('option_3')->nullable();
           $table->string('option_4')->nullable();
           $table->string('option_5')->nullable();
           $table->string('option_6')->nullable();
           $table->string('option_7')->nullable();
           $table->string('option_8')->nullable();
           $table->string('answer');
           $table->string('topics');
           $table->string('question_image')->nullable();
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
        Schema::dropIfExists('questions');
    }
}
