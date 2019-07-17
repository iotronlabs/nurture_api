<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSubjectsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('subjects', function (Blueprint $table) {
            $table->increments('id');
            $table->string('sub_code')->unique();
            $table->string('sub_name')->unique();
            // $table->string('sub_stream')->nullable();
            // $table->string('sub_department')->nullable();
            // $table->string('status')->default('Active');
            $table->string('t_ref_id')->nullable();



            $table->timestamps();
        });



        DB::statement("ALTER TABLE subjects AUTO_INCREMENT = 15001;");

        //  Schema::table('subjects', function(Blueprint $table){

        //     $table->foreign('dept_name')
        //           ->references('dept_id')->on('departments')
        //           ->onDelete('cascade');
            
        // });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('subjects');
    }
}
