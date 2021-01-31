<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMountaineeringTypesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mountaineering_types', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('mountaineering_id');
            $table->foreign('mountaineering_id')->on('mountaineerings')->references('id');
            $table->unsignedBigInteger('type_id');
            $table->foreign('type_id')->on('types')->references('id');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('mountaineering_types');
    }
}
