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
        Schema::table('business_process_classification', function (Blueprint $table) {
            $table->timestamp('date_start')->nullable();
            $table->timestamp('date_finish')->nullable();
            $table->double('time_rate')->default(0);
            $table->double('quality_rate')->default(0);
            $table->boolean('done')->default(false);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('business_process_classification', function (Blueprint $table) {
            $table->dropColumn('date_start');
            $table->dropColumn('date_finish');
            $table->dropColumn('time_rate');
            $table->dropColumn('quality_rate');
            $table->dropColumn('done');
        });
    }
};