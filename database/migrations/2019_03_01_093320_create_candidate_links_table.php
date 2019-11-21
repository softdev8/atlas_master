<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCandidateLinksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('candidate_links', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('candidate_id')->unsigned();
            $table->text('link');
            $table->timestamps();
        });

        Schema::table('candidate_links', function($table){
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
        Schema::dropIfExists('candidate_links');
    }
}
