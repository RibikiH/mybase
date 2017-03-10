<?php

namespace App\Controller;

use App\Controller\AppController;
use Cake\Event\Event;
use Cake\I18n\I18n;

class PublicController extends AppController
{
    public function beforeFilter(Event $event)
    {
        $session = $this->request->session();
        if ($session->check('LANGUAGE')) {
            $language = $session->read('LANGUAGE');
            I18n::locale($language);
        } else {
            I18n::locale('vi_VI');
            $language = 'vi_VI';
        }

        $this->set('language', $language);
        $this->viewBuilder()->layout('public');
    }
}