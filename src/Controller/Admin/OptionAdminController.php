<?php

namespace App\Controller\Admin;
use App\Model\Table\UserTable;

/**
 * Class DashboardController
 * @property UserTable User
 */

class OptionAdminController extends AdminController
{
    public function index()
    {
        $this->loadModel('User');
        $totalUser = $this->User->countAll();

        $this->set('totalUser', $totalUser);
    }
}