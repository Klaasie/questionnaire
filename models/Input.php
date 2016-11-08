<?php

namespace Klaasie\Questionnaire\Models;

use Model;

/**
 * Class Input
 *
 * @package Klaasie\Questionnaire\Models
 */
class Input extends Model
{

    /** {@inheritdoc} */
    public $table = 'klaasie_questionnaire_inputs';

    /** {@inheritdoc} */
    protected $guarded = ['*'];

    /** {@inheritdoc} */
    protected $fillable = [];

    /** {@inheritdoc} */
    public $belongsTo = [
        'question' => Question::class,
        'answer' => Answer::class
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
     * @return Answer
     */
    public function getAnswer()
    {
        return $this->getAttribute('answer');
    }

    /**
     * @param Answer $answer
     * @return $this
     */
    public function setAnswer(Answer $answer)
    {
        $this->setAttribute('answer', $answer);
        return $this;
    }
}