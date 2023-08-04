<?php
declare(strict_types=1);

namespace Webappsaler\Modules\Frontend\Controllers;

use Webappsaler\Models\Chefdeprojet;
use Webappsaler\Models\Developpeur;

class DeveloppeurController extends \Phalcon\Mvc\Controller
{
    public function indexAction()
    {
        // Appeler la méthode pour récupérer les chefs de projet sous forme de tableau
        $developpeurs = $this->getDev();

        // Appeler la méthode pour générer le code HTML de la table
        $tabDev = $this->generateTable($developpeurs);

        // Passer la variable tabEquipe à la vue
        $this->view->setVar("tabDev", $tabDev);
    }

    // Méthode pour récupérer les équipes sous forme de tableau
    private function getDev()
    {
        $developpeurs = [];
        foreach (Developpeur::find() as $developpeur) {

            $id = $developpeur->getId();
            $nom = $developpeur->Collaborateur->getNom();
            $competencedev = $developpeur->translateCompetence();
            $niveau = $developpeur->Collaborateur->translateNiveau();
            $indice = $developpeur->getIndiceProduction();
            $developpeurs [] = [
                'id' => $id,
                'nom' => $nom,
                'competence' => $competencedev,
                'niveau' => $niveau,
                'indice' => $indice,
            ];
        }
        return $developpeurs;
    }

    // Méthode pour générer le code HTML de la table
    private function generateTable(array $chefsProjet)
    {
        $tabDev = "<table class='table table-striped table-bordered'>";
        $tabDev .= '<thead>
                            <tr>
                                <th>ID</th>
                                <th>Nom du Developpeur</th>
                                <th>Competence</th>
                                <th>Niveau</th>
                                <th>Indice de Production</th>
                            </tr>
                            </thead>';
        $tabDev .= '<tbody>';

        foreach ($chefsProjet as $chef) {
            $tabDev .= '<tr>';
            $tabDev .= '<td>' . $chef['id'] . '</td>';
            $tabDev .= '<td>' . $chef['nom'] . '</td>';
            $tabDev .= '<td>' . $chef['competence'] . '</td>';
            $tabDev .= '<td>' . $chef['niveau'] . '</td>';
            $tabDev .= '<td>' . $chef['indice'] . '</td>';
            $tabDev .= '</tr>';
        }

        $tabDev .= '</tbody>';
        $tabDev .= '</table>';

        return $tabDev;
    }
}
