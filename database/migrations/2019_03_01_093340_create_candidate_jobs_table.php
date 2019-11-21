<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCandidateJobsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('candidate_jobs', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('candidate_id')->unsigned();
            $table->string('previous_firm');
            $table->string('previous_date');
            $table->timestamps();
        });

        Schema::table('candidate_jobs', function($table){
            $table->foreign('candidate_id')->references('id')
                ->on('candidates')->onDelete('cascade');
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
        Schema::dropIfExists('candidate_jobs');
    }
}
