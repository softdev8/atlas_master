<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCandidatesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('candidates', function (Blueprint $table) {
            $table->increments('id');
            $table->string('ref_num')->nullable()->unique();
            $table->string('forename');
            $table->string('surname');
            $table->string('email');
            $table->integer('firm_id')->unsigned()->nullable();
            $table->integer('pqe')->nullable();
            $table->string('job_title')->nullable();
            $table->boolean('status')->default(1);
            $table->date('admitted_date')->nullable();
            $table->string('workphone')->nullable();
            $table->string('mobile_phone')->nullable();
            $table->string('gender')->nullable();
            $table->text('website')->nullable();
            $table->text('linked_in')->nullable();
            $table->string('law_society')->nullable();
            $table->text('law_society_link')->nullable();
            $table->string('lang')->nullable();
            $table->date('changed_job_date')->nullable();
            $table->string('school')->nullable();
            $table->string('university')->nullable();
            $table->timestamps();
        });

        Schema::table('candidates', function($table){
            $table->foreign('firm_id')->references('id')
                ->on('firms')->onDelete('restrict');
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
        Schema::dropIfExists('candidates');
    }
}
