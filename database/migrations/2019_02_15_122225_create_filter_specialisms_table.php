<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFilterSpecialismsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('filter_specialisms', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title');
            $table->integer('area_id')->unsigned()->nullable();
            $table->timestamps();
        });

        Schema::table('filter_specialisms', function($table){
            $table->foreign('area_id')->references('id')
                ->on('filter_practice_areas')->onDelete('cascade');
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::disableForeignKeyConstraints();
        Schema::dropIfExists('filter_specialisms');
    }
}
