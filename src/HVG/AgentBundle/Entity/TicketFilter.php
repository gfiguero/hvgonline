<?php

namespace HVG\AgentBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 */
class TicketFilter
{
    /**
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @var \HVG\SystemBundle\Entity\Community
     * @ORM\ManyToOne(targetEntity="\HVG\SystemBundle\Entity\Community", cascade={"merge"})
     */
    private $community;

    /**
     * @var \HVG\SystemBundle\Entity\UnitGroup
     * @ORM\ManyToOne(targetEntity="\HVG\SystemBundle\Entity\UnitGroup", cascade={"merge"})
     */
    private $unitgroup;

    /**
     * @var \HVG\SystemBundle\Entity\Unit
     * @ORM\ManyToOne(targetEntity="\HVG\SystemBundle\Entity\Unit", cascade={"merge"})
     */
    private $unit;

    /**
     * @var \HVG\UserBundle\Entity\User
     */
    private $user;

    /**
     * @var \HVG\SystemBundle\Entity\Person
     */
    private $person;

    public function setCommunity(\HVG\SystemBundle\Entity\Community $community = null)
    {
        $this->community = $community;

        return $this;
    }

    public function setUnitGroup(\HVG\SystemBundle\Entity\UnitGroup $unitgroup = null)
    {
        $this->unitgroup = $unitgroup;

        return $this;
    }

    public function setUnit(\HVG\SystemBundle\Entity\Unit $unit = null)
    {
        $this->unit = $unit;

        return $this;
    }

    public function setUser(\HVG\UserBundle\Entity\User $user = null)
    {
        $this->user = $user;

        return $this;
    }

    public function setPerson(\HVG\SystemBundle\Entity\Person $person = null)
    {
        $this->person = $person;

        return $this;
    }

    public function getCommunity()
    {
        return $this->community;
    }

    public function getUnitGroup()
    {
        return $this->unitgroup;
    }

    public function getUnit()
    {
        return $this->unit;
    }

    public function getUser()
    {
        return $this->user;
    }

    public function getPerson()
    {
        return $this->person;
    }

}
