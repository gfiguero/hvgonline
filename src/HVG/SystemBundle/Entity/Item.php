<?php

namespace HVG\SystemBundle\Entity;

/**
 * Item
 */
class Item
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
    private $expenditures;

    /**
     * @var \HVG\SystemBundle\Entity\Fund
     */
    private $fund;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->expenditures = new \Doctrine\Common\Collections\ArrayCollection();
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
     * @return Item
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
     * @return Item
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
     * @return Item
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
     * @return Item
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
     * Add expenditure
     *
     * @param \HVG\SystemBundle\Entity\Expenditure $expenditure
     *
     * @return Item
     */
    public function addExpenditure(\HVG\SystemBundle\Entity\Expenditure $expenditure)
    {
        $this->expenditures[] = $expenditure;

        return $this;
    }

    /**
     * Remove expenditure
     *
     * @param \HVG\SystemBundle\Entity\Expenditure $expenditure
     */
    public function removeExpenditure(\HVG\SystemBundle\Entity\Expenditure $expenditure)
    {
        $this->expenditures->removeElement($expenditure);
    }

    /**
     * Get expenditures
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getExpenditures()
    {
        return $this->expenditures;
    }

    /**
     * Set fund
     *
     * @param \HVG\SystemBundle\Entity\Fund $fund
     *
     * @return Item
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

