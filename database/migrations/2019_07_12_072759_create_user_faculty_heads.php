<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserFacultyHeads extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_faculty_heads', function (Blueprint $table) {
            $table->engine = 'InnoDB';

            $table->bigIncrements('faculty_head_id')->length(10)->unique();
            $table->string('t_ref_id')->length(10)->nullable();
            $table->string('faculty_head_fname',100);
            $table->string('faculty_surname',100)->nullable();
            $table->string('faculty_head_email',100)->unique();
            $table->string('password');
            $table->unsignedBiginteger('faculty_head_contact')->length(10);
            $table->date('faculty_head_dob');
            $table->char('faculty_head_gender',1);

            $table->string('faculty_head_address')->length(200);
            $table->string('faculty_head_address_pin')->length(6);
            $table->string('faculty_head_address_city')->length(100);
            $table->string('faculty_head_address_state')->length(20);

            $table->string('faculty_head_profile_picture')->nullable();

            $table->unsignedTinyinteger('status')->length(3)->default('111');
            $table->integer('faculty_head_authentication')->default('1')->length(1);
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
        Schema::dropIfExists('user_faculty_heads');
    }
}
