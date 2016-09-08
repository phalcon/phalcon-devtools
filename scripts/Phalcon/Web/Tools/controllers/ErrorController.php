<?php

use Phalcon\Mvc\View;
use Phalcon\Mvc\Controller;

class ErrorController extends Controller
{
    /**
     * Initialize controller
     */
    public function initialize()
    {
        $this->view->setMainView('error');
        $this->view->disableLevel(View::LEVEL_LAYOUT);
    }

    public function error403Action()
    {
        $this->view->setVars([
            'code'        => 403,
            'headMessage' => 'Forbidden',
            'message'     => 'Sorry! You are not allowed to access this page.',
        ]);
    }
}
