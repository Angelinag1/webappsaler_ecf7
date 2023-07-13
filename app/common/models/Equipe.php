<?php

namespace Webappsaler\Models;
class Equipe extends \Phalcon\Mvc\Model
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
     * @var integer
     * @Column(column="id_chefdeprojet", type="integer", nullable=false)
     */
    protected $id_chefdeprojet;

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
     * Method to set the value of field id_chefdeprojet
     *
     * @param integer $id_chefdeprojet
     * @return $this
     */
    public function setIdChefdeprojet($id_chefdeprojet)
    {
        $this->id_chefdeprojet = $id_chefdeprojet;

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
     * Returns the value of field id_chefdeprojet
     *
     * @return integer
     */
    public function getIdChefdeprojet()
    {
        return $this->id_chefdeprojet;
    }

    /**
     * Initialize method for model.
     */
    public function initialize()
    {
        $this->setSchema("angy_db");
        $this->setSource("equipe");
        $this->hasMany('id', 'CompositionEquipe', 'id_equipe', ['alias' => 'CompositionEquipe']);
        $this->belongsTo('id_chefdeprojet', '\Webappsaler\Common\Models\Chefdeprojet', 'id', ['alias' => 'Chefdeprojet']);
    }

    /**
     * Allows to query a set of records that match the specified conditions
     *
     * @param mixed $parameters
     * @return Equipe[]|Equipe|\Phalcon\Mvc\Model\ResultSetInterface
     */
    public static function find($parameters = null): \Phalcon\Mvc\Model\ResultsetInterface
    {
        return parent::find($parameters);
    }

    /**
     * Allows to query the first record that match the specified conditions
     *
     * @param mixed $parameters
     * @return Equipe|\Phalcon\Mvc\Model\ResultInterface|\Phalcon\Mvc\ModelInterface|null
     */
    public static function findFirst($parameters = null): ?\Phalcon\Mvc\ModelInterface
    {
        return parent::findFirst($parameters);
    }

}
