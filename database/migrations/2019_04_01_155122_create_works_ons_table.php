<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateWorksOnsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('works_ons', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('projectID');
            $table->foreign('projectID')->references('id')->on('projects');
            $table->integer('SIN');
            $table->foreign('SIN')->references('id')->on('users')->onDelete('cascade');
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
        Schema::dropIfExists('works_ons');
    }
}
