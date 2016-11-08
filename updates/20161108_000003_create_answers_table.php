<?php

namespace Klaasie\Questionnaire\Updates;

use Schema;
use October\Rain\Database\Schema\Blueprint;
use October\Rain\Database\Updates\Migration;

/**
 * Class CreateAnswersTable
 *
 * @package Klaasie\Questionnaire\Updates
 */
class CreateAnswersTable extends Migration
{
    /**
     * Create Answers table
     */
    public function up()
    {
        Schema::create('klaasie_questionnaire_answers', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->unsignedInteger('question_id');
            $table->string('text');
            $table->unsignedInteger('follow_up_question')->nullable();
            $table->timestamps();

            $table->foreign('question_id')
                ->references('id')
                ->on('klaasie_questionnaire_questions');

            $table->foreign('follow_up_question')
                ->references('id')
                ->on('klaasie_questionnaire_questions');
        });
    }

    /**
     * Destory Answers table
     */
    public function down()
    {
        Schema::table('klaasie_questionnaire_answers', function (Blueprint $table) {
            $table->dropForeign('klaasie_questionnaire_answers_question_id_foreign');
            $table->dropForeign('klaasie_questionnaire_answers_follow_up_question_foreign');
        });

        Schema::dropIfExists('klaasie_questionnaire_answers');
    }
}
