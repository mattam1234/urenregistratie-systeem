<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCurrentJobsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('current_jobs', function (Blueprint $table) {
            $table->bigIncrements('taakId');
            $table->integer('werknemerNummer')->nullable();
            $table->integer('teamId')->nullable();
            $table->dateTime('gestarteTijd');
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
        Schema::dropIfExists('current_jobs');
    }
}
