<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateFundsTableCustom extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('funds', function (Blueprint $table) {
            $table->string('fund_amount_ar')->default('مبلغ التمويل');
            $table->string('fund_amount_en')->default('fund amount');
            $table->string('annual_income_ar')->default('الدخل السنوي');
            $table->string('annual_income_en')->default('annual income');
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
