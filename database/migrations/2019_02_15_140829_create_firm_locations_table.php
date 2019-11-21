<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFirmLocationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('firm_locations', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('firm_id')->unsigned()->nullable();
            $table->integer('country_id')->unsigned()->nullable();
            $table->integer('region_id')->unsigned()->nullable();
            $table->integer('city_id')->unsigned()->nullable();
            $table->string('address')->nullable();
            $table->timestamps();
        });

        Schema::table('firm_locations', function($table){
            $table->foreign('firm_id')->references('id')
                ->on('firms')->onDelete('cascade');
        });

        Schema::table('firm_locations', function($table){
            $table->foreign('city_id')->references('id')
                ->on('cities')->onDelete('restrict');
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
        Schema::dropIfExists('firm_locations');
    }
}
