<?php

namespace Klaasie\Questionnaire\Updates;

use Schema;
use October\Rain\Database\Schema\Blueprint;
use October\Rain\Database\Updates\Migration;

/**
 * Class CreateQuestionsTable
 *
 * @package Klaasie\Questionnaire\Updates
 */
class CreateQuestionsTable extends Migration
{
    /**
     * Create Questions table
     */
    public function up()
    {
        Schema::create('klaasie_questionnaire_questions', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->unsignedInteger('category_id');
            $table->text('text');
            $table->unsignedInteger('sort_order')->nullable();
            $table->timestamps();

            $table->foreign('category_id')
                ->references('id')
                ->on('klaasie_questionnaire_categories');
        });
    }

    /**
     * Destory Questions table
     */
    public function down()
    {
        Schema::table('klaasie_questionnaire_questions',function (Blueprint $table) {
            $table->dropForeign('klaasie_questionnaire_questions_category_id_foreign');
        });
        Schema::dropIfExists('klaasie_questionnaire_questions');
    }
}
