<?php
declare(strict_types=1);

namespace Webappsaler\modules\frontend\controllers;

use Webappsaler\Models\Chefdeprojet;
use Webappsaler\Models\Equipe;

class ChefdeprojetController extends \Phalcon\Mvc\Controller
{
    public function indexAction()
    {
        // Appeler la méthode pour récupérer les chefs de projet sous forme de tableau
        $chefsProjet = $this->getCdp();

        // Appeler la méthode pour générer le code HTML de la table
        $tabChefsProjet = $this->generateTable($chefsProjet);

        // Passer la variable tabEquipe à la vue
        $this->view->setVar("tabChefsProjet", $tabChefsProjet);
    }

    // Méthode pour récupérer les équipes sous forme de tableau
    private function getCdp()
    {
        $chefsProjet = [];
        foreach (Chefdeprojet::find() as $chefProjet)
        {
            $id = $chefProjet->getId();
            $nom = $chefProjet->Collaborateur->getNom();
            $niveau = $chefProjet->Collaborateur->translateNiveau();
            $boost = $chefProjet->getBoostProduction();
            $chefsProjet [] = [
                'id' => $id,
                'nom' => $nom,
                'niveau' => $niveau,
                'boost' => $boost,
            ];
        }
        return $chefsProjet;
    }

    // Méthode pour générer le code HTML de la table
    private function generateTable(array $chefsProjet)
    {
        $tabChefsProjet = "<table class='table table-striped table-bordered'>";
        $tabChefsProjet .= '<thead>
                            <tr>
                                <th>ID</th>
                                <th>Nom du Chef de projet</th>
                                <th>Niveau</th>
                                <th>Boost de Production</th>
                            </tr>
                            </thead>';
        $tabChefsProjet .= '<tbody>';

        foreach ($chefsProjet as $chef) {
            $tabChefsProjet .= '<tr>';
            $tabChefsProjet .= '<td>' . $chef['id'] . '</td>';
            $tabChefsProjet .= '<td>' . $chef['nom'] . '</td>';
            $tabChefsProjet .= '<td>' . $chef['niveau'] . '</td>';
            $tabChefsProjet .= '<td>' . $chef['boost'] . '</td>';
            $tabChefsProjet .= '</tr>';
        }

        $tabChefsProjet .= '</tbody>';
        $tabChefsProjet .= '</table>';

        return $tabChefsProjet;
    }
}

