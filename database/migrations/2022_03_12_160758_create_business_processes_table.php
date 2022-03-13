<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('business_processes', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('payment_detail');
            $table->bigInteger('payment_amount')->unsigned();
            $table->unsignedBigInteger('classification_group_id');
            $table->timestamps();
        });
        Schema::create('business_process_classification', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('business_process_id');
            $table->unsignedBigInteger('classification_id');
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
        Schema::dropIfExists('business_processes');
        Schema::dropIfExists('business_process_classification');
    }
};