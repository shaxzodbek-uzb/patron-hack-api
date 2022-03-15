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
        Schema::table('classifications', function (Blueprint $table) {
            $table->double('min_rate')->default(0);
            $table->double('max_rate')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('classifications', function (Blueprint $table) {
            $table->dropColumn('min_rate');
            $table->dropColumn('max_rate');
        });
    }
};