<?php

namespace Klaasie\Questionnaire\Controllers;

use BackendMenu;
use Backend\Classes\Controller;
use Lang;

/**
 * Class Questions
 *
 * @package Klaasie\Questionnaire\Controllers
 */
class Questions extends Controller
{
    /** {@inheritdoc} */
    public $implement = [
        'Backend.Behaviors.FormController',
        'Backend.Behaviors.ListController',
        'Backend.Behaviors.RelationController',
        'Klaasie.Questionnaire.Behaviors.ReorderController',
    ];

    /** {@inheritdoc} */
    public $formConfig = 'config_form.yaml';

    /** {@inheritdoc} */
    public $listConfig = 'config_list.yaml';

    /** {@inheritdoc} */
    public $relationConfig = 'config_relation.yaml';

    /** {@inheritdoc} */
    public $reorderConfig = 'config_reorder.yaml';

    /**
     * Questions constructor.
     */
    public function __construct()
    {
        parent::__construct();

        BackendMenu::setContext('Klaasie.Questionnaire', 'questionnaire', 'questions');
    }
}