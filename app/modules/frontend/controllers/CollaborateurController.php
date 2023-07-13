<?php
declare(strict_types=1);

namespace Webappsaler\Modules\Frontend\Controllers;

use Webappsaler\Models\Collaborateur;

class CollaborateurController extends \Phalcon\Mvc\Controller
{
    public function indexAction()
    {
        $collaborateurs = Collaborateur::find();
        $this->view->setVar("collaborateurs", $collaborateurs);
    }

}

