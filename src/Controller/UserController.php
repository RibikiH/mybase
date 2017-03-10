<?php
namespace App\Controller;

use Cake\Core\Configure;
use Cake\Network\Exception\NotFoundException;
use Cake\View\Exception\MissingTemplateException;

class UserController extends PublicController
{
    public function loginFb()
    {
        $data = $this->request;
        print_r($data);die;
    }
}
