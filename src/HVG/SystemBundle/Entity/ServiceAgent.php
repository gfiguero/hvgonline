<?php

namespace HVG\SystemBundle\Entity;

/**
 * ServiceAgent
 */
class ServiceAgent
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
    private $servicelogs;

    /**
     * @var \HVG\SystemBundle\Entity\Community
     */
    private $community;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->servicelogs = new \Doctrine\Common\Collections\ArrayCollection();
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
     * @return ServiceAgent
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
     * Add servicelog
     *
     * @param \HVG\SystemBundle\Entity\ServiceLog $servicelog
     *
     * @return ServiceAgent
     */
    public function addServicelog(\HVG\SystemBundle\Entity\ServiceLog $servicelog)
    {
        $this->servicelogs[] = $servicelog;

        return $this;
    }

    /**
     * Remove servicelog
     *
     * @param \HVG\SystemBundle\Entity\ServiceLog $servicelog
     */
    public function removeServicelog(\HVG\SystemBundle\Entity\ServiceLog $servicelog)
    {
        $this->servicelogs->removeElement($servicelog);
    }

    /**
     * Get servicelogs
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getServicelogs()
    {
        return $this->servicelogs;
    }

    /**
     * Set community
     *
     * @param \HVG\SystemBundle\Entity\Community $community
     *
     * @return ServiceAgent
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
}

