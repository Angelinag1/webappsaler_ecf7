<?php
declare(strict_types=1);

namespace Webappsaler\Modules\Frontend\Controllers;

use Webappsaler\Models\Developpeur;

class DeveloppeurController extends \Phalcon\Mvc\Controller
{
    public function indexAction()
    {
        $developpeurs = Developpeur::find();
        $this->view->setVar("developpeurs", $developpeurs);
    }

}
