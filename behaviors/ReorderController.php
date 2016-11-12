<?php

namespace Klaasie\Questionnaire\Behaviors;

use Backend\Behaviors\ReorderController as ReorderControllerBase;
use Illuminate\Database\Eloquent\Collection;
use Input;
use Klaasie\Questionnaire\Models\Answer;
use Klaasie\Questionnaire\Models\Question;
use Lang;
use Backend;
use ApplicationException;

/**
 * Class ReorderController
 *
 * @package Klaasie\Questionnaire\Behaviors
 */
class ReorderController extends ReorderControllerBase
{
    //
    // Controller actions
    //

    /**
     * Prepares common form data
     */
    protected function prepareVars()
    {
        parent::prepareVars();

        // Requiring nested functionality
        $this->vars['reorderShowTree'] = true;
        $this->vars['reorderSortMode'] = 'nested';
    }

    //
    // AJAX
    //

    /**
     * Offer answer selection form
     *
     * @return string
     */
    public function onLoadAnswers()
    {
        $targetAnswers = Answer::where('question_id', Input::get('targetNode'))
            ->get();

        return $this->makePartial('answers_popup', [
            'sourceQuestionId' => Input::get('sourceNode'),
            'answers' => $targetAnswers
        ]);
    }

    /**
     * Nest question
     */
    public function onNestQuestion()
    {
        /** @type Answer $answer */
        $answer = Answer::find(Input::get('answer_id'));

        /** @type Question $question */
        $question = Question::find(Input::get('follow_up_question_id'));

        if (!$answer) {
            // @todo throw error
        }

        $answer->setFollowUpQuestion($question);
        $answer->save();

        // @todo if a question is already here, set different sort_order
        // @todo Support multiple follow up questions

        $question->setSortOrder(1);
        $question->save();
    }

    /**
     * Set sortorder
     */
    public function onReorder()
    {
        $model = $this->validateModel();

        $action = Input::get('position');

        if (!$ids = post('sort_ids')) {
            return;
        }

        if (!$orders = post('sort_orders')) {
            return;
        }

        $model->setSortableOrder($ids, $orders);

        Answer::whereIn('follow_up_question', $ids)->update(['follow_up_question' => null]);

//        /*
//         * Nested set
//         */
//        elseif ($this->sortMode == 'nested') {
//            $sourceNode = $model->find(post('sourceNode'));
//            $targetNode = post('targetNode') ? $model->find(post('targetNode')) : null;
//
//            if ($sourceNode == $targetNode) return;
//
//            switch (post('position')) {
//                case 'before':
//                    $sourceNode->moveBefore($targetNode);
//                    break;
//
//                case 'after':
//                    $sourceNode->moveAfter($targetNode);
//                    break;
//
//                case 'child':
//                    $sourceNode->makeChildOf($targetNode);
//                    break;
//
//                default:
//                    $sourceNode->makeRoot();
//                    break;
//            }
//        }
    }

    /**
     * Returns all the records from the supplied model.
     * @return Collection
     */
    protected function getRecords()
    {
        $records = null;
        $model = $this->controller->reorderGetModel();
        $query = $model->newQuery();

        $this->controller->reorderExtendQuery($query);

        // @todo Retrieve question ids by category. Assuming 1 now
        $questionIds = Answer::whereNotNull('follow_up_question')
            ->whereHas('followUpQuestion', function ($query) {
                $query->where('category_id', 1); // Change id here
            })->lists('follow_up_question');

        $query->whereNotIn('id', $questionIds);

        $records = $query->get();

        return $records;
    }
}
