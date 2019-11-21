<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateReportsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reports', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->unsigned();
            $table->integer('candidate_id')->unsigned();
            $table->text('description')->nullable();
            $table->boolean('status')->default(0);
            $table->timestamps();
        });


        Schema::table('reports', function($table){
            $table->foreign('candidate_id')->references('id')
                ->on('candidates')->onDelete('cascade');
        });

        Schema::table('reports', function($table){
            $table->foreign('user_id')->references('id')
                ->on('users')->onDelete('cascade');
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
        Schema::dropIfExists('reports');
    }
}
