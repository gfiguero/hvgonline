<?php

namespace HVG\SystemBundle\Entity;

/**
 * Person
 */
class Person
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

    public function __toString()
    {
        return (string) $this->name;
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
     * @return Person
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
     * @return Person
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
     * @return Person
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
     * @return Person
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
     * Set createdAt
     *
     * @param \DateTime $createdAt
     *
     * @return Person
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
     * @return Person
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
     * @return Person
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
     * @var string
     */
    private $contact_address;


    /**
     * Set contactAddress
     *
     * @param string $contactAddress
     *
     * @return Person
     */
    public function setContactAddress($contactAddress)
    {
        $this->contact_address = $contactAddress;

        return $this;
    }

    /**
     * Get contactAddress
     *
     * @return string
     */
    public function getContactAddress()
    {
        return $this->contact_address;
    }
    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $contacts_person;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->contacts_person = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add contactsPerson
     *
     * @param \HVG\SystemBundle\Entity\ContactPerson $contactsPerson
     *
     * @return Person
     */
    public function addContactsPerson(\HVG\SystemBundle\Entity\ContactPerson $contactsPerson)
    {
        $this->contacts_person[] = $contactsPerson;

        return $this;
    }

    /**
     * Remove contactsPerson
     *
     * @param \HVG\SystemBundle\Entity\ContactPerson $contactsPerson
     */
    public function removeContactsPerson(\HVG\SystemBundle\Entity\ContactPerson $contactsPerson)
    {
        $this->contacts_person->removeElement($contactsPerson);
    }

    /**
     * Get contactsPerson
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getContactsPerson()
    {
        return $this->contacts_person;
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
     * @return Person
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
     * Add personProvider
     *
     * @param \HVG\SystemBundle\Entity\PersonProvider $personProvider
     *
     * @return Person
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
    private $contacts;


    /**
     * Add contact
     *
     * @param \HVG\SystemBundle\Entity\Contact $contact
     *
     * @return Person
     */
    public function addContact(\HVG\SystemBundle\Entity\Contact $contact)
    {
        $this->contacts[] = $contact;

        return $this;
    }

    /**
     * Remove contact
     *
     * @param \HVG\SystemBundle\Entity\Contact $contact
     */
    public function removeContact(\HVG\SystemBundle\Entity\Contact $contact)
    {
        $this->contacts->removeElement($contact);
    }

    /**
     * Get contacts
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getContacts()
    {
        return $this->contacts;
    }
}
