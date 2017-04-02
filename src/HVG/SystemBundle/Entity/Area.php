<?php

namespace HVG\SystemBundle\Entity;

/**
 * Area
 */
class Area
{
    /**
     * @var integer
     */
    private $id;

    /**
     * @var string
     */
    private $name;

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
     * @var \Doctrine\Common\Collections\Collection
     */
    private $petitions;

    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $agents;

    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $tickets;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->petitions = new \Doctrine\Common\Collections\ArrayCollection();
        $this->agents = new \Doctrine\Common\Collections\ArrayCollection();
        $this->tickets = new \Doctrine\Common\Collections\ArrayCollection();
    }

    public function __toString()
    {
        return $this->name;
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
     * Set name
     *
     * @param string $name
     *
     * @return Area
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set description
     *
     * @param string $description
     *
     * @return Area
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
     * @return Area
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
     * @return Area
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
     * @return Area
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
     * Add petition
     *
     * @param \HVG\SystemBundle\Entity\Petition $petition
     *
     * @return Area
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
     * Add agent
     *
     * @param \HVG\SystemBundle\Entity\Agent $agent
     *
     * @return Area
     */
    public function addAgent(\HVG\SystemBundle\Entity\Agent $agent)
    {
        $this->agents[] = $agent;

        return $this;
    }

    /**
     * Remove agent
     *
     * @param \HVG\SystemBundle\Entity\Agent $agent
     */
    public function removeAgent(\HVG\SystemBundle\Entity\Agent $agent)
    {
        $this->agents->removeElement($agent);
    }

    /**
     * Get agents
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getAgents()
    {
        return $this->agents;
    }

    /**
     * Add ticket
     *
     * @param \HVG\SystemBundle\Entity\Ticket $ticket
     *
     * @return Area
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
}

