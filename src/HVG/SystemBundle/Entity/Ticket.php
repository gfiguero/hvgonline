<?php

namespace HVG\SystemBundle\Entity;

/**
 * Ticket
 */
class Ticket
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
     * @var string
     */
    private $contactname;

    /**
     * @var string
     */
    private $contactphone;

    /**
     * @var string
     */
    private $contactemail;

    /**
     * @var \DateTime
     */
    private $committal;

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
    private $ticketactions;

    /**
     * @var \HVG\SystemBundle\Entity\Unit
     */
    private $unit;

    /**
     * @var \HVG\SystemBundle\Entity\TicketStatus
     */
    private $ticketstatus;

    /**
     * @var \HVG\SystemBundle\Entity\Area
     */
    private $area;

    /**
     * @var \HVG\UserBundle\Entity\User
     */
    private $user;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->ticketactions = new \Doctrine\Common\Collections\ArrayCollection();
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
     * @return Ticket
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
     * Set contactName
     *
     * @param string $contactName
     *
     * @return Ticket
     */
    public function setContactName($contactName)
    {
        $this->contactname = $contactName;

        return $this;
    }

    /**
     * Get contactName
     *
     * @return string
     */
    public function getContactName()
    {
        return $this->contactname;
    }

    /**
     * Set contactPhone
     *
     * @param string $contactPhone
     *
     * @return Ticket
     */
    public function setContactPhone($contactPhone)
    {
        $this->contactphone = $contactPhone;

        return $this;
    }

    /**
     * Get contactPhone
     *
     * @return string
     */
    public function getContactPhone()
    {
        return $this->contactphone;
    }

    /**
     * Set contactEmail
     *
     * @param string $contactEmail
     *
     * @return Ticket
     */
    public function setContactEmail($contactEmail)
    {
        $this->contactemail = $contactEmail;

        return $this;
    }

    /**
     * Get contactEmail
     *
     * @return string
     */
    public function getContactEmail()
    {
        return $this->contactemail;
    }

    /**
     * Set committal
     *
     * @param \DateTime $committal
     *
     * @return Ticket
     */
    public function setCommittal($committal)
    {
        $this->committal = $committal;

        return $this;
    }

    /**
     * Get committal
     *
     * @return \DateTime
     */
    public function getCommittal()
    {
        return $this->committal;
    }

    /**
     * Set createdAt
     *
     * @param \DateTime $createdAt
     *
     * @return Ticket
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
     * @return Ticket
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
     * @return Ticket
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
     * Add ticketaction
     *
     * @param \HVG\SystemBundle\Entity\TicketAction $ticketaction
     *
     * @return Ticket
     */
    public function addTicketaction(\HVG\SystemBundle\Entity\TicketAction $ticketaction)
    {
        $this->ticketactions[] = $ticketaction;

        return $this;
    }

    /**
     * Remove ticketaction
     *
     * @param \HVG\SystemBundle\Entity\TicketAction $ticketaction
     */
    public function removeTicketaction(\HVG\SystemBundle\Entity\TicketAction $ticketaction)
    {
        $this->ticketactions->removeElement($ticketaction);
    }

    /**
     * Get ticketactions
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getTicketactions()
    {
        return $this->ticketactions;
    }

    /**
     * Set unit
     *
     * @param \HVG\SystemBundle\Entity\Unit $unit
     *
     * @return Ticket
     */
    public function setUnit(\HVG\SystemBundle\Entity\Unit $unit = null)
    {
        $this->unit = $unit;

        return $this;
    }

    /**
     * Get unit
     *
     * @return \HVG\SystemBundle\Entity\Unit
     */
    public function getUnit()
    {
        return $this->unit;
    }

    /**
     * Get community
     *
     * @return \HVG\SystemBundle\Entity\Community
     */
    public function getCommunity()
    {
        $community = null;
        $unit = $this->getUnit();
        if($unit) $community = $this->unit->getCommunity();
        return $community;
    }

    /**
     * Get unitgroup
     *
     * @return \HVG\SystemBundle\Entity\UnitGroup
     */
    public function getUnitGroup()
    {
        $unitgroup = null;
        $unit = $this->getUnit();
        if($unit) $unitgroup = $this->unit->getUnitGroup();
        return $unitgroup;
    }

    /**
     * Set ticketstatus
     *
     * @param \HVG\SystemBundle\Entity\TicketStatus $ticketstatus
     *
     * @return Ticket
     */
    public function setTicketstatus(\HVG\SystemBundle\Entity\TicketStatus $ticketstatus = null)
    {
        $this->ticketstatus = $ticketstatus;

        return $this;
    }

    /**
     * Get ticketstatus
     *
     * @return \HVG\SystemBundle\Entity\TicketStatus
     */
    public function getTicketstatus()
    {
        return $this->ticketstatus;
    }

    /**
     * Set area
     *
     * @param \HVG\SystemBundle\Entity\Area $area
     *
     * @return Ticket
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
     * Set user
     *
     * @param \HVG\UserBundle\Entity\User $user
     *
     * @return Ticket
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
     * @return Ticket
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

