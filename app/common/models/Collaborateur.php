<?php

namespace Webappsaler\Models;
use Phalcon\Validation;

class Collaborateur extends \Phalcon\Mvc\Model
{

    /**
     *
     * @var integer
     * @Primary
     * @Identity
     * @Column(column="id", type="integer", nullable=false)
     */
    protected $id;

    /**
     *
     * @var string
     * @Column(column="nom", type="string", length=150, nullable=false)
     */
    protected $nom;

    /**
     *
     * @var string
     * @Column(column="niveau-competence", type="string", length='1','2','3', nullable=false)
     */
    protected $niveauCompetence;

    const _NIVEAU_1_STAGIAIRE_ = 1;
    const _NIVEAU_2_JUNIOR_ = 2;
    const _NIVEAU_3_SENIOR_ = 3;
    /**
     *
     * @var integer
     * @Column(column="prime_embauche", type="integer", nullable=false)
     */
    protected $prime_embauche;

    /**
     * Method to set the value of field id
     *
     * @param integer $id
     * @return $this
     */


    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * Method to set the value of field nom
     *
     * @param string $nom
     * @return $this
     */
    public function setNom($nom)
    {
        $this->nom = $nom;

        return $this;
    }

    /**
     * Method to set the value of field niveau-competence
     *
     * @param string $niveauCompetence
     * @return $this
     */
    public function setNiveauCompetence($niveauCompetence)
    {
        $this->niveauCompetence = $niveauCompetence;

        return $this;
    }

    /**
     * Method to set the value of field prime_embauche
     *
     * @param integer $prime_embauche
     * @return $this
     */
    public function setPrimeEmbauche($prime_embauche)
    {
        $this->prime_embauche = $prime_embauche;

        return $this;
    }

    /**
     * Returns the value of field id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Returns the value of field nom
     *
     * @return string
     */
    public function getNom()
    {
        return $this->nom;
    }

    /**
     * Returns the value of field niveauCompetence
     *
     * @return string
     */
    public function getNiveauCompetence()
    {
        return intval($this->niveauCompetence);
    }

    /**
     * @return string
     */

    /* cette methode sert à traduire les niveaux des collaborateurs*/
    public function translateNiveau( ) : string
    {
        switch ($this->getNiveauCompetence()){
            case self::_NIVEAU_1_STAGIAIRE_:return 'STAGIAIRE';
            case self::_NIVEAU_2_JUNIOR_ :return 'JUNIOR';
            case self::_NIVEAU_3_SENIOR_:return 'SENIOR';
            default : return 'Pas de niveau'  ;
        }
    }

    /**
     * @return bool
     */

    /* Permet de verifier la valeur dans niveau-competence */
    public function validation() : bool
    {
        $validator = new Validation();
        $validator->add(
            'niveau-competence',
            new Validation\Validator\InclusionIn(
            [
                'template' => 'Le champ :field doit avoir une valeur comprise entre 1 et 3',
                'template' => 'Le champ :field doit avoir une valeur comprise entre 1 et 3',
                'template' => [
                    self::_NIVEAU_1_STAGIAIRE_,
                    self::_NIVEAU_2_JUNIOR_,
                    self::_NIVEAU_3_SENIOR_,
                ],
            ]
            )
        );
        return $this->validate($validator);
    }

    /**
     * Returns the value of field prime_embauche
     *
     * @return integer
     */
    public function getPrimeEmbauche()
    {
        return $this->prime_embauche;
    }

    /**
     * Initialize method for model.
     */
    public function initialize()
    {
        $this->setSchema("angy_db");
        $this->setSource("collaborateur");
        $this->hasMany('id', 'Chefdeprojet', 'id_collaborateur', ['alias' => 'Chefdeprojet']);
        $this->hasMany('id', 'Developpeur', 'id_collaborateur', ['alias' => 'Developpeur']);
    }

    /**
     * Allows to query a set of records that match the specified conditions
     *
     * @param mixed $parameters
     * @return Collaborateur[]|Collaborateur|\Phalcon\Mvc\Model\ResultSetInterface
     */
    public static function find($parameters = null): \Phalcon\Mvc\Model\ResultsetInterface
    {
        return parent::find($parameters);
    }

    /**
     * Allows to query the first record that match the specified conditions
     *
     * @param mixed $parameters
     * @return Collaborateur|\Phalcon\Mvc\Model\ResultInterface|\Phalcon\Mvc\ModelInterface|null
     */
    public static function findFirst($parameters = null): ?\Phalcon\Mvc\ModelInterface
    {
        return parent::findFirst($parameters);
    }





}
