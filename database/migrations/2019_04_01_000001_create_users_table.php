<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('SIN')->unsigned()->unique();

            $table->string('fName');
            $table->string('lName');
            $table->string('address');
            $table->string('DOB');
            $table->double('salary');

            $table->string('email')->unique();
            $table->string('password');
            $table->boolean('isManager');
            $table->integer('deptID')->nullable();
            $table->foreign('deptID')->references('id')->on('departments');

            $table->integer('deptStartDate')->nullable();
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}
