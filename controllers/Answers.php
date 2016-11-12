<?php namespace Klaasie\Questionnaire\Controllers;

use BackendMenu;
use Backend\Classes\Controller;

/**
 * Answers Back-end Controller
 */
class Answers extends Controller
{
    public $implement = [
        'Backend.Behaviors.FormController',
        'Backend.Behaviors.ListController'
    ];

    public $formConfig = 'config_form.yaml';
    public $listConfig = 'config_list.yaml';

    public function __construct()
    {
        parent::__construct();

        BackendMenu::setContext('Klaasie.Questionnaire', 'questionnaire', 'answers');
    }
}