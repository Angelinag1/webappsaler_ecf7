<?php

class Client extends \Phalcon\Mvc\Model
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
     * @Column(column="raison_social", type="string", length=50, nullable=true)
     */
    protected $raison_social;

    /**
     *
     * @var string
     * @Column(column="ridet", type="string", length=10, nullable=true)
     */
    protected $ridet;

    /**
     *
     * @var integer
     * @Column(column="ss2i", type="integer", nullable=true)
     */
    protected $ss2i;

    /**
     *
     * @var integer
     * @Column(column="cmd_composant", type="integer", nullable=true)
     */
    protected $cmd_composant;

    /**
     *
     * @var integer
     * @Column(column="cmd_module", type="integer", nullable=true)
     */
    protected $cmd_module;

    /**
     *
     * @var integer
     * @Column(column="cmd_application", type="integer", nullable=true)
     */
    protected $cmd_application;

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
     * Method to set the value of field raison_social
     *
     * @param string $raison_social
     * @return $this
     */
    public function setRaisonSocial($raison_social)
    {
        $this->raison_social = $raison_social;

        return $this;
    }

    /**
     * Method to set the value of field ridet
     *
     * @param string $ridet
     * @return $this
     */
    public function setRidet($ridet)
    {
        $this->ridet = $ridet;

        return $this;
    }

    /**
     * Method to set the value of field ss2i
     *
     * @param integer $ss2i
     * @return $this
     */
    public function setSs2i($ss2i)
    {
        $this->ss2i = $ss2i;

        return $this;
    }

    /**
     * Method to set the value of field cmd_composant
     *
     * @param integer $cmd_composant
     * @return $this
     */
    public function setCmdComposant($cmd_composant)
    {
        $this->cmd_composant = $cmd_composant;

        return $this;
    }

    /**
     * Method to set the value of field cmd_module
     *
     * @param integer $cmd_module
     * @return $this
     */
    public function setCmdModule($cmd_module)
    {
        $this->cmd_module = $cmd_module;

        return $this;
    }

    /**
     * Method to set the value of field cmd_application
     *
     * @param integer $cmd_application
     * @return $this
     */
    public function setCmdApplication($cmd_application)
    {
        $this->cmd_application = $cmd_application;

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
     * Returns the value of field raison_social
     *
     * @return string
     */
    public function getRaisonSocial()
    {
        return $this->raison_social;
    }

    /**
     * Returns the value of field ridet
     *
     * @return string
     */
    public function getRidet()
    {
        return $this->ridet;
    }

    /**
     * Returns the value of field ss2i
     *
     * @return integer
     */
    public function getSs2i()
    {
        return $this->ss2i;
    }

    /**
     * Returns the value of field cmd_composant
     *
     * @return integer
     */
    public function getCmdComposant()
    {
        return $this->cmd_composant;
    }

    /**
     * Returns the value of field cmd_module
     *
     * @return integer
     */
    public function getCmdModule()
    {
        return $this->cmd_module;
    }

    /**
     * Returns the value of field cmd_application
     *
     * @return integer
     */
    public function getCmdApplication()
    {
        return $this->cmd_application;
    }

    /**
     * Initialize method for model.
     */
    public function initialize()
    {
        $this->setSchema("angy_db");
        $this->setSource("client");
        $this->hasMany('id', 'Projet', 'id_client', ['alias' => 'Projet']);
    }

    /**
     * Allows to query a set of records that match the specified conditions
     *
     * @param mixed $parameters
     * @return Client[]|Client|\Phalcon\Mvc\Model\ResultSetInterface
     */
    public static function find($parameters = null): \Phalcon\Mvc\Model\ResultsetInterface
    {
        return parent::find($parameters);
    }

    /**
     * Allows to query the first record that match the specified conditions
     *
     * @param mixed $parameters
     * @return Client|\Phalcon\Mvc\Model\ResultInterface|\Phalcon\Mvc\ModelInterface|null
     */
    public static function findFirst($parameters = null): ?\Phalcon\Mvc\ModelInterface
    {
        return parent::findFirst($parameters);
    }

}
