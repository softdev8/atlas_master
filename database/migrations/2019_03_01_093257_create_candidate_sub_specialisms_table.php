<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCandidateSubSpecialismsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('candidate_sub_specialisms', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('candidate_id')->unsigned();
            $table->integer('area_id')->unsigned()->nullable();
            $table->integer('specialism_id')->unsigned()->nullable();
            $table->integer('subspecialism_id')->unsigned()->nullable();
            $table->timestamps();
        });

        Schema::table('candidate_sub_specialisms', function($table){
            $table->foreign('candidate_id')->references('id')
                ->on('candidates')->onDelete('cascade');
        });

        Schema::table('candidate_sub_specialisms', function($table){
            $table->foreign('area_id')->references('id')
                ->on('filter_practice_areas')->onDelete('restrict');
        });

        Schema::table('candidate_sub_specialisms', function($table){
            $table->foreign('specialism_id')->references('id')
                ->on('filter_specialisms')->onDelete('restrict');
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
        Schema::dropIfExists('candidate_sub_specialisms');
    }
}
