<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBankFundsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bank_funds', function (Blueprint $table) {
            $table->id();
            $table->integer('bank_id')->unsigned();
            $table->foreign('bank_id')->references('id')->on('banks')->onDelete('cascade');
            $table->integer('user_fund_id')->unsigned();
            $table->foreign('user_fund_id')->references('id')->on('funds')->onDelete('cascade');
            $table->integer('employer_id')->unsigned();
            $table->foreign('employer_id')->references('id')->on('admins')->onDelete('cascade');
            $table->enum('bank_status',['accept','reject','pending']);
            $table->string('reason_refuse')->nullable();
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
        Schema::dropIfExists('bank_funds');
    }
}
