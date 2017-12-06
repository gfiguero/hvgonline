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

    public function getRoles()
    {
        return parent::getRoles();
    }

    public function setRoles(array $roles)
    {
        parent::setRoles($roles);
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
     * Get name
     *
     * @return string
     */
    public function getPersonUsername()
    {
        return $this->person . ' (' . $this->username . ')';
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
    private $ticketactions;

    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $petitionactions;

    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $petitionevaluations;

    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $petitions;

    /**
     * @var \HVG\SystemBundle\Entity\Area
     */
    private $areas;


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
        $this->ticketactions[] = $ticketAction;

        return $this;
    }

    /**
     * Remove ticketAction
     *
     * @param \HVG\SystemBundle\Entity\TicketAction $ticketAction
     */
    public function removeTicketAction(\HVG\SystemBundle\Entity\TicketAction $ticketAction)
    {
        $this->ticketactions->removeElement($ticketAction);
    }

    /**
     * Get ticketActions
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getTicketActions()
    {
        return $this->ticketactions;
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
     * @return User
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
     * Add area
     *
     * @param \HVG\SystemBundle\Entity\Area $area
     *
     * @return User
     */
    public function addArea(\HVG\SystemBundle\Entity\Area $area)
    {
        $this->areas[] = $area;

        return $this;
    }

    /**
     * Remove area
     *
     * @param \HVG\SystemBundle\Entity\Area $area
     */
    public function removeArea(\HVG\SystemBundle\Entity\Area $area)
    {
        $this->areas->removeElement($area);
    }

    /**
     * Get areas
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getAreas()
    {
        return $this->areas;
    }
    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $communities;


    /**
     * Add community
     *
     * @param \HVG\SystemBundle\Entity\Community $community
     *
     * @return User
     */
    public function addCommunity(\HVG\SystemBundle\Entity\Community $community)
    {
        $this->communities[] = $community;

        return $this;
    }

    /**
     * Remove community
     *
     * @param \HVG\SystemBundle\Entity\Community $community
     */
    public function removeCommunity(\HVG\SystemBundle\Entity\Community $community)
    {
        $this->communities->removeElement($community);
    }

    /**
     * Get communities
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getCommunities()
    {
        return $this->communities;
    }

    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $petitionsassigned;


    /**
     * Add petitionsassigned
     *
     * @param \HVG\SystemBundle\Entity\Petition $petitionsassigned
     *
     * @return User
     */
    public function addPetitionsassigned(\HVG\SystemBundle\Entity\Petition $petitionsassigned)
    {
        $this->petitionsassigned[] = $petitionsassigned;

        return $this;
    }

    /**
     * Remove petitionsassigned
     *
     * @param \HVG\SystemBundle\Entity\Petition $petitionsassigned
     */
    public function removePetitionsassigned(\HVG\SystemBundle\Entity\Petition $petitionsassigned)
    {
        $this->petitionsassigned->removeElement($petitionsassigned);
    }

    /**
     * Get petitionsassigned
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getPetitionsassigned()
    {
        return $this->petitionsassigned;
    }


    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $ticketsassigned;


    /**
     * Add ticketsassigned
     *
     * @param \HVG\SystemBundle\Entity\Ticket $ticketsassigned
     *
     * @return User
     */
    public function addTicketsassigned(\HVG\SystemBundle\Entity\Ticket $ticketsassigned)
    {
        $this->ticketsassigned[] = $ticketsassigned;

        return $this;
    }

    /**
     * Remove ticketsassigned
     *
     * @param \HVG\SystemBundle\Entity\Ticket $ticketsassigned
     */
    public function removeTicketsassigned(\HVG\SystemBundle\Entity\Ticket $ticketsassigned)
    {
        $this->ticketsassigned->removeElement($ticketsassigned);
    }

    /**
     * Get ticketsassigned
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getTicketsassigned()
    {
        return $this->ticketsassigned;
    }
    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $zones;


    /**
     * Add zone
     *
     * @param \HVG\SystemBundle\Entity\Zone $zone
     *
     * @return User
     */
    public function addZone(\HVG\SystemBundle\Entity\Zone $zone)
    {
        $this->zones[] = $zone;

        return $this;
    }

    /**
     * Remove zone
     *
     * @param \HVG\SystemBundle\Entity\Zone $zone
     */
    public function removeZone(\HVG\SystemBundle\Entity\Zone $zone)
    {
        $this->zones->removeElement($zone);
    }

    /**
     * Get zones
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getZones()
    {
        return $this->zones;
    }
}
