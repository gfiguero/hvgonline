<?php

namespace HVG\SystemBundle\Entity;

/**
 * TicketAction
 */
class TicketAction
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
     * @var \HVG\SystemBundle\Entity\Ticket
     */
    private $project;


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
     * @return TicketAction
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
     * @return TicketAction
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
     * @return TicketAction
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
     * @return TicketAction
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
     * Set project
     *
     * @param \HVG\SystemBundle\Entity\Ticket $project
     *
     * @return TicketAction
     */
    public function setProject(\HVG\SystemBundle\Entity\Ticket $project = null)
    {
        $this->project = $project;

        return $this;
    }

    /**
     * Get project
     *
     * @return \HVG\SystemBundle\Entity\Ticket
     */
    public function getProject()
    {
        return $this->project;
    }
    /**
     * @var string
     */
    private $file;

    /**
     * @var \HVG\SystemBundle\Entity\Ticket
     */
    private $ticket;


    /**
     * Set file
     *
     * @param string $file
     *
     * @return TicketAction
     */
    public function setFile($file)
    {
        $this->file = $file;

        return $this;
    }

    /**
     * Get file
     *
     * @return string
     */
    public function getFile()
    {
        return $this->file;
    }

    /**
     * Set ticket
     *
     * @param \HVG\SystemBundle\Entity\Ticket $ticket
     *
     * @return TicketAction
     */
    public function setTicket(\HVG\SystemBundle\Entity\Ticket $ticket = null)
    {
        $this->ticket = $ticket;

        return $this;
    }

    /**
     * Get ticket
     *
     * @return \HVG\SystemBundle\Entity\Ticket
     */
    public function getTicket()
    {
        return $this->ticket;
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
     * Get unit
     *
     * @return \HVG\SystemBundle\Entity\Unit
     */
    public function getUnit()
    {
        $unit = null;
        $ticket = $this->getTicket();
        if($ticket) $unit = $ticket->getUnit();
        return $unit;
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
     * @return TicketAction
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
}
