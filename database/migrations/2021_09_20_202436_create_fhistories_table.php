<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFhistoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('fhistories', function (Blueprint $table) {
            $table->Increments('id');
            $table->string('note_ar');
            $table->string('note_en');
            $table->integer('emp_id')->unsigned()->nullable();
            $table->integer('user_id')->unsigned()->nullable();
            $table->integer('bank_id')->unsigned()->nullable();
            $table->integer('user_fund_id')->unsigned();
            $table->enum('type',['bank','user','emp'])->nullable();
            $table->enum('status',['accept','reject','pending'])->nullable();
            $table->timestamps();
            $table->foreign('emp_id')->references('id')->on('admins')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('bank_id')->references('id')->on('banks')->onDelete('cascade');
            $table->foreign('user_fund_id')->references('id')->on('user_funds')->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('fhistories');
    }
}
