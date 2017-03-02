<?php

namespace App\Controller\Admin;

use App\Model\Table\UserTable;
use Cake\Event\Event;

/**
 * Class DashboardController
 * @property UserTable User
 */

class DashboardController extends AdminController
{
    public function beforeFilter(Event $event)
    {
        parent::beforeFilter($event);
        $this->set('menu', 'dashboard');
    }

    public function index()
    {
        $this->loadModel('User');
        $totalUser = $this->User->countAll();

        $this->set('totalUser', $totalUser);
    }
}