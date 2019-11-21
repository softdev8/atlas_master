<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFilterSubSpecialismsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('filter_sub_specialisms', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title');
            $table->integer('specialism_id')->unsigned()->nullable();
            $table->timestamps();
        });
        Schema::table('filter_sub_specialisms', function($table){
            $table->foreign('specialism_id')->references('id')
                ->on('filter_specialisms')->onDelete('cascade');
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
        Schema::dropIfExists('filter_sub_specialisms');
    }
}
