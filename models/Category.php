<?php

namespace Klaasie\Questionnaire\Models;

use Model;

/**
 * Class Category
 *
 * @package Klaasie\Questionnaire\Models
 */
class Category extends Model
{

    /** {@inheritdoc} */
    public $table = 'klaasie_questionnaire_categories';

    /** {@inheritdoc} */
    protected $guarded = ['*'];

    /** {@inheritdoc} */
    protected $fillable = [];

    /** {@inheritdoc} */
    public $hasMany = [
        'questions' => Question::class
    ];

    /**
     * @return string
     */
    public function getName()
    {
        return $this->getAttribute('name');
    }

    /**
     * @param $name
     * @return $this
     */
    public function setName($name)
    {
        $this->setAttribute('name', $name);
        return $this;
    }
}
