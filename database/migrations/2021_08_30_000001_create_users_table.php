<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->Increments('id');
            $table->string('name');
            $table->string('mobile')->index()->unique();
            $table->string('image')->nullable();
            $table->string('email')->unique()->nullable();
            $table->enum('type', ['user', 'admin','employer,bank']);
            $table->string('role_id');
            $table->integer('cat_id')->unsigned()->nullable();
            $table->string('password');
            $table->rememberToken();
            $table->timestamps();
            $table->foreign('cat_id')->references('id')->on('categories')->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
