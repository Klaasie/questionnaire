<?php

namespace Klaasie\Questionnaire\Updates;

use Schema;
use October\Rain\Database\Schema\Blueprint;
use October\Rain\Database\Updates\Migration;

/**
 * Class CreateInputsTable
 *
 * @package Klaasie\Questionnaire\Updates
 */
class CreateInputsTable extends Migration
{
    /**
     * Create Inputs table
     */
    public function up()
    {
        Schema::create('klaasie_questionnaire_inputs', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->unsignedInteger('question_id');
            $table->unsignedInteger('answer_id');
            $table->timestamps();

            $table->foreign('question_id')
                ->references('id')
                ->on('klaasie_questionnaire_questions');

            $table->foreign('answer_id')
                ->references('id')
                ->on('klaasie_questionnaire_answers');
        });
    }

    /**
     * Destory Inputs table
     */
    public function down()
    {
        Schema::table('klaasie_questionnaire_inputs', function (Blueprint $table) {
            $table->dropForeign('klaasie_questionnaire_inputs_question_id_foreign');
            $table->dropForeign('klaasie_questionnaire_inputs_answer_id_foreign');
        });

        Schema::dropIfExists('klaasie_questionnaire_inputs');
    }
}
