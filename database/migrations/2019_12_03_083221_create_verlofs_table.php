<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVerlofsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('verlofs', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->timestamps();
            $table->integer('werknemerNummer')->unsigned();
            $table->string('reden');
            $table->string('goedkeuring')->default('Nog niet gekeurd');
            $table->date('beginDatum');
            $table->date('eindDatum');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('verlofs');
    }
}
