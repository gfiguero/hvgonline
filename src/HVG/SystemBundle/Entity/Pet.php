<?php

namespace HVG\SystemBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\File\File;
use Vich\UploaderBundle\Mapping\Annotation as Vich;

/**
 * Pet
 * @Vich\Uploadable
 */
class Pet
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
     * @var \HVG\SystemBundle\Entity\Unit
     */
    private $unit;


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
     * @return Pet
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
     * @return Pet
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
     * @return Pet
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
     * @return Pet
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
     * Set unit
     *
     * @param \HVG\SystemBundle\Entity\Unit $unit
     *
     * @return Pet
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
     * @var integer
     */
    private $group;

    /**
     * @var string
     */
    private $race;

    /**
     * @var string
     */
    private $phone;

    /**
     * @var integer
     */
    private $color;

    /**
     * @var string
     */
    private $photography;

    /**
     * Set photography
     *
     * @param string $photography
     *
     * @return Pet
     */
    public function setPhotography($photography)
    {
        $this->photography = $photography;

        return $this;
    }

    /**
     * Get photography
     *
     * @return string
     */
    public function getPhotography()
    {
        return $this->photography;
    }

    /**
     * @Vich\UploadableField(mapping="pet_photography_file", fileNameProperty="photography")
     * @var File
     */
    private $photographyfile;

    /**
     * @param File|\Symfony\Component\HttpFoundation\File\UploadedFile $photographyfile
     * @return Pet
     */
    
    public function setPhotographyFile(File $photographyfile = null)
    {
        $this->photographyfile = $photographyfile;

        if ($photographyfile) {
            $this->updatedAt = new \DateTime();
        }

        return $this;
    }

    /**
     * @return File|null
     */
    public function getPhotographyFile()
    {
        return $this->photographyfile;
    }



    /**
     * Set group
     *
     * @param integer $group
     *
     * @return Pet
     */
    public function setGroup($group)
    {
        $this->group = $group;

        return $this;
    }

    /**
     * Get group
     *
     * @return integer
     */
    public function getGroup()
    {
        return $this->group;
    }

    /**
     * Set race
     *
     * @param string $race
     *
     * @return Pet
     */
    public function setRace($race)
    {
        $this->race = $race;

        return $this;
    }

    /**
     * Get race
     *
     * @return string
     */
    public function getRace()
    {
        return $this->race;
    }

    /**
     * Set phone
     *
     * @param string $phone
     *
     * @return Pet
     */
    public function setPhone($phone)
    {
        $this->phone = $phone;

        return $this;
    }

    /**
     * Get phone
     *
     * @return string
     */
    public function getPhone()
    {
        return $this->phone;
    }

    /**
     * Set color
     *
     * @param integer $color
     *
     * @return Pet
     */
    public function setColor($color)
    {
        $this->color = $color;

        return $this;
    }

    /**
     * Get color
     *
     * @return integer
     */
    public function getColor()
    {
        return $this->color;
    }

    /**
     * @var string
     */
    private $email;

    /**
     * @var boolean
     */
    private $terms;


    /**
     * Set email
     *
     * @param string $email
     *
     * @return Pet
     */
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Get email
     *
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set terms
     *
     * @param boolean $terms
     *
     * @return Pet
     */
    public function setTerms($terms)
    {
        $this->terms = $terms;

        return $this;
    }

    /**
     * Get terms
     *
     * @return boolean
     */
    public function getTerms()
    {
        return $this->terms;
    }
    /**
     * @var string
     */
    private $gender;


    /**
     * Set gender
     *
     * @param string $gender
     *
     * @return Pet
     */
    public function setGender($gender)
    {
        $this->gender = $gender;

        return $this;
    }

    /**
     * Get gender
     *
     * @return string
     */
    public function getGender()
    {
        return $this->gender;
    }
    /**
     * @var \HVG\SystemBundle\Entity\Person
     */
    private $owner;


    /**
     * Set owner
     *
     * @param \HVG\SystemBundle\Entity\Person $owner
     *
     * @return Pet
     */
    public function setOwner(\HVG\SystemBundle\Entity\Person $owner = null)
    {
        $this->owner = $owner;

        return $this;
    }

    /**
     * Get owner
     *
     * @return \HVG\SystemBundle\Entity\Person
     */
    public function getOwner()
    {
        return $this->owner;
    }
    /**
     * @var integer
     */
    private $petgroup;


    /**
     * Set petgroup
     *
     * @param integer $petgroup
     *
     * @return Pet
     */
    public function setPetgroup($petgroup)
    {
        $this->petgroup = $petgroup;

        return $this;
    }

    /**
     * Get petgroup
     *
     * @return integer
     */
    public function getPetgroup()
    {
        return $this->petgroup;
    }
    /**
     * @var integer
     */
    private $weight;


    /**
     * Set weight
     *
     * @param integer $weight
     *
     * @return Pet
     */
    public function setWeight($weight)
    {
        $this->weight = $weight;

        return $this;
    }

    /**
     * Get weight
     *
     * @return integer
     */
    public function getWeight()
    {
        return $this->weight;
    }
    /**
     * @var integer
     */
    private $rfid;


    /**
     * Set rfid
     *
     * @param integer $rfid
     *
     * @return Pet
     */
    public function setRfid($rfid)
    {
        $this->rfid = $rfid;

        return $this;
    }

    /**
     * Get rfid
     *
     * @return integer
     */
    public function getRfid()
    {
        return $this->rfid;
    }
}
