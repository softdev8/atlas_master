<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateActivityLogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('activity_logs', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('user_id');
            $table->unsignedInteger('company_id');
            $table->unsignedInteger('role_id');
            $table->dateTime('first_login');
            $table->dateTime('last_login');
            $table->dateTime('last_logout')->nullable();
            $table->unsignedInteger('count_logins')->default(0);
            $table->unsignedInteger('count_searches')->default(0);
            $table->unsignedInteger('count_projects_created')->default(0);
            $table->unsignedInteger('count_projects_exported')->default(0);
            $table->unsignedInteger('count_saved_searches')->default(0);
            $table->unsignedInteger('count_firm_link_clicks')->default(0);
            $table->unsignedInteger('count_linkedin_link_clicks')->default(0);
            $table->timestamps();
        });

        Schema::create('activity_logs', function (Blueprint $table) {
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
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
        Schema::dropIfExists('activity_logs');
    }
}
