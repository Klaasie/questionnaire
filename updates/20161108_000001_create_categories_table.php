<?php

namespace Klaasie\Questionnaire\Updates;

use Schema;
use October\Rain\Database\Schema\Blueprint;
use October\Rain\Database\Updates\Migration;

/**
 * Class CreateCategoryTable
 *
 * @package Klaasie\Questionnaire\Updates
 */
class CreateCategoriesTable extends Migration
{
    /**
     * Create Category table
     */
    public function up()
    {
        Schema::create('klaasie_questionnaire_categories', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->string('name', 40);
            $table->timestamps();
        });
    }

    /**
     * Destory Category table
     */
    public function down()
    {
        Schema::dropIfExists('klaasie_questionnaire_categories');
    }
}
