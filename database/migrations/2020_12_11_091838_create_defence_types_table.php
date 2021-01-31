<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDefenceTypesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('defence_types', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('defence_id');
            $table->foreign('defence_id')->on('defences')->references('id');
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
        Schema::dropIfExists('defence_types');
    }
}
