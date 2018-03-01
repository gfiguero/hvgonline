<?php

namespace HVG\SystemBundle\Entity;

/**
 * AccessGuard
 */
class AccessGuard
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
     * @var \Doctrine\Common\Collections\Collection
     */
    private $guests;

    /**
     * @var \HVG\SystemBundle\Entity\Community
     */
    private $community;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->guests = new \Doctrine\Common\Collections\ArrayCollection();
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
     * @return AccessGuard
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
     * Add guest
     *
     * @param \HVG\SystemBundle\Entity\Guest $guest
     *
     * @return AccessGuard
     */
    public function addGuest(\HVG\SystemBundle\Entity\Guest $guest)
    {
        $this->guests[] = $guest;

        return $this;
    }

    /**
     * Remove guest
     *
     * @param \HVG\SystemBundle\Entity\Guest $guest
     */
    public function removeGuest(\HVG\SystemBundle\Entity\Guest $guest)
    {
        $this->guests->removeElement($guest);
    }

    /**
     * Get guests
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getGuests()
    {
        return $this->guests;
    }

    /**
     * Set community
     *
     * @param \HVG\SystemBundle\Entity\Community $community
     *
     * @return AccessGuard
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
     * @var \Doctrine\Common\Collections\Collection
     */
    private $accesslogs;


    /**
     * Add accesslog
     *
     * @param \HVG\SystemBundle\Entity\AccessLog $accesslog
     *
     * @return AccessGuard
     */
    public function addAccesslog(\HVG\SystemBundle\Entity\AccessLog $accesslog)
    {
        $this->accesslogs[] = $accesslog;

        return $this;
    }

    /**
     * Remove accesslog
     *
     * @param \HVG\SystemBundle\Entity\AccessLog $accesslog
     */
    public function removeAccesslog(\HVG\SystemBundle\Entity\AccessLog $accesslog)
    {
        $this->accesslogs->removeElement($accesslog);
    }

    /**
     * Get accesslogs
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getAccesslogs()
    {
        return $this->accesslogs;
    }
}
