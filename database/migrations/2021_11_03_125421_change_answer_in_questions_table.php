<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ChangeAnswerInQuestionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('common_questions', function (Blueprint $table) {
            //
            $table->longtext('answer_en')->change();
            $table->longtext('answer_ar')->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('common_questions', function (Blueprint $table) {
            //
            $table->text('answer_en')->change();
            $table->text('answer_ar')->change();
        });
    }
}
