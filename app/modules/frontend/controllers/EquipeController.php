<?php
declare(strict_types=1);

namespace Webappsaler\modules\frontend\controllers;

use Webappsaler\Models\Equipe;

class EquipeController extends \Phalcon\Mvc\Controller
{
    public function indexAction()
    {
        // Appeler la méthode pour récupérer les équipes sous forme de tableau
        $equipes = $this->getEquipes();

        // Appeler la méthode pour générer le code HTML de la table
        $tabEquipe = $this->generateTable($equipes);

        // Passer la variable tabEquipe à la vue
        $this->view->setVar("tabEquipe", $tabEquipe);
    }

    // Méthode pour récupérer les équipes sous forme de tableau
    private function getEquipes()
    {
        $equipes = [];
        foreach (Equipe::find() as $equipe)
        {
            $id = $equipe->getId();
            $cdp = $equipe->Chefdeprojet->Collaborateur->getNom();
            $equipes[] = [
                'cdp' => $cdp,
                'id' => $id,
            ];
        }
        return $equipes;
    }

    // Méthode pour générer le code HTML de la table
    private function generateTable(array $equipes)
    {
        $tabEquipe = "<table class='table table-striped table-bordered'>";
        $tabEquipe .= '<thead><tr><th>ID</th><th>Nom du Chef de projet</th></tr></thead>';
        $tabEquipe .= '<tbody>';

        foreach ($equipes as $team) {
            $tabEquipe .= '<tr>';
            $tabEquipe .= '<td>' . $team['id'] . '</td>';
            $tabEquipe .= '<td>' . $team['cdp'] . '</td>';
            $tabEquipe .= '</tr>';
        }

        $tabEquipe .= '</tbody>';
        $tabEquipe .= '</table>';

        return $tabEquipe;
    }
}
