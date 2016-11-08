<?php

namespace Klaasie\Questionnaire\Models;

use Model;

/**
 * Class Answer
 *
 * @package Klaasie\Questionnaire\Models
 */
class Answer extends Model
{

    /** {@inheritdoc} */
    public $table = 'klaasie_questionnaire_answers';

    /** {@inheritdoc} */
    protected $guarded = ['*'];

    /** {@inheritdoc} */
    protected $fillable = [];

    /** {@inheritdoc} */
    public $hasMany = [
        'inputs' => Input::class
    ];

    /** {@inheritdoc} */
    public $belongsTo = [
        'question' => Question::class,
        'followUpQuestion' => Question::class
    ];

    /**
     * @return Question
     */
    public function getQuestion()
    {
        return $this->getAttribute('question');
    }

    /**
     * @param Question $question
     * @return $this
     */
    public function setQuestion(Question $question)
    {
        $this->setAttribute('question', $question);
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
     * @param $text
     * @return $this
     */
    public function setText($text)
    {
        $this->setAttribute('text', $text);
        return $this;
    }

    /**
     * @return Question
     */
    public function getFollowUpQuestion()
    {
        return $this->getAttribute('followUpQuestion');
    }

    /**
     * @param Question $followUpQuestion
     * @return $this
     */
    public function setAttribute(Question $followUpQuestion)
    {
        $this->setAttribute('followUpQuestion', $followUpQuestion);
        return $this;
    }
}
