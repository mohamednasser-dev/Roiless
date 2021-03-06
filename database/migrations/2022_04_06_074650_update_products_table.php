<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('products', function (Blueprint $table) {
            $table->bigInteger('section_id')->unsigned()->nullable()->after('name_en');
            $table->foreign('section_id')->references('id')->on('sections')->onDelete('restrict');
            $table->bigInteger('sub_section_id')->unsigned()->nullable()->after('name_en');
            $table->foreign('sub_section_id')->references('id')->on('sections')->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
