<?php

namespace Webappsaler\Models;
class Application extends \Phalcon\Mvc\Model
{

    /**
     *
     * @var string
     * @Column(column="nom", type="string", length=150, nullable=true)
     */
    protected $nom;

    /**
     *
     * @var integer
     * @Primary
     * @Identity
     * @Column(column="id", type="integer", nullable=false)
     */
    protected $id;

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
     * Returns the value of field nom
     *
     * @return string
     */
    public function getNom(): string
    {
        return $this->nom;
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
     * Initialize method for model.
     */
    public function initialize()
    {
        $this->setSchema("angy_db");
        $this->setSource("application");
        $this->hasMany('id', 'Module', 'id_application', ['alias' => 'Module']);
        $this->hasMany('id', 'Projet', 'id_application', ['alias' => 'Projet']);
    }

    /**
     * Allows to query a set of records that match the specified conditions
     *
     * @param mixed $parameters
     * @return Application[]|Application|\Phalcon\Mvc\Model\ResultSetInterface
     */
    public static function find($parameters = null): \Phalcon\Mvc\Model\ResultsetInterface
    {
        return parent::find($parameters);
    }

    /**
     * Allows to query the first record that match the specified conditions
     *
     * @param mixed $parameters
     * @return Application|\Phalcon\Mvc\Model\ResultInterface|\Phalcon\Mvc\ModelInterface|null
     */
    public static function findFirst($parameters = null): ?\Phalcon\Mvc\ModelInterface
    {
        return parent::findFirst($parameters);
    }

}
