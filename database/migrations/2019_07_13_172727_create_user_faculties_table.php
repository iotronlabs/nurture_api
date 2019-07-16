<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserFacultiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
       Schema::create('user_faculties', function (Blueprint $table) {
            $table->engine = 'InnoDB';

            $table->bigIncrements('faculty_id')->length(10)->unique();
            $table->string('t_ref_id')->length(10)->nullable();
            $table->string('faculty_fname',100);
            $table->string('faculty_surname',100);
            $table->string('faculty_email',100)->unique();
            $table->string('password');
            $table->unsignedBiginteger('faculty_contact')->length(10);
            $table->date('faculty_dob');
            $table->char('faculty_gender',1);

            $table->string('faculty_address')->length(200);
            $table->string('faculty_address_pin')->length(6);
            $table->string('faculty_address_city')->length(100);
            $table->string('faculty_address_state')->length(20);

            $table->string('faculty_sub')->length(100);
            $table->string('faculty_centre')->length(100);

            $table->string('faculty_profile_picture')->nullable();

            $table->unsignedTinyinteger('status')->length(3)->default('111');
            $table->integer('authentication')->default('2')->length(1);
            $table->rememberToken();
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
        Schema::dropIfExists('user_faculties');
    }
}
