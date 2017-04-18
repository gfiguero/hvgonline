<?php

namespace HVG\SystemBundle\Entity;

/**
 * Unit
 */
class Unit
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
    private $allowances;

    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $charges;

    /**
     * @var \HVG\SystemBundle\Entity\Person
     */
    private $owner;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->allowances = new \Doctrine\Common\Collections\ArrayCollection();
        $this->charges = new \Doctrine\Common\Collections\ArrayCollection();
    }

    public function __toString()
    {
        return $this->unitgroup . ' - ' . $this->name;
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
     * @return Unit
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
     * Set createdAt
     *
     * @param \DateTime $createdAt
     *
     * @return Unit
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
     * @return Unit
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
     * @return Unit
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
     * Add allowance
     *
     * @param \HVG\SystemBundle\Entity\Allowance $allowance
     *
     * @return Unit
     */
    public function addAllowance(\HVG\SystemBundle\Entity\Allowance $allowance)
    {
        $this->allowances[] = $allowance;

        return $this;
    }

    /**
     * Remove allowance
     *
     * @param \HVG\SystemBundle\Entity\Allowance $allowance
     */
    public function removeAllowance(\HVG\SystemBundle\Entity\Allowance $allowance)
    {
        $this->allowances->removeElement($allowance);
    }

    /**
     * Get allowances
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getAllowances()
    {
        return $this->allowances;
    }

    /**
     * Add charge
     *
     * @param \HVG\SystemBundle\Entity\Charge $charge
     *
     * @return Unit
     */
    public function addCharge(\HVG\SystemBundle\Entity\Charge $charge)
    {
        $this->charges[] = $charge;

        return $this;
    }

    /**
     * Remove charge
     *
     * @param \HVG\SystemBundle\Entity\Charge $charge
     */
    public function removeCharge(\HVG\SystemBundle\Entity\Charge $charge)
    {
        $this->charges->removeElement($charge);
    }

    /**
     * Get charges
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getCharges()
    {
        return $this->charges;
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
     * Set owner
     *
     * @param \HVG\SystemBundle\Entity\Person $owner
     *
     * @return Unit
     */
    public function setOwner(\HVG\SystemBundle\Entity\Person $owner = null)
    {
        $this->owner = $owner;

        return $this;
    }

    /**
     * Get owner
     *
     * @return \HVG\SystemBundle\Entity\Person
     */
    public function getOwner()
    {
        return $this->owner;
    }
    /**
     * @var \HVG\SystemBundle\Entity\UnitGroup
     */
    private $unitgroup;


    /**
     * Set unitgroup
     *
     * @param \HVG\SystemBundle\Entity\UnitGroup $unitgroup
     *
     * @return Unit
     */
    public function setUnitGroup(\HVG\SystemBundle\Entity\UnitGroup $unitgroup = null)
    {
        $this->unitgroup = $unitgroup;

        return $this;
    }

    /**
     * Get unitgroup
     *
     * @return \HVG\SystemBundle\Entity\UnitGroup
     */
    public function getUnitGroup()
    {
        return $this->unitgroup;
    }
    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $tickets;


    /**
     * Add ticket
     *
     * @param \HVG\SystemBundle\Entity\Ticket $ticket
     *
     * @return Unit
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
     * @var \HVG\SystemBundle\Entity\UnitGroup
     */
    private $unit_group;

    /**
     * @var \HVG\SystemBundle\Entity\Community
     */
    private $community;


    /**
     * Set community
     *
     * @param \HVG\SystemBundle\Entity\Community $community
     *
     * @return Unit
     */
    public function setCommunity(\HVG\SystemBundle\Entity\Community $community = null)
    {
        $this->community = $community;

        return $this;
    }
}
