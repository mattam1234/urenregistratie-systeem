<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateJobsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('jobs', function (Blueprint $table) {
            $table->bigIncrements('taakId');
            $table->integer('werknemerNummer')->nullable();
            $table->integer('teamId')->nullable();
            $table->string('taakNaam');
            $table->dateTime('gestarteTijd')->nullable();
            $table->time('benodigdeTijd');
            $table->dateTime('bestedeTijd')->nullable();
            $table->dateTime('eindTijd')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('jobs');
    }
}
