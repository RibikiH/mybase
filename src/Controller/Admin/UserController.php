<?php

namespace App\Controller\Admin;

use App\Controller\Admin\AdminController;
use Cake\Event\Event;
use Cake\Core\Configure;
use App\Controller\Common;

class UserController extends AdminController
{
    public function beforeFilter(Event $event)
    {
        parent::beforeFilter($event);
        $this->Auth->allow(['logout', 'login', 'add']);
    }

    public function login()
    {
        if ($this->request->is('post')) {
            $user = $this->Auth->identify();
            if ($user) {
                $this->Auth->setUser($user);
                return $this->redirect($this->Auth->redirectUrl());
            } else {
                $this->Flash->error(__('Username or password is incorrect'), [
                    'key' => 'auth'
                ]);
            }
        }

        $this->viewBuilder()->layout('login');
    }

    public function add()
    {
        
    }
}