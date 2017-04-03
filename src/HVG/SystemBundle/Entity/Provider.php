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
     * @var string
     */
    private $name;

    /**
     * @var string
     */
    private $rut;

    /**
     * @var string
     */
    private $contact_phone;

    /**
     * @var string
     */
    private $contact_email;

    /**
     * @var string
     */
    private $contact_name;

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
     * @var \HVG\SystemBundle\Entity\Service
     */
    private $service;
    
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
     * Set name
     *
     * @param string $name
     *
     * @return Provider
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
     * Set rut
     *
     * @param string $rut
     *
     * @return Provider
     */
    public function setRut($rut)
    {
        $this->rut = $rut;

        return $this;
    }

    /**
     * Get rut
     *
     * @return string
     */
    public function getRut()
    {
        return $this->rut;
    }

    /**
     * Set contactPhone
     *
     * @param string $contactPhone
     *
     * @return Provider
     */
    public function setContactPhone($contactPhone)
    {
        $this->contact_phone = $contactPhone;

        return $this;
    }

    /**
     * Get contactPhone
     *
     * @return string
     */
    public function getContactPhone()
    {
        return $this->contact_phone;
    }

    /**
     * Set contactEmail
     *
     * @param string $contactEmail
     *
     * @return Provider
     */
    public function setContactEmail($contactEmail)
    {
        $this->contact_email = $contactEmail;

        return $this;
    }

    /**
     * Get contactEmail
     *
     * @return string
     */
    public function getContactEmail()
    {
        return $this->contact_email;
    }

    /**
     * Set contactName
     *
     * @param string $contactName
     *
     * @return Provider
     */
    public function setContactName($contactName)
    {
        $this->contact_name = $contactName;

        return $this;
    }

    /**
     * Get contactName
     *
     * @return string
     */
    public function getContactName()
    {
        return $this->contact_name;
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
    /**
     * @var \HVG\SystemBundle\Entity\Person
     */
    private $person;


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
     * @var \HVG\SystemBundle\Entity\PersonProvider
     */
    private $person_provider;


    /**
     * Set personProvider
     *
     * @param \HVG\SystemBundle\Entity\PersonProvider $personProvider
     *
     * @return Provider
     */
    public function setPersonProvider(\HVG\SystemBundle\Entity\PersonProvider $personProvider = null)
    {
        $this->person_provider = $personProvider;

        return $this;
    }

    /**
     * Get personProvider
     *
     * @return \HVG\SystemBundle\Entity\PersonProvider
     */
    public function getPersonProvider()
    {
        return $this->person_provider;
    }
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->person_provider = new \Doctrine\Common\Collections\ArrayCollection();
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
     * @var \Doctrine\Common\Collections\Collection
     */
    private $bank_accounts;


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
}
