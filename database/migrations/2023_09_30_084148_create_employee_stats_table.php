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
        Schema::create('employee_stats', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id')->nullable();
            $table->integer('ranking')->nullable();
            $table->integer('role')->nullable();
            $table->integer('experience')->nullable();
            $table->integer('salary')->nullable();
            $table->integer('year')->nullable();


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
        Schema::dropIfExists('employee_stats');
    }
};
