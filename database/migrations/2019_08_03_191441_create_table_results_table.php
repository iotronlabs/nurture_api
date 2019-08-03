<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableResultsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('table_results', function (Blueprint $table) {
            $table->Increments('id');
            $table->integer('s_id');
            $table->integer('exam_id');
            $table->string('exam_name');
            $table->string('sub_name');
            $table->integer('total_question')->default(0);
            $table->integer('correct_answer')->default(0);
            $table->string('result')->nullable();
            $table->string('status')->nullable();
            $table->timestamps();
            $table->integer('t_ref_id')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('table_results');
    }
}
