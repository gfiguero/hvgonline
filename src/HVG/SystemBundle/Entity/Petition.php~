<?php

namespace HVG\SystemBundle\Entity;

/**
 * Petition
 */
class Petition
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
    private $expiry;

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
     * @var \Doctrine\Common\Collections\Collection
     */
    private $petitionactions;

    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $petitionevaluations;

    /**
     * @var \HVG\SystemBundle\Entity\PetitionStatus
     */
    private $petitionstatus;

    /**
     * @var \HVG\SystemBundle\Entity\Community
     */
    private $community;

    /**
     * @var \HVG\SystemBundle\Entity\Area
     */
    private $area;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->petitionactions = new \Doctrine\Common\Collections\ArrayCollection();
        $this->petitionevaluations = new \Doctrine\Common\Collections\ArrayCollection();
    }

    public function __toString()
    {
        return (string) $this->id;
    }

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
     * @return Petition
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
     * Set expiry
     *
     * @param \DateTime $expiry
     *
     * @return Petition
     */
    public function setExpiry($expiry)
    {
        $this->expiry = $expiry;

        return $this;
    }

    /**
     * Get expiry
     *
     * @return \DateTime
     */
    public function getExpiry()
    {
        return $this->expiry;
    }

    /**
     * Set createdAt
     *
     * @param \DateTime $createdAt
     *
     * @return Petition
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
     * @return Petition
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
     * @return Petition
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
     * Add petitionAction
     *
     * @param \HVG\SystemBundle\Entity\PetitionAction $petitionAction
     *
     * @return Petition
     */
    public function addPetitionAction(\HVG\SystemBundle\Entity\PetitionAction $petitionAction)
    {
        $this->petitionactions[] = $petitionAction;

        return $this;
    }

    /**
     * Remove petitionAction
     *
     * @param \HVG\SystemBundle\Entity\PetitionAction $petitionAction
     */
    public function removePetitionAction(\HVG\SystemBundle\Entity\PetitionAction $petitionAction)
    {
        $this->petitionactions->removeElement($petitionAction);
    }

    /**
     * Get petitionActions
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getPetitionActions()
    {
        return $this->petitionactions;
    }

    /**
     * Add petitionEvaluation
     *
     * @param \HVG\SystemBundle\Entity\PetitionEvaluation $petitionEvaluation
     *
     * @return Petition
     */
    public function addPetitionEvaluation(\HVG\SystemBundle\Entity\PetitionEvaluation $petitionEvaluation)
    {
        $this->petitionevaluations[] = $petitionEvaluation;

        return $this;
    }

    /**
     * Remove petitionEvaluation
     *
     * @param \HVG\SystemBundle\Entity\PetitionEvaluation $petitionEvaluation
     */
    public function removePetitionEvaluation(\HVG\SystemBundle\Entity\PetitionEvaluation $petitionEvaluation)
    {
        $this->petitionevaluations->removeElement($petitionEvaluation);
    }

    /**
     * Get petitionEvaluations
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getPetitionEvaluations()
    {
        return $this->petitionevaluations;
    }

    /**
     * Set petitionStatus
     *
     * @param \HVG\SystemBundle\Entity\PetitionStatus $petitionStatus
     *
     * @return Petition
     */
    public function setPetitionStatus(\HVG\SystemBundle\Entity\PetitionStatus $petitionStatus = null)
    {
        $this->petitionstatus = $petitionStatus;

        return $this;
    }

    /**
     * Get petitionStatus
     *
     * @return \HVG\SystemBundle\Entity\PetitionStatus
     */
    public function getPetitionStatus()
    {
        return $this->petitionstatus;
    }

    /**
     * Set community
     *
     * @param \HVG\SystemBundle\Entity\Community $community
     *
     * @return Petition
     */
    public function setCommunity(\HVG\SystemBundle\Entity\Community $community = null)
    {
        $this->community = $community;

        return $this;
    }

    /**
     * Get community
     *
     * @return \HVG\SystemBundle\Entity\Community
     */
    public function getCommunity()
    {
        return $this->community;
    }

    /**
     * Set area
     *
     * @param \HVG\SystemBundle\Entity\Area $area
     *
     * @return Petition
     */
    public function setArea(\HVG\SystemBundle\Entity\Area $area = null)
    {
        $this->area = $area;

        return $this;
    }

    /**
     * Get area
     *
     * @return \HVG\SystemBundle\Entity\Area
     */
    public function getArea()
    {
        return $this->area;
    }

    /**
     * @var \HVG\UserBundle\Entity\User
     */
    private $user;


    /**
     * Set user
     *
     * @param \HVG\UserBundle\Entity\User $user
     *
     * @return Petition
     */
    public function setUser(\HVG\UserBundle\Entity\User $user = null)
    {
        $this->user = $user;

        return $this;
    }

    /**
     * Get user
     *
     * @return \HVG\UserBundle\Entity\User
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * @var \HVG\UserBundle\Entity\User
     */
    private $liability;


    /**
     * Set liability
     *
     * @param \HVG\UserBundle\Entity\User $liability
     *
     * @return Petition
     */
    public function setLiability(\HVG\UserBundle\Entity\User $liability = null)
    {
        $this->liability = $liability;

        return $this;
    }

    /**
     * Get liability
     *
     * @return \HVG\UserBundle\Entity\User
     */
    public function getLiability()
    {
        return $this->liability;
    }
}
