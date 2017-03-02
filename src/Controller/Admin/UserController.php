<?php

namespace App\Controller\Admin;

use App\Model\Table\UserTable;
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
        $this->set('menu', 'user');
        $this->Auth->allow(['logout']);
    }

    public function index()
    {
        $users = $this->User->getList(['id', 'username', 'role']);
        $this->set('users', $users);
    }

    /**
     * @return \Cake\Network\Response|null
     */
    public function login()
    {
        if ($this->request->is('post')) {
            $user = $this->Auth->identify();
            if ($user) {
                $this->Auth->setUser($user);
                return $this->redirect($this->Auth->redirectUrl());
            } else {
                $this->Flash->error(__('Email or password is incorrect'));
            }
        }

        if (!empty($this->Auth->user())) {
            return $this->redirect($this->Auth->redirectUrl());
        }

        $this->viewBuilder()->layout('login');
    }

    public function add()
    {
        if ($this->request->is('post')) {
            $data = $this->request->data;

            if ($this->User->add($data)) {
                $this->Flash->success(__('Add user success'));
                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('Add user fail'));
        }

        $this->viewBuilder()->template('edit');
    }

    public function edit($id)
    {
        if ($this->request->is('get')) {
            $user = $this->User->getById($id, ['id', 'email', 'username', 'role']);

            $this->set('user', $user);
        }

        if ($this->request->is('post')) {
            $data = $this->request->data;

            if (empty($data['password'])) {
                unset($data['password']);
            }
            $data['id'] = $id;

            if ($this->User->update($data)) {
                $this->Flash->success(__('Edit user success'));
                return $this->redirect(['action' => 'index']);
            }
        }
    }

    public function delete($id)
    {
        if ($this->User->deleteById($id)) {
            $this->Flash->success(__('Delete user success'));
            return $this->redirect(['action' => 'index']);
        }
    }

    public function getData()
    {
        $data = $this->request->query;
        $result = $this->User->paging($data, ['username', 'email', 'role', 'created', 'id']);

        $this->set($result);
        $this->set('_serialize', ['draw', 'recordsTotal', 'recordsFiltered', 'data']);
    }

    public function logout()
    {
        return $this->redirect($this->Auth->logout());
    }
}