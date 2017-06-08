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
    private $unitgroups;


    /**
     * Add unitgroup
     *
     * @param \HVG\SystemBundle\Entity\UnitGroup $unitgroup
     *
     * @return Community
     */
    public function addUnitGroup(\HVG\SystemBundle\Entity\UnitGroup $unitgroup)
    {
        $this->unitgroups[] = $unitgroup;

        return $this;
    }

    /**
     * Remove unitgroup
     *
     * @param \HVG\SystemBundle\Entity\UnitGroup $unitgroup
     */
    public function removeUnitGroup(\HVG\SystemBundle\Entity\UnitGroup $unitgroup)
    {
        $this->unitgroups->removeElement($unitgroup);
    }

    /**
     * Get unitgroups
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getUnitGroups()
    {
        return $this->unitgroups;
    }
    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $communitystaffs;


    /**
     * Add communityStaff
     *
     * @param \HVG\SystemBundle\Entity\CommunityStaff $communityStaff
     *
     * @return Community
     */
    public function addCommunityStaff(\HVG\SystemBundle\Entity\CommunityStaff $communityStaff)
    {
        $this->communitystaffs[] = $communityStaff;

        return $this;
    }

    /**
     * Remove communityStaff
     *
     * @param \HVG\SystemBundle\Entity\CommunityStaff $communityStaff
     */
    public function removeCommunityStaff(\HVG\SystemBundle\Entity\CommunityStaff $communityStaff)
    {
        $this->communitystaffs->removeElement($communityStaff);
    }

    /**
     * Get communityStaffs
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getCommunityStaffs()
    {
        return $this->communitystaffs;
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
    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $units;

    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $unit_groups;


    /**
     * Add unit
     *
     * @param \HVG\SystemBundle\Entity\Unit $unit
     *
     * @return Community
     */
    public function addUnit(\HVG\SystemBundle\Entity\Unit $unit)
    {
        $this->units[] = $unit;

        return $this;
    }

    /**
     * Remove unit
     *
     * @param \HVG\SystemBundle\Entity\Unit $unit
     */
    public function removeUnit(\HVG\SystemBundle\Entity\Unit $unit)
    {
        $this->units->removeElement($unit);
    }

    /**
     * Get units
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getUnits()
    {
        return $this->units;
    }

    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $projects;


    /**
     * Add project
     *
     * @param \HVG\SystemBundle\Entity\Project $project
     *
     * @return Community
     */
    public function addProject(\HVG\SystemBundle\Entity\Project $project)
    {
        $this->projects[] = $project;

        return $this;
    }

    /**
     * Remove project
     *
     * @param \HVG\SystemBundle\Entity\Project $project
     */
    public function removeProject(\HVG\SystemBundle\Entity\Project $project)
    {
        $this->projects->removeElement($project);
    }

    /**
     * Get projects
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getProjects()
    {
        return $this->projects;
    }
    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $users;


    /**
     * Add user
     *
     * @param \HVG\UserBundle\Entity\User $user
     *
     * @return Community
     */
    public function addUser(\HVG\UserBundle\Entity\User $user)
    {
        $this->users[] = $user;

        return $this;
    }

    /**
     * Remove user
     *
     * @param \HVG\UserBundle\Entity\User $user
     */
    public function removeUser(\HVG\UserBundle\Entity\User $user)
    {
        $this->users->removeElement($user);
    }

    /**
     * Get users
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getUsers()
    {
        return $this->users;
    }

    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $expenditures;

    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $funds;


    /**
     * Add expenditure
     *
     * @param \HVG\SystemBundle\Entity\Expenditure $expenditure
     *
     * @return Community
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
     * Add fund
     *
     * @param \HVG\SystemBundle\Entity\Fund $fund
     *
     * @return Community
     */
    public function addFund(\HVG\SystemBundle\Entity\Fund $fund)
    {
        $this->funds[] = $fund;

        return $this;
    }

    /**
     * Remove fund
     *
     * @param \HVG\SystemBundle\Entity\Fund $fund
     */
    public function removeFund(\HVG\SystemBundle\Entity\Fund $fund)
    {
        $this->funds->removeElement($fund);
    }

    /**
     * Get funds
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getFunds()
    {
        return $this->funds;
    }
}
