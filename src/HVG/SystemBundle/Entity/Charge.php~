<?php

namespace HVG\SystemBundle\Entity;

/**
 * Charge
 */
class Charge
{
    /**
     * @var integer
     */
    private $id;

    /**
     * @var integer
     */
    private $amount;

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
    private $allowancecharge;

    /**
     * @var \HVG\SystemBundle\Entity\Unit
     */
    private $unit;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->allowancecharge = new \Doctrine\Common\Collections\ArrayCollection();
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
     * Set amount
     *
     * @param integer $amount
     *
     * @return Charge
     */
    public function setAmount($amount)
    {
        $this->amount = $amount;

        return $this;
    }

    /**
     * Get amount
     *
     * @return integer
     */
    public function getAmount()
    {
        return $this->amount;
    }

    /**
     * Set createdAt
     *
     * @param \DateTime $createdAt
     *
     * @return Charge
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
     * @return Charge
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
     * @return Charge
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
     * Add allowancecharge
     *
     * @param \HVG\SystemBundle\Entity\AllowanceCharge $allowancecharge
     *
     * @return Charge
     */
    public function addAllowancecharge(\HVG\SystemBundle\Entity\AllowanceCharge $allowancecharge)
    {
        $this->allowancecharge[] = $allowancecharge;

        return $this;
    }

    /**
     * Remove allowancecharge
     *
     * @param \HVG\SystemBundle\Entity\AllowanceCharge $allowancecharge
     */
    public function removeAllowancecharge(\HVG\SystemBundle\Entity\AllowanceCharge $allowancecharge)
    {
        $this->allowancecharge->removeElement($allowancecharge);
    }

    /**
     * Get allowancecharge
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getAllowancecharge()
    {
        return $this->allowancecharge;
    }

    /**
     * Set unit
     *
     * @param \HVG\SystemBundle\Entity\Unit $unit
     *
     * @return Charge
     */
    public function setUnit(\HVG\SystemBundle\Entity\Unit $unit = null)
    {
        $this->unit = $unit;

        return $this;
    }

    /**
     * Get unit
     *
     * @return \HVG\SystemBundle\Entity\Unit
     */
    public function getUnit()
    {
        return $this->unit;
    }
}

