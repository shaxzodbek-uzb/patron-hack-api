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
        Schema::table('rules', function (Blueprint $table) {
            $table->unsignedBigInteger('classification_group_id')->nullable();
            $table->jsonb('classifications')->nullable();
            $table->string('result')->default('payment');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('rules', function (Blueprint $table) {
            $table->dropColumn('classification_group_id');
            $table->dropColumn('classifications');
            $table->dropColumn('result');
        });
    }
};