<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFundHistoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('fund_histories', function (Blueprint $table) {
            $table->Increments('id');
            $table->integer('fund_id')->unsigned()->nullable();
            $table->integer('user_id')->unsigned()->nullable();
            $table->string('notes');
            $table->enum('status',['accept','reject','pending'])->nullable();
            $table->timestamps();
            $table->foreign('fund_id')->references('id')->on('funds')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('fund_histories');
    }
}
