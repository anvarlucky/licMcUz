<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBridgeTypesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bridge_types', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('bridge_id');
            $table->foreign('bridge_id')->on('bridges')->references('id');
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
        Schema::dropIfExists('bridge_types');
    }
}
