<?php
declare(strict_types=1);

namespace Webappsaler\Modules\Frontend\Controllers;

class IndexController extends ControllerBase
{

    public function indexAction()
    {
        $this->view->users = \Collaborateur::find();
    }

}

