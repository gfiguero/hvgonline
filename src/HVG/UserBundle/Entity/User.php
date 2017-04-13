<?php

namespace HVG\UserBundle\Entity;

use FOS\UserBundle\Model\User as BaseUser;

/**
 * User
 */
class User extends BaseUser
{
    /**
     * @var integer
     */
    protected $id;

    /**
     * @var \HVG\SystemBundle\Entity\Person
     */
    private $person;

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


    public function __construct()
    {
        parent::__construct();
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
     * Set person
     *
     * @param \HVG\SystemBundle\Entity\Person $person
     *
     * @return User
     */
    public function setPerson(\HVG\SystemBundle\Entity\Person $person = null)
    {
        $this->person = $person;

        return $this;
    }

    /**
     * Get person
     *
     * @return \HVG\SystemBundle\Entity\Person
     */
    public function getPerson()
    {
        return $this->person;
    }

    /**
     * Set createdAt
     *
     * @param \DateTime $createdAt
     *
     * @return User
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
     * @return User
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
     * @return User
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
     * @var \Doctrine\Common\Collections\Collection
     */
    private $tickets;

    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $ticket_actions;

    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $petition_actions;

    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $petition_evaluations;

    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $petitions;

    /**
     * @var \HVG\SystemBundle\Entity\Area
     */
    private $area;


    /**
     * Add ticket
     *
     * @param \HVG\SystemBundle\Entity\Ticket $ticket
     *
     * @return User
     */
    public function addTicket(\HVG\SystemBundle\Entity\Ticket $ticket)
    {
        $this->tickets[] = $ticket;

        return $this;
    }

    /**
     * Remove ticket
     *
     * @param \HVG\SystemBundle\Entity\Ticket $ticket
     */
    public function removeTicket(\HVG\SystemBundle\Entity\Ticket $ticket)
    {
        $this->tickets->removeElement($ticket);
    }

    /**
     * Get tickets
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getTickets()
    {
        return $this->tickets;
    }

    /**
     * Add ticketAction
     *
     * @param \HVG\SystemBundle\Entity\TicketAction $ticketAction
     *
     * @return User
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
     * Add petitionAction
     *
     * @param \HVG\SystemBundle\Entity\PetitionAction $petitionAction
     *
     * @return User
     */
    public function addPetitionAction(\HVG\SystemBundle\Entity\PetitionAction $petitionAction)
    {
        $this->petition_actions[] = $petitionAction;

        return $this;
    }

    /**
     * Remove petitionAction
     *
     * @param \HVG\SystemBundle\Entity\PetitionAction $petitionAction
     */
    public function removePetitionAction(\HVG\SystemBundle\Entity\PetitionAction $petitionAction)
    {
        $this->petition_actions->removeElement($petitionAction);
    }

    /**
     * Get petitionActions
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getPetitionActions()
    {
        return $this->petition_actions;
    }

    /**
     * Add petitionEvaluation
     *
     * @param \HVG\SystemBundle\Entity\PetitionEvaluation $petitionEvaluation
     *
     * @return User
     */
    public function addPetitionEvaluation(\HVG\SystemBundle\Entity\PetitionEvaluation $petitionEvaluation)
    {
        $this->petition_evaluations[] = $petitionEvaluation;

        return $this;
    }

    /**
     * Remove petitionEvaluation
     *
     * @param \HVG\SystemBundle\Entity\PetitionEvaluation $petitionEvaluation
     */
    public function removePetitionEvaluation(\HVG\SystemBundle\Entity\PetitionEvaluation $petitionEvaluation)
    {
        $this->petition_evaluations->removeElement($petitionEvaluation);
    }

    /**
     * Get petitionEvaluations
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getPetitionEvaluations()
    {
        return $this->petition_evaluations;
    }

    /**
     * Add petition
     *
     * @param \HVG\SystemBundle\Entity\Petition $petition
     *
     * @return User
     */
    public function addPetition(\HVG\SystemBundle\Entity\Petition $petition)
    {
        $this->petitions[] = $petition;

        return $this;
    }

    /**
     * Remove petition
     *
     * @param \HVG\SystemBundle\Entity\Petition $petition
     */
    public function removePetition(\HVG\SystemBundle\Entity\Petition $petition)
    {
        $this->petitions->removeElement($petition);
    }

    /**
     * Get petitions
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getPetitions()
    {
        return $this->petitions;
    }

    /**
     * Set area
     *
     * @param \HVG\SystemBundle\Entity\Area $area
     *
     * @return User
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
}
