<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCandidateLocationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('candidate_locations', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('candidate_id')->unsigned();
            $table->integer('location_id')->unsigned();
            $table->string('description')->nullable();
            $table->timestamps();
        });

        Schema::table('candidate_locations', function($table){
            $table->foreign('candidate_id')->references('id')
                ->on('candidates')->onDelete('cascade');
        });
        Schema::table('candidate_locations', function($table){
            $table->foreign('location_id')->references('id')
                ->on('firm_locations')->onDelete('restrict');
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
        Schema::dropIfExists('candidate_locations');
    }
}
