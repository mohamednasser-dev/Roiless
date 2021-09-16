<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserFundsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_funds', function (Blueprint $table) {

            $table->increments('id');
            $table->integer('user_id')->unsigned();
            $table->integer('fund_id')->unsigned();
            $table->integer('cat_id')->unsigned()->nullable();
            $table->json('dataform');
            $table->double('annual_sales_size')->nullable();
            $table->double('fund_amount');
            $table->enum('user_status', ['pending', 'payed_success', 'payed_rejected', 'under_revision', 'finail_accept', 'finail_rejected'])->default('pending');
            $table->integer('emp_id')->unsigned()->nullable();
            $table->timestamps();
            $table->foreign('emp_id')->references('id')->on('admins')->onDelete('cascade');
            $table->foreign('cat_id')->references('id')->on('categories')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('fund_id')->references('id')->on('funds')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('user_funds');
    }
}
