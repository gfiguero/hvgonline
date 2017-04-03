<?php

namespace HVG\SystemBundle\Entity;

/**
 * Provider
 */
class Provider
{
    /**
     * @var integer
     */
    private $id;

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
     * @var \HVG\SystemBundle\Entity\Person
     */
    private $person;

    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $person_provider;

    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $bank_accounts;

    /**
     * @var \HVG\SystemBundle\Entity\Service
     */
    private $service;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->person_provider = new \Doctrine\Common\Collections\ArrayCollection();
        $this->bank_accounts = new \Doctrine\Common\Collections\ArrayCollection();
    }

    public function __toString()
    {
        return $this->person->getName();
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
     * Set createdAt
     *
     * @param \DateTime $createdAt
     *
     * @return Provider
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
     * @return Provider
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
     * @return Provider
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
     * Set person
     *
     * @param \HVG\SystemBundle\Entity\Person $person
     *
     * @return Provider
     */
    public function setPerson(\HVG\SystemBundle\Entity\Person $person = null)
    {
        $this->person = $person;

        return $this;
    }

    /**
     * Get person
     *
     * @return \HVG\SystemBundle\Entity\Person
     */
    public function getPerson()
    {
        return $this->person;
    }

    /**
     * Add personProvider
     *
     * @param \HVG\SystemBundle\Entity\PersonProvider $personProvider
     *
     * @return Provider
     */
    public function addPersonProvider(\HVG\SystemBundle\Entity\PersonProvider $personProvider)
    {
        $this->person_provider[] = $personProvider;

        return $this;
    }

    /**
     * Remove personProvider
     *
     * @param \HVG\SystemBundle\Entity\PersonProvider $personProvider
     */
    public function removePersonProvider(\HVG\SystemBundle\Entity\PersonProvider $personProvider)
    {
        $this->person_provider->removeElement($personProvider);
    }

    /**
     * Get personProvider
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getPersonProvider()
    {
        return $this->person_provider;
    }

    /**
     * Add bankAccount
     *
     * @param \HVG\SystemBundle\Entity\BankAccount $bankAccount
     *
     * @return Provider
     */
    public function addBankAccount(\HVG\SystemBundle\Entity\BankAccount $bankAccount)
    {
        $this->bank_accounts[] = $bankAccount;

        return $this;
    }

    /**
     * Remove bankAccount
     *
     * @param \HVG\SystemBundle\Entity\BankAccount $bankAccount
     */
    public function removeBankAccount(\HVG\SystemBundle\Entity\BankAccount $bankAccount)
    {
        $this->bank_accounts->removeElement($bankAccount);
    }

    /**
     * Get bankAccounts
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getBankAccounts()
    {
        return $this->bank_accounts;
    }

    /**
     * Set service
     *
     * @param \HVG\SystemBundle\Entity\Service $service
     *
     * @return Provider
     */
    public function setService(\HVG\SystemBundle\Entity\Service $service = null)
    {
        $this->service = $service;

        return $this;
    }

    /**
     * Get service
     *
     * @return \HVG\SystemBundle\Entity\Service
     */
    public function getService()
    {
        return $this->service;
    }
}

