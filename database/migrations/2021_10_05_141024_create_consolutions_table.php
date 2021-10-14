<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateConsolutionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('consolutions', function (Blueprint $table) {
            $table->Increments('id');
            $table->string('full_name');
            $table->string('email');
            $table->string('phone');
            $table->string('country');
            $table->integer('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->integer('admin_id')->nullable()->unsigned();
            $table->foreign('admin_id')->references('id')->on('admins')->onDelete('set null');
            $table->integer('consolution_kind_id')->unsigned()->nullable();
            $table->foreign('consolution_kind_id')->references('id')->on('consolution_kinds')->onDelete('cascade');
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
        Schema::dropIfExists('consolutions');
    }
}
