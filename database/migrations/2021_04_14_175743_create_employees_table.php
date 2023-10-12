<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmployeesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('employees', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('fname')->nullable();
            $table->string('lname')->nullable();
            $table->string('son_of')->nullable();
            $table->string('persnol_email')->nullable();
            $table->integer('age')->nullable();
            $table->string('dob')->nullable();
            $table->string('gender')->nullable();
            $table->string('city')->nullable();
            $table->string('address')->nullable();
            $table->integer('persnol_number')->nullable();
            $table->string('marital_status')->nullable();
            $table->string('image')->nullable();
            $table->integer('status')->default(0);
            $table->unsignedBigInteger('etype_id')->nullable();
            $table->unsignedBigInteger('desg_id')->nullable();
            $table->unsignedBigInteger('dep_id')->nullable();
            $table->text('user_id')->nullable();
            $table->text('salary')->nullable();


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
        Schema::dropIfExists('employees');
    }
}
