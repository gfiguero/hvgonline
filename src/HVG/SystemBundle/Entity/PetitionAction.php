<?php

namespace HVG\SystemBundle\Entity;

/**
 * PetitionAction
 */
class PetitionAction
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
     * @var \DateTime
     */
    private $createdAt;

    /**
     * @var \DateTime
     */
    private $updatedAt;

    /**
     * @var \DateTime
     */
    private $deletedAt;

    /**
     * @var \HVG\SystemBundle\Entity\Petition
     */
    private $petition;

    /**
     * @var \HVG\SystemBundle\Entity\Agent
     */
    private $agent;


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
     * @return PetitionAction
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
     * Set createdAt
     *
     * @param \DateTime $createdAt
     *
     * @return PetitionAction
     */
    public function setCreatedAt($createdAt)
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    /**
     * Get createdAt
     *
     * @return \DateTime
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    /**
     * Set updatedAt
     *
     * @param \DateTime $updatedAt
     *
     * @return PetitionAction
     */
    public function setUpdatedAt($updatedAt)
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }

    /**
     * Get updatedAt
     *
     * @return \DateTime
     */
    public function getUpdatedAt()
    {
        return $this->updatedAt;
    }

    /**
     * Set deletedAt
     *
     * @param \DateTime $deletedAt
     *
     * @return PetitionAction
     */
    public function setDeletedAt($deletedAt)
    {
        $this->deletedAt = $deletedAt;

        return $this;
    }

    /**
     * Get deletedAt
     *
     * @return \DateTime
     */
    public function getDeletedAt()
    {
        return $this->deletedAt;
    }

    /**
     * Set petition
     *
     * @param \HVG\SystemBundle\Entity\Petition $petition
     *
     * @return PetitionAction
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

    /**
     * Set agent
     *
     * @param \HVG\SystemBundle\Entity\Agent $agent
     *
     * @return PetitionAction
     */
    public function setAgent(\HVG\SystemBundle\Entity\Agent $agent = null)
    {
        $this->agent = $agent;

        return $this;
    }

    /**
     * Get agent
     *
     * @return \HVG\SystemBundle\Entity\Agent
     */
    public function getAgent()
    {
        return $this->agent;
    }
}