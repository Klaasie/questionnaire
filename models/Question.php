<?php

namespace Klaasie\Questionnaire\Models;

use Model;
use October\Rain\Database\Traits\Sortable;

/**
 * Class Question
 *
 * @package Klaasie\Questionnaire\Models
 */
class Question extends Model
{
    use Sortable;

    /** {@inheritdoc} */
    public $table = 'klaasie_questionnaire_questions';

    /** {@inheritdoc} */
    protected $guarded = ['*'];

    /** {@inheritdoc} */
    protected $fillable = [];

    /** {@inheritdoc} */
    public $hasMany = [
        'answers' => Answer::class,
        'inputs' => Input::class
    ];

    /** {@inheritdoc} */
    public $belongsTo = [
        'category' => Category::class
    ];

    /**
     * @return Category
     */
    public function getCategory()
    {
        return $this->getAttribute('category');
    }

    /**
     * @param Category $category
     * @return $this
     */
    public function setCategory(Category $category)
    {
        $this->setAttribute('category', $category);
        return $this;
    }

    /**
     * @return string
     */
    public function getText()
    {
        return $this->getAttribute('text');
    }

    /**
     * @param string $text
     * @return $this
     */
    public function setText($text)
    {
        $this->setAttribute('text', $text);
        return $this;
    }

    /**
     * @return int
     */
    public function getSortOrder()
    {
        return $this->getAttribute('sort_order');
    }

    /**
     * @param int $sortOrder
     * @return $this
     */
    public function setSortOrder($sortOrder)
    {
        $this->setAttribute('sort_order', $sortOrder);
        return $this;
    }
}
