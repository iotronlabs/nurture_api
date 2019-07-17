<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableClassesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
         Schema::create('table_classes', function (Blueprint $table) {
            $table->bigIncrements('class_id')->length(10)->unique();
            $table->string('t_ref_id')->length(10)->nullable();
            $table->string('class_name')->length(100);
            $table->date('start_time');
            $table->date('end_time');
            $table->string('class_course')->length(100);
            $table->string('class_centre_name')->length(100);
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
        Schema::dropIfExists('table_classes');
    }
}
