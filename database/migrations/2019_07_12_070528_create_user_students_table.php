<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserStudentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_students', function (Blueprint $table) {
            $table->engine = 'InnoDB';

            $table->bigIncrements('s_id')->length(10)->unique();
            $table->string('t_ref_id')->length(10)->nullable();
            $table->string('s_fname',100);
            $table->string('s_surname',100);
            $table->string('s_email',100)->unique();
            $table->string('password');
            $table->unsignedBiginteger('s_contact')->length(10);
            $table->date('s_dob');
            $table->char('s_gender',1);

            $table->string('s_address')->length(200);
            $table->string('s_address_pin')->length(6);
            $table->string('s_address_city')->length(100);
            $table->string('s_address_state')->length(20);

            $table->string('guardian_fname')->length(100);
            $table->string('guardian_surname')->length(100);
            $table->string('guardian_email')->lenght(30)->nullable();
            $table->string('guardian_contact')->length(10);
            $table->string('guardian_address')->length(100);
            $table->string('guardian_city')->length(100);
            $table->integer('guardian_pin')->length(6);
            $table->string('guardian_state')->length(50);

            $table->string('s_centre')->length(100);
            $table->string('s_course')->length(100);
            $table->string('s_clas')->length(100)->nullable();

            $table->string('fee_structure')->length(50);
            $table->string('scholarship')->length(50);
            $table->string('fee_period')->length(50);

            $table->string('s_profile_picture')->nullable();

            $table->unsignedTinyinteger('status')->length(3)->default('111');
            $table->integer('s_authentication')->default('1')->length(1);
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
        Schema::dropIfExists('user_students');
    }
}
