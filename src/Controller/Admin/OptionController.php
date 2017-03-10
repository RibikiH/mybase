<?php

namespace App\Controller\Admin;

use Cake\Event\Event;
/**
 * Class OptionAdminController
 */

class OptionAdminController extends AdminController
{
    public function beforeFilter(Event $event)
    {
        parent::beforeFilter($event);
        $this->set('menu', 'options_admin');
    }

    public function index()
    {
        if ($this->request->is('post')) {
            $data = $this->request->data;


        }
    }
}