<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEquipmentTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('equipment', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->double('cost');
            $table->string('maintenanceFreq');
            $table->string('lastMaintenance');

            $table->integer('userSIN')->nullable();
            $table->foreign('userSIN')->references('SIN')->on('users');

            $table->integer('supplierID');
            $table->foreign('supplierID')->references('id')->on('suppliers');

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
        Schema::dropIfExists('equipment');
    }
}
