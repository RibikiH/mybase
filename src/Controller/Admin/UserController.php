<?php

namespace App\Controller\Admin;

use App\Model\Table\UserTable;
use Cake\Core\Configure;
use Cake\Event\Event;

/**
 * Class UserController
 * @property UserTable User
 */

class UserController extends AdminController
{
	public function beforeFilter(Event $event)
	{
		parent::beforeFilter($event);
		$this->Auth->allow(['logout', 'login', 'add', 'index']);
	}

    public function index()
    {

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
        if ($this->request->is('post'))
        {
            $data = $this->request->data;
            $this->loadModel('User');
            $user = $this->User->newEntity();

            $this->User->patchEntity($user, $data);

            if ($user = $this->User->save($user))
            {
                $this->Flash->success(__('Add user success'));
                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('Add user fail'));
        }

		$this->viewBuilder()->template('edit');
	}
}