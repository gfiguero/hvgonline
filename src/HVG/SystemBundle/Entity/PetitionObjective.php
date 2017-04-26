<?php

namespace HVG\SystemBundle\Entity;

/**
 * PetitionObjective
 */
class PetitionObjective
{
    /**
     * @var integer
     */
    private $id;

    /**
     * @var string
     */
    private $description;

    /**
     * @var boolean
     */
    private $completed;

    /**
     * @var \HVG\SystemBundle\Entity\Petition
     */
    private $petition;


    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set description
     *
     * @param string $description
     *
     * @return PetitionObjective
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get description
     *
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set completed
     *
     * @param boolean $completed
     *
     * @return PetitionObjective
     */
    public function setCompleted($completed)
    {
        $this->completed = $completed;

        return $this;
    }

    /**
     * Get completed
     *
     * @return boolean
     */
    public function getCompleted()
    {
        return $this->completed;
    }

    /**
     * Set petition
     *
     * @param \HVG\SystemBundle\Entity\Petition $petition
     *
     * @return PetitionObjective
     */
    public function setPetition(\HVG\SystemBundle\Entity\Petition $petition = null)
    {
        $this->petition = $petition;

        return $this;
    }

    /**
     * Get petition
     *
     * @return \HVG\SystemBundle\Entity\Petition
     */
    public function getPetition()
    {
        return $this->petition;
    }
}

