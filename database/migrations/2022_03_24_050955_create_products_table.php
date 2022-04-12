<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('name_ar');
            $table->string('name_en');
            $table->longText('body_ar')->nullable();
            $table->longText('body_en')->nullable();
            $table->bigInteger('seller_id')->unsigned();
            $table->foreign('seller_id')->references('id')->on('sellers')->onDelete('restrict');
            $table->integer('viewed_by')->unsigned()->nullable();
            $table->foreign('viewed_by')->references('id')->on('admins')->onDelete('restrict');
            $table->integer('cat_id')->unsigned()->nullable();
            $table->foreign('cat_id')->references('id')->on('categories')->onDelete('restrict');
            $table->double('price')->default(0);
            $table->string('image')->nullable();
            $table->integer('quantity')->default(1);
            $table->enum('status', ['pending','accepted','rejected'])->default('pending');
            $table->enum('type', ['direct_installment','not_direct_installment'])->default('direct_installment');
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
        Schema::dropIfExists('products');
    }
}
