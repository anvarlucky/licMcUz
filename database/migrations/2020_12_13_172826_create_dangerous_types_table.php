<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDangerousTypesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dangerous_types', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('dangerous_id');
            $table->foreign('dangerous_id')->on('dangerouses')->references('id');
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
        Schema::dropIfExists('dangerous_types');
    }
}
