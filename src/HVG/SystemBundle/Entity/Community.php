<?php

namespace HVG\SystemBundle\Entity;

/**
 * Community
 */
class Community
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

    public function __toString()
    {
        return $this->name;
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
     * @return Community
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
     * @return Community
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
     * @return Community
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
     * @return Community
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
    private $petitions;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->petitions = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add petition
     *
     * @param \HVG\SystemBundle\Entity\Petition $petition
     *
     * @return Community
     */
    public function addPetition(\HVG\SystemBundle\Entity\Petition $petition)
    {
        $this->petitions[] = $petition;

        return $this;
    }

    /**
     * Remove petition
     *
     * @param \HVG\SystemBundle\Entity\Petition $petition
     */
    public function removePetition(\HVG\SystemBundle\Entity\Petition $petition)
    {
        $this->petitions->removeElement($petition);
    }

    /**
     * Get petitions
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getPetitions()
    {
        return $this->petitions;
    }
    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $buildings;


    /**
     * Add building
     *
     * @param \HVG\SystemBundle\Entity\Building $building
     *
     * @return Community
     */
    public function addBuilding(\HVG\SystemBundle\Entity\Building $building)
    {
        $this->buildings[] = $building;

        return $this;
    }

    /**
     * Remove building
     *
     * @param \HVG\SystemBundle\Entity\Building $building
     */
    public function removeBuilding(\HVG\SystemBundle\Entity\Building $building)
    {
        $this->buildings->removeElement($building);
    }

    /**
     * Get buildings
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getBuildings()
    {
        return $this->buildings;
    }
    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $community_staffs;


    /**
     * Add communityStaff
     *
     * @param \HVG\SystemBundle\Entity\CommunityStaff $communityStaff
     *
     * @return Community
     */
    public function addCommunityStaff(\HVG\SystemBundle\Entity\CommunityStaff $communityStaff)
    {
        $this->community_staffs[] = $communityStaff;

        return $this;
    }

    /**
     * Remove communityStaff
     *
     * @param \HVG\SystemBundle\Entity\CommunityStaff $communityStaff
     */
    public function removeCommunityStaff(\HVG\SystemBundle\Entity\CommunityStaff $communityStaff)
    {
        $this->community_staffs->removeElement($communityStaff);
    }

    /**
     * Get communityStaffs
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getCommunityStaffs()
    {
        return $this->community_staffs;
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
     * @return Community
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
}
