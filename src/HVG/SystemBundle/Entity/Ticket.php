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
    private $issue;

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
     * @var \Doctrine\Common\Collections\Collection
     */
    private $actions;

    /**
     * @var \HVG\SystemBundle\Entity\Community
     */
    private $community;

    /**
     * @var \HVG\SystemBundle\Entity\TicketStatus
     */
    private $status;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->actions = new \Doctrine\Common\Collections\ArrayCollection();
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
     * Set issue
     *
     * @param string $issue
     *
     * @return Ticket
     */
    public function setIssue($issue)
    {
        $this->issue = $issue;

        return $this;
    }

    /**
     * Get issue
     *
     * @return string
     */
    public function getIssue()
    {
        return $this->issue;
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
     * Add action
     *
     * @param \HVG\SystemBundle\Entity\TicketAction $action
     *
     * @return Ticket
     */
    public function addAction(\HVG\SystemBundle\Entity\TicketAction $action)
    {
        $this->actions[] = $action;

        return $this;
    }

    /**
     * Remove action
     *
     * @param \HVG\SystemBundle\Entity\TicketAction $action
     */
    public function removeAction(\HVG\SystemBundle\Entity\TicketAction $action)
    {
        $this->actions->removeElement($action);
    }

    /**
     * Get actions
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getActions()
    {
        return $this->actions;
    }

    /**
     * Set community
     *
     * @param \HVG\SystemBundle\Entity\Community $community
     *
     * @return Ticket
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
     * Set status
     *
     * @param \HVG\SystemBundle\Entity\TicketStatus $status
     *
     * @return Ticket
     */
    public function setStatus(\HVG\SystemBundle\Entity\TicketStatus $status = null)
    {
        $this->status = $status;

        return $this;
    }

    /**
     * Get status
     *
     * @return \HVG\SystemBundle\Entity\TicketStatus
     */
    public function getStatus()
    {
        return $this->status;
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
     * @var \HVG\SystemBundle\Entity\Agent
     */
    private $agent;


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
     * Set agent
     *
     * @param \HVG\SystemBundle\Entity\Agent $agent
     *
     * @return Ticket
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
}
