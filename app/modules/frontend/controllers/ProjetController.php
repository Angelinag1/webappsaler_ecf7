<?php
declare(strict_types=1);

namespace Webappsaler\modules\frontend\controllers;

use Webappsaler\Models\Chefdeprojet;
use Webappsaler\Models\Composant;
use Webappsaler\Models\Developpeur;
use Webappsaler\Models\Projet;
use Webappsaler\Models\Equipe;

class ProjetController extends \Phalcon\Mvc\Controller
{
    public function indexAction()
    {
        // Appeler la méthode pour récupérer les chefs de projet sous forme de tableau
        $projets = $this->getProjet();


        // Appeler la méthode pour générer le code HTML de la table
        $tabProjet = $this->generateTable($projets);

        // Passer la variable tabEquipe à la vue
        $this->view->setVar("tabProjet", $tabProjet);
    }

    // Méthode pour récupérer les équipes sous forme de tableau
    private function getProjet()
    {
        $chefsProjet = [];
        $projets = [];
        foreach (Projet::find() as $projet) {

            $id = $projet->getId();
            $raison_social = $projet->Client->getRaisonSocial();
            $type = $projet->translateType();
            $type_compo = ''; // Initialize the variable with a default value
            $developers = Developpeur::find(); // Retrieve the list of available developers from the database (you need to implement this)
            $statut = $projet->translateStatut();
            $component = Composant::findFirst($projet->getIdComposant());
            if ($component) {
                $charge = $component->getCharge();
                $type_compo = $component->translateType();
            }
            $prix = $projet->getPrix();
            $projets [] = [
                'id' => $id,
                'raison_social' => $raison_social,
                'type' => $type,
                'type_compo' => $type_compo,
                'statut' => $statut,
                'charge' => $charge,
                'prix' => $prix,
            ];
        }
        return $projets;
    }

    // Méthode pour générer le code HTML de la table*
    private function generateTable(array $projets)
    {
        // CREATION DU FORMULAIRE
        $tabProjet = "";
        $tabProjet .= "<table class='table table-striped table-bordered'>";
        $tabProjet .= '<thead>
                <tr>
                    <th>#</th>
                    <th>Raison Sociale du client</th>
                    <th>Type</th>
                    <th>Prix</th>
                    <th>Statut</th>
                </tr>
            </thead>';
        $tabProjet .= '<tbody>';

        // Parcours le tableau projet pour récupérer chaque donnée
        foreach ($projets as $projet) {
            $tabProjet .= '<tr>';
            $tabProjet .= '<td>' . htmlspecialchars($projet['id']) . '</td>';
            $tabProjet .= '<td>' . htmlspecialchars($projet['raison_social']) . '</td>';
            $tabProjet .= '<td>' . htmlspecialchars($projet['type']) . '</td>';
            $tabProjet .= '<td>' . htmlspecialchars($projet['prix']) . ' EUR</td>';
            $tabProjet .= '<td>' . htmlspecialchars($projet['statut']) . '</td>';
            $tabProjet .= '</tr>';
        }
        $tabProjet .= '</tbody>';
        $tabProjet .= "</table>";

        // Bouton pour accéder à la vue "update" dans le dossier "projet"
        $tabProjet .= "<a href='projet/update'>Commencer un projet !</a>";

        return $tabProjet;
    }
    public function updateAction()
    {
        // Appeler la méthode pour récupérer les chefs de projet sous forme de tableau
        $projets = $this->getProjet();

        // Appeler la méthode pour générer le code HTML de la table
        $formProjet = $this->generateForm($projets);

        // Passer la variable tabEquipe à la vue
        $this->view->setVar("formProjet", $formProjet);
    }

    private function generateForm(array $projets)
    {
        // CREATION DU FORMULAIRE
        $formProjet = '<form action="/projet/update" method="post">';

        // Groupe de radio pour les clients
        $formProjet .= '<label for="client">Sélectionner un Client</label><br>';
        foreach ($projets as $projet) {
            $formProjet .= '<input type="radio" id="client_' . $projet['id'] . '" name="client" value="' . htmlspecialchars($projet['id']) . '">';
            $formProjet .= '<label for="client_' . $projet['id'] . '">' . htmlspecialchars($projet['raison_social']) . '</label><br>';
        }

        // Liste déroulante pour sélectionner le type de projet
        $formProjet .= '<label for="type_projet">Sélectionner un Type de Projet</label><br>';
        $formProjet .= '<select id="type_projet" name="type_projet">';
        // Récupérer les types de projet uniques à partir du tableau $projets
        $typesProjets = array_unique(array_column($projets, 'type'));
        foreach ($typesProjets as $typeProjet) {
            $formProjet .= '<option value="' . htmlspecialchars($typeProjet) . '">' . htmlspecialchars($typeProjet) . '</option>';
        }
        $formProjet .= '</select><br>';

        $formProjet .= '<input type="submit" value="Commencer un projet !">';
        $formProjet .= '</form>';

        return $formProjet;
    }

}
