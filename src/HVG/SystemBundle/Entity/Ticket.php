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
    private $contact_name;

    /**
     * @var string
     */
    private $contact_phone;

    /**
     * @var string
     */
    private $contact_email;

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
     * Constructor
     */
    public function __construct()
    {
        $this->actions = new \Doctrine\Common\Collections\ArrayCollection();
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
     * Get name
     *
     * @return integer
     */
    public function getName()
    {
        return (string) $this->id;
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
        $this->contact_name = $contactName;

        return $this;
    }

    /**
     * Get contactName
     *
     * @return string
     */
    public function getContactName()
    {
        return $this->contact_name;
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
        $this->contact_phone = $contactPhone;

        return $this;
    }

    /**
     * Get contactPhone
     *
     * @return string
     */
    public function getContactPhone()
    {
        return $this->contact_phone;
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
        $this->contact_email = $contactEmail;

        return $this;
    }

    /**
     * Get contactEmail
     *
     * @return string
     */
    public function getContactEmail()
    {
        return $this->contact_email;
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
     * Get community
     *
     * @return \HVG\SystemBundle\Entity\Community
     */
    public function getCommunity()
    {
        $community = null;
        $unitgroup = $this->getUnitGroup();
        if($unitgroup) $community = $unitgroup->getCommunity();
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
        if($unit) $unitgroup = $unit->getUnitGroup();
        return $unitgroup;
    }

    /**
     * @var string
     */
    private $description;

    /**
     * @var \HVG\SystemBundle\Entity\Unit
     */
    private $unit;

    /**
     * @var \HVG\SystemBundle\Entity\Area
     */
    private $area;


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
     * @var \Doctrine\Common\Collections\Collection
     */
    private $ticket_actions;

    /**
     * @var \HVG\SystemBundle\Entity\TicketStatus
     */
    private $ticket_status;


    /**
     * Add ticketAction
     *
     * @param \HVG\SystemBundle\Entity\TicketAction $ticketAction
     *
     * @return Ticket
     */
    public function addTicketAction(\HVG\SystemBundle\Entity\TicketAction $ticketAction)
    {
        $this->ticket_actions[] = $ticketAction;

        return $this;
    }

    /**
     * Remove ticketAction
     *
     * @param \HVG\SystemBundle\Entity\TicketAction $ticketAction
     */
    public function removeTicketAction(\HVG\SystemBundle\Entity\TicketAction $ticketAction)
    {
        $this->ticket_actions->removeElement($ticketAction);
    }

    /**
     * Get ticketActions
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getTicketActions()
    {
        return $this->ticket_actions;
    }

    /**
     * Set ticketStatus
     *
     * @param \HVG\SystemBundle\Entity\TicketStatus $ticketStatus
     *
     * @return Ticket
     */
    public function setTicketStatus(\HVG\SystemBundle\Entity\TicketStatus $ticketStatus = null)
    {
        $this->ticket_status = $ticketStatus;

        return $this;
    }

    /**
     * Get ticketStatus
     *
     * @return \HVG\SystemBundle\Entity\TicketStatus
     */
    public function getTicketStatus()
    {
        return $this->ticket_status;
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
     * @var \Doctrine\Common\Collections\Collection
     */
    private $ticketactions;

    /**
     * @var \HVG\SystemBundle\Entity\TicketStatus
     */
    private $ticketstatus;


}
