<?php

namespace HVG\SystemBundle\Entity;

/**
 * Guest
 */
class Guest
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
     * @var \Doctrine\Common\Collections\Collection
     */
    private $people;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->people = new \Doctrine\Common\Collections\ArrayCollection();
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
     * @return Guest
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
     * @return Guest
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
     * @return Guest
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
     * @return Guest
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
     * @return Guest
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
     * Add person
     *
     * @param \HVG\SystemBundle\Entity\Person $person
     *
     * @return Guest
     */
    public function addPerson(\HVG\SystemBundle\Entity\Person $person)
    {
        $person->addGuest($this);

        $this->people[] = $person;

        return $this;
    }

    /**
     * Remove person
     *
     * @param \HVG\SystemBundle\Entity\Person $person
     */
    public function removePerson(\HVG\SystemBundle\Entity\Person $person)
    {
        $this->people->removeElement($person);
    }

    /**
     * Get people
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getPeople()
    {
        return $this->people;
    }
    /**
     * @var \HVG\SystemBundle\Entity\Unit
     */
    private $unit;


    /**
     * Set unit
     *
     * @param \HVG\SystemBundle\Entity\Unit $unit
     *
     * @return Guest
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
    /**
     * @var string
     */
    private $note;

    /**
     * Set note
     *
     * @param string $note
     *
     * @return Guest
     */
    public function setNote($note)
    {
        $this->note = $note;

        return $this;
    }

    /**
     * Get note
     *
     * @return string
     */
    public function getNote()
    {
        return $this->note;
    }

    /**
     * @var string
     */
    private $carLicence;

    /**
     * @var \HVG\SystemBundle\Entity\GuestCarpark
     */
    private $guestcarpark;


    /**
     * Set carLicence
     *
     * @param string $carLicence
     *
     * @return Guest
     */
    public function setCarLicence($carLicence)
    {
        $this->carLicence = $carLicence;

        return $this;
    }

    /**
     * Get carLicence
     *
     * @return string
     */
    public function getCarLicence()
    {
        return $this->carLicence;
    }

    /**
     * Set guestcarpark
     *
     * @param \HVG\SystemBundle\Entity\GuestCarpark $guestcarpark
     *
     * @return Guest
     */
    public function setGuestcarpark(\HVG\SystemBundle\Entity\GuestCarpark $guestcarpark = null)
    {
        $this->guestcarpark = $guestcarpark;

        return $this;
    }

    /**
     * Get guestcarpark
     *
     * @return \HVG\SystemBundle\Entity\GuestCarpark
     */
    public function getGuestcarpark()
    {
        return $this->guestcarpark;
    }

    /**
     * @var \HVG\SystemBundle\Entity\AccessGuard
     */
    private $accessguard;


    /**
     * Set accessguard
     *
     * @param \HVG\SystemBundle\Entity\AccessGuard $accessguard
     *
     * @return Guest
     */
    public function setAccessguard(\HVG\SystemBundle\Entity\AccessGuard $accessguard = null)
    {
        $this->accessguard = $accessguard;

        return $this;
    }

    /**
     * Get accessguard
     *
     * @return \HVG\SystemBundle\Entity\AccessGuard
     */
    public function getAccessguard()
    {
        return $this->accessguard;
    }
    /**
     * @var \HVG\SystemBundle\Entity\Checkpoint
     */
    private $checkpoint;


    /**
     * Set checkpoint
     *
     * @param \HVG\SystemBundle\Entity\Checkpoint $checkpoint
     *
     * @return Guest
     */
    public function setCheckpoint(\HVG\SystemBundle\Entity\Checkpoint $checkpoint = null)
    {
        $this->checkpoint = $checkpoint;

        return $this;
    }

    /**
     * Get checkpoint
     *
     * @return \HVG\SystemBundle\Entity\Checkpoint
     */
    public function getCheckpoint()
    {
        return $this->checkpoint;
    }
}
