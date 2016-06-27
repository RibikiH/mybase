<?php

namespace App\Controller\Admin;

use App\Controller\AppController;
use Cake\Core\Configure;
use Cake\Event\Event;
use Cake\I18n\I18n;

class AdminController extends AppController
{
    public function initialize()
    {
        parent::initialize();

        $this->loadComponent('Auth', [
            'loginAction' => [
                'controller' => 'User',
                'action' => 'login',
                'plugin' => 'User'
            ],
            'authError' => __('WRONG_USERNAME_OR_PASSWORD'),
            'storage' => 'Session',
            'loginRedirect' => [
                'controller' => 'User',
                'action' => 'index'
            ],
            'logoutRedirect' => [
                'controller' => 'User',
                'action' => 'login'
            ]
        ]);
        $this->viewBuilder()->layout('admin');
    }

    public function beforeFilter(Event $event)
    {
        I18n::locale('vi_VI');
    }
}