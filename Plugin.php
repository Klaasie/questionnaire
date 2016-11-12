<?php namespace Klaasie\Questionnaire;

use Backend;
use System\Classes\PluginBase;

/**
 * Questionnaire Plugin Information File
 */
class Plugin extends PluginBase
{

    /**
     * Returns information about this plugin.
     *
     * @return array
     */
    public function pluginDetails()
    {
        return [
            'name'        => 'Questionnaire',
            'description' => 'Create questionnaires',
            'author'      => 'Klaasie',
            'icon'        => 'icon-question-circle-o'
        ];
    }

    /**
     * Register method, called when the plugin is first registered.
     *
     * @return void
     */
    public function register()
    {

    }

    /**
     * Boot method, called right before the request route.
     *
     * @return array
     */
    public function boot()
    {

    }

    /**
     * Registers any front-end components implemented in this plugin.
     *
     * @return array
     */
    public function registerComponents()
    {
        return []; // Remove this line to activate

        return [
            'Klaasie\Questionnaire\Components\MyComponent' => 'myComponent',
        ];
    }

    /**
     * Registers any back-end permissions used by this plugin.
     *
     * @return array
     */
    public function registerPermissions()
    {
        return []; // Remove this line to activate

        return [
            'klaasie.questionnaire.some_permission' => [
                'tab' => 'Questionnaire',
                'label' => 'Some permission'
            ],
        ];
    }

    /**
     * Registers back-end navigation items for this plugin.
     *
     * @return array
     */
    public function registerNavigation()
    {
        return [
            'questionnaire' => [
                'label'       => 'Questionnaire',
                'url'         => Backend::url('klaasie/questionnaire/index'),
                'icon'        => 'icon-question-circle',
                'permissions' => ['klaasie.questionnaire.*'],
                'order'       => 500,
                'sideMenu' => [
//                    'questionnaire' => [
//                        'label'       => 'Questionnaire',
//                        'icon'        => 'icon-object-group',
//                        'url'         => Backend::url('klaasie/questionnaire/index'),
//                        'permissions' => ['klaasie.questionnaire.index']
//                    ],
                    'category' => [
                        'label'       => 'Categories',
                        'icon'        => 'icon-object-group',
                        'url'         => Backend::url('klaasie/questionnaire/categories'),
                        'permissions' => ['klaasie.questionnaire.categories']
                    ],
                    'questions' => [
                        'label'       => 'Questions',
                        'icon'        => 'icon-question-circle',
                        'url'         => Backend::url('klaasie/questionnaire/questions'),
                        'permissions' => ['klaasie.questionnaire.questions']
                    ],
                    'answers' => [
                        'label'       => 'Answers',
                        'icon'        => 'icon-tasks',
                        'url'         => Backend::url('klaasie/questionnaire/answers'),
                        'permissions' => ['klaasie.questionnaire.answers']
                    ]
                ]
            ],
        ];
    }

}
