<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserSubAdmins extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_sub_admins', function (Blueprint $table) {
            $table->engine = 'InnoDB';

            $table->bigIncrements('sub_admin_id')->length(10)->unique();
            $table->string('t_ref_id')->length(10)->nullable();
            $table->string('sub_admin_fname',100);
            $table->string('sub_admin_surname',100);
            $table->string('sub_admin_email',100)->unique();
            $table->string('password');
            $table->unsignedBiginteger('sub_admin_contact')->length(10);
            $table->date('sub_admin_dob');
            $table->char('sub_admin_gender',1);

            $table->string('sub_admin_address')->length(200);
            $table->string('sub_admin_address_pin')->length(6);
            $table->string('sub_admin_address_city')->length(100);
            $table->string('sub_admin_address_state')->length(20);

            // $table->string('sub_admin_sub')->length(100);
            $table->string('sub_admin_centre')->length(100);

            $table->string('sub_admin_profile_picture')->nullable();

            $table->unsignedTinyinteger('status')->length(3)->default('111');
            $table->integer('authentication')->default('4')->length(1);
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
        Schema::dropIfExists('user_sub_admins');
    }
}
