<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCitiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cities', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title');
            $table->integer('country_id')->unsigned()->nullable();
            $table->integer('region_id')->unsigned()->nullable();
            $table->timestamps();
        });

        Schema::table('cities', function($table){
            $table->foreign('country_id')->references('id')
                ->on('countries')->onDelete('cascade');
        });

        Schema::table('cities', function($table){
            $table->foreign('region_id')->references('id')
                ->on('regions')->onDelete('cascade');
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
        Schema::dropIfExists('cities');
    }
}
