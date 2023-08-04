<?php
declare(strict_types=1);

namespace Webappsaler\Modules\Frontend\Controllers;

use Webappsaler\Models\Chefdeprojet;
use Webappsaler\Models\Collaborateur;

class CollaborateurController extends \Phalcon\Mvc\Controller
{
    public function indexAction()
    {
        // Appeler la méthode pour récupérer les chefs de projet sous forme de tableau
        $collabs = $this->getCollab();

        // Appeler la méthode pour générer le code HTML de la table
        $tabCollab = $this->generateTable($collabs);

        // Passer la variable tabEquipe à la vue
        $this->view->setVar("tabCollab", $tabCollab);
    }

    // Méthode pour récupérer les équipes sous forme de tableau
    private function getCollab()
    {
        $collabs = [];
        foreach (Collaborateur::find() as $collab)
        {
            $id = $collab->getId();
            $nom = $collab->getNom();
            $niveau = $collab->translateNiveau();
            $prime = $collab->getPrimeEmbauche();
            $collabs [] = [
                'id' => $id,
                'nom' => $nom,
                'niveau' => $niveau,
                'prime' => $prime,
            ];
        }
        return $collabs;
    }

    // Méthode pour générer le code HTML de la table
    private function generateTable(array $collabs)
    {
        $tabCollab = "<a href='collaborateur/create' class='btn btn-primary'>Ajouter un collaborateur</a>";
        $tabCollab .= "<table class='table table-striped table-bordered'>";
        $tabCollab .= '<thead>
                            <tr>
                                <th>ID</th>
                                <th>Nom du Collaborateur</th>
                                <th>Niveau</th>
                                <th>Prime Embauche</th>
                            </tr>
                            </thead>';
        $tabCollab .= '<tbody>';

        foreach ($collabs as $collab) {
            $tabCollab .= '<tr>';
            $tabCollab .= '<td>' . $collab['id'] . '</td>';
            $tabCollab .= '<td>' . $collab['nom'] . '</td>';
            $tabCollab .= '<td>' . $collab['niveau'] . '</td>';
            $tabCollab .= '<td>' . $collab['prime'] . '</td>';
            $tabCollab .= '<td> modifier </td>';
            $tabCollab .= '<td> <a href="/collaborateur/delete'.  $collab['id']. '" class="btn btn-danger">Supprimer</a></td>';
            $tabCollab .= '</tr>';
        }

        $tabCollab .= '</tbody>';
        $tabCollab .= '</table>';

        return $tabCollab;
    }
    public function deleteAction($idCollaborateur)
    {
        $collaborateur = Collaborateur::findFirstById($idCollaborateur);
        if ($collaborateur) {
            $collaborateur->delete();
            $this->flashSession->success("Le collaborateur a été supprimé avec succès.");
        } else {
            $this->flashSession->error("Impossible de trouver le collaborateur.");
        }

        // Rediriger vers la page de la liste des collaborateurs après la suppression
        $this->response->redirect('collaborateur');
    }
    public function createAction()
    {

        // Vérifier si le formulaire a été soumis en utilisant la méthode POST
        if ($this->request->isPost()) {

            // Créer et enregistrer le collaborateur
            $collaborateur = new Collaborateur();
            $collaborateur->setNom($this->request->getPost("nom", "string"));
            $collaborateur->setNiveauCompetence($this->request->getPost("niveau", "int"));
            $collaborateur->setPrimeEmbauche($this->request->getPost("prime", "int"));

            if ($collaborateur->save()) {
                echo "Nouveau collaborateur ajouté avec succès !";
            } else {
                echo "Erreur lors de l'ajout du collaborateur : ";
                foreach ($collaborateur->getMessages() as $message) {
                    echo $message;
                }
            }
        }
        else {

            // Passer les données à la vue// Vous pouvez passer des données supplémentaires au formulaire si nécessaire
        $data = [
            'titre' => 'Formulaire de création de collaborateur',
            'optionsNiveau' => ['Stagiaire', 'Junior', 'Senior'],
        ];

        // Passer les données à la vue
        $this->view->setVars($data);

        // Afficher la vue (template) contenant le formulaire de création de collaborateur
        $this->view->pick('collaborateur/create');

            $this->view->setVars($data);

            // Afficher la vue (template) contenant le formulaire de création de collaborateur
            $this->view->pick('collaborateur/create');

        }
        // Rediriger vers l'action d'affichage de la liste des collaborateurs après l'ajout
        $this->response->redirect('webappsaler/collaborateur');
    }
}

