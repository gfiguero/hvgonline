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
     * Constructor
     */
    public function __construct()
    {
        $this->contacts = new \Doctrine\Common\Collections\ArrayCollection();
        $this->guests = new \Doctrine\Common\Collections\ArrayCollection();
    }

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
        $contact->setPerson($this);

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
    /**
     * @var \HVG\SystemBundle\Entity\Guest
     */
    private $guest;


    /**
     * Set guest
     *
     * @param \HVG\SystemBundle\Entity\Guest $guest
     *
     * @return Person
     */
    public function setGuest(\HVG\SystemBundle\Entity\Guest $guest = null)
    {
        $this->guest = $guest;

        return $this;
    }

    /**
     * Get guest
     *
     * @return \HVG\SystemBundle\Entity\Guest
     */
    public function getGuest()
    {
        return $this->guest;
    }
    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $guests;


    /**
     * Add guest
     *
     * @param \HVG\SystemBundle\Entity\Guest $guest
     *
     * @return Person
     */
    public function addGuest(\HVG\SystemBundle\Entity\Guest $guest)
    {
        $this->guests[] = $guest;

        return $this;
    }

    /**
     * Remove guest
     *
     * @param \HVG\SystemBundle\Entity\Guest $guest
     */
    public function removeGuest(\HVG\SystemBundle\Entity\Guest $guest)
    {
        $this->guests->removeElement($guest);
    }

    /**
     * Get guests
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getGuests()
    {
        return $this->guests;
    }
}
