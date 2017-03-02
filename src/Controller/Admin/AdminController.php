<?php

namespace App\Controller\Admin;

use App\Controller\AppController;
use Cake\Event\Event;
use Cake\I18n\I18n;

class AdminController extends AppController
{
    public function initialize()
    {
        parent::initialize();
        $this->loadComponent('Flash');
        $this->loadComponent('Auth', [
            'loginAction' => [
                'controller' => 'User',
                'action' => 'login'
            ],
            'authError' =>  __('WRONG_USERNAME_OR_PASSWORD'),
            'storage' => 'Session',
            'loginRedirect' => array(
                'controller' => 'Dashboard',
                'action' => 'index',
                'prefix' => 'admin'
            ),
            'authenticate' => array(
                'Form' => array(
                    'fields' => array('username' => 'email')
                )
            ),
            'logoutRedirect' => [
                'controller' => 'User',
                'action' => 'login',
                'prefix' => 'admin'
            ]
        ]);
        $this->viewBuilder()->layout('admin');
    }

    public function beforeFilter(Event $event)
    {
        I18n::locale('vi_VI');
        $this->set('authUser', $this->Auth->user());
        $this->viewBuilder()->layout('admin');
    }
}