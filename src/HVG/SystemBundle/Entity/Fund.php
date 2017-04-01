<?php

namespace HVG\SystemBundle\Entity;

/**
 * Fund
 */
class Fund
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
    private $inflows;

    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $outflows;

    /**
     * @var \HVG\SystemBundle\Entity\Community
     */
    private $community;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->inflows = new \Doctrine\Common\Collections\ArrayCollection();
        $this->outflows = new \Doctrine\Common\Collections\ArrayCollection();
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
     * @return Fund
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
     * @return Fund
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
     * @return Fund
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
     * @return Fund
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
     * Add inflow
     *
     * @param \HVG\SystemBundle\Entity\Inflow $inflow
     *
     * @return Fund
     */
    public function addInflow(\HVG\SystemBundle\Entity\Inflow $inflow)
    {
        $this->inflows[] = $inflow;

        return $this;
    }

    /**
     * Remove inflow
     *
     * @param \HVG\SystemBundle\Entity\Inflow $inflow
     */
    public function removeInflow(\HVG\SystemBundle\Entity\Inflow $inflow)
    {
        $this->inflows->removeElement($inflow);
    }

    /**
     * Get inflows
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getInflows()
    {
        return $this->inflows;
    }

    /**
     * Add outflow
     *
     * @param \HVG\SystemBundle\Entity\Outflow $outflow
     *
     * @return Fund
     */
    public function addOutflow(\HVG\SystemBundle\Entity\Outflow $outflow)
    {
        $this->outflows[] = $outflow;

        return $this;
    }

    /**
     * Remove outflow
     *
     * @param \HVG\SystemBundle\Entity\Outflow $outflow
     */
    public function removeOutflow(\HVG\SystemBundle\Entity\Outflow $outflow)
    {
        $this->outflows->removeElement($outflow);
    }

    /**
     * Get outflows
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getOutflows()
    {
        return $this->outflows;
    }

    /**
     * Set community
     *
     * @param \HVG\SystemBundle\Entity\Community $community
     *
     * @return Fund
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

