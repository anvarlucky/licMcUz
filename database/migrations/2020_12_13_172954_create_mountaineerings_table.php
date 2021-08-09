<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMountaineeringsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mountaineerings', function (Blueprint $table) {
            $table->id();
            $table->string('licence_number');
            $table->string('licence_number_new')->nullable();
            $table->date('licence_given_date');
            $table->date('end_date')->nullable();
            $table->string('organization_inn');
            $table->string('organization_name');
            $table->string('organization_phone')->nullable();
            $table->string('organization_email')->nullable();
            $table->integer('region_id');
            /*            $table->foreign('region_id')->references('id')->on('regions');*/
            $table->integer('district_id');
            /*            $table->foreign('district_id')->references('id')->on('districts');*/
            $table->string('organization_address');
            $table->string('organization_director')->nullable();
            $table->string('organization_account_number');
            $table->string('difficulty_category');
            $table->text('license_direction');
            $table->integer('status')->default(1);
            $table->integer('status_gnk')->nullable();
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
        Schema::dropIfExists('mountaineerings');
    }
}
