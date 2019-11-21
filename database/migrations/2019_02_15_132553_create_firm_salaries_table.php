<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFirmSalariesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('firm_salaries', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('firm_id')->unsigned()->nullable();
            $table->string('pqe');
            $table->integer('min');
            $table->integer('max');
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
        Schema::dropIfExists('firm_salaries');
    }
}
