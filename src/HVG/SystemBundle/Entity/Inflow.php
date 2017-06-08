<?php

namespace HVG\SystemBundle\Entity;

/**
 * Inflow
 */
class Inflow
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
     * @var \HVG\SystemBundle\Entity\Allowance
     */
    private $allowance;

    /**
     * @var \HVG\SystemBundle\Entity\Fund
     */
    private $fund;


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
     * @return Inflow
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
     * @return Inflow
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
     * @return Inflow
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
     * @return Inflow
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
     * Set allowance
     *
     * @param \HVG\SystemBundle\Entity\Allowance $allowance
     *
     * @return Inflow
     */
    public function setAllowance(\HVG\SystemBundle\Entity\Allowance $allowance = null)
    {
        $this->allowance = $allowance;

        return $this;
    }

    /**
     * Get allowance
     *
     * @return \HVG\SystemBundle\Entity\Allowance
     */
    public function getAllowance()
    {
        return $this->allowance;
    }

    /**
     * Set fund
     *
     * @param \HVG\SystemBundle\Entity\Fund $fund
     *
     * @return Inflow
     */
    public function setFund(\HVG\SystemBundle\Entity\Fund $fund = null)
    {
        $this->fund = $fund;

        return $this;
    }

    /**
     * Get fund
     *
     * @return \HVG\SystemBundle\Entity\Fund
     */
    public function getFund()
    {
        return $this->fund;
    }
}

