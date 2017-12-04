<?php

namespace HVG\SystemBundle\Entity;

/**
 * CommunityEvent
 */
class CommunityEvent
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
    private $startedAt;

    /**
     * @var \DateTime
     */
    private $finnishedAt;

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
     * @var \HVG\SystemBundle\Entity\Community
     */
    private $community;


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
     * @return CommunityEvent
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
     * Set startedAt
     *
     * @param \DateTime $startedAt
     *
     * @return CommunityEvent
     */
    public function setStartedAt($startedAt)
    {
        $this->startedAt = $startedAt;

        return $this;
    }

    /**
     * Get startedAt
     *
     * @return \DateTime
     */
    public function getStartedAt()
    {
        return $this->startedAt;
    }

    /**
     * Set finnishedAt
     *
     * @param \DateTime $finnishedAt
     *
     * @return CommunityEvent
     */
    public function setFinnishedAt($finnishedAt)
    {
        $this->finnishedAt = $finnishedAt;

        return $this;
    }

    /**
     * Get finnishedAt
     *
     * @return \DateTime
     */
    public function getFinnishedAt()
    {
        return $this->finnishedAt;
    }

    /**
     * Set createdAt
     *
     * @param \DateTime $createdAt
     *
     * @return CommunityEvent
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
     * @return CommunityEvent
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
     * @return CommunityEvent
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
     * Set community
     *
     * @param \HVG\SystemBundle\Entity\Community $community
     *
     * @return CommunityEvent
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
    private $units;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->units = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add unit
     *
     * @param \HVG\SystemBundle\Entity\Unit $unit
     *
     * @return CommunityEvent
     */
    public function addUnit(\HVG\SystemBundle\Entity\Unit $unit)
    {
        $this->units[] = $unit;

        return $this;
    }

    /**
     * Remove unit
     *
     * @param \HVG\SystemBundle\Entity\Unit $unit
     */
    public function removeUnit(\HVG\SystemBundle\Entity\Unit $unit)
    {
        $this->units->removeElement($unit);
    }

    /**
     * Get units
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getUnits()
    {
        return $this->units;
    }
}
