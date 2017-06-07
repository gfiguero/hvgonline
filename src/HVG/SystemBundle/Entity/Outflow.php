<?php

namespace HVG\SystemBundle\Entity;

/**
 * Outflow
 */
class Outflow
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
     * @var \HVG\SystemBundle\Entity\Fund
     */
    private $fund;

    /**
     * @var \HVG\SystemBundle\Entity\Expenditure
     */
    private $expenditure;


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
     * @return Outflow
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
     * @return Outflow
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
     * @return Outflow
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
     * @return Outflow
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
     * Set fund
     *
     * @param \HVG\SystemBundle\Entity\Fund $fund
     *
     * @return Outflow
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

    /**
     * Set expenditure
     *
     * @param \HVG\SystemBundle\Entity\Expenditure $expenditure
     *
     * @return Outflow
     */
    public function setExpenditure(\HVG\SystemBundle\Entity\Expenditure $expenditure = null)
    {
        $this->expenditure = $expenditure;

        return $this;
    }

    /**
     * Get expenditure
     *
     * @return \HVG\SystemBundle\Entity\Expenditure
     */
    public function getExpenditure()
    {
        return $this->expenditure;
    }
    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $expenditures;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->expenditures = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add expenditure
     *
     * @param \HVG\SystemBundle\Entity\Expenditure $expenditure
     *
     * @return Outflow
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
}
