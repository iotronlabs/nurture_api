<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableCentresTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('table_centres', function (Blueprint $table) {
            $table->bigIncrements('centre_id')->length(10)->unique();
            $table->string('t_ref_id')->length(10)->nullable();
            $table->string('centre_name')->length(100)->unique();
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
        Schema::dropIfExists('table_centres');
    }
}
