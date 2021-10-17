<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmployerCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('employer_categories', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('emp_id')->unsigned();
            $table->integer('cat_id')->unsigned();
            $table->timestamps();
            $table->foreign('emp_id')->references('id')->on('admins')->onDelete('cascade');
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
        Schema::dropIfExists('employer_categories');
    }
}
