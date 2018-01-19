<?php

namespace HVG\SystemBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\File\File;
use Vich\UploaderBundle\Mapping\Annotation as Vich;

/**
 * Community
 * @Vich\Uploadable
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
    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $outflows;


    /**
     * Add outflow
     *
     * @param \HVG\SystemBundle\Entity\Outflow $outflow
     *
     * @return Community
     */
    public function addOutflow(\HVG\SystemBundle\Entity\Outflow $outflow)
    {
        $this->outflows[] = $outflow;

        return $this;
    }

    /**
     * Remove outflow
     *
     * @param \HVG\SystemBundle\Entity\Outflow $outflow
     */
    public function removeOutflow(\HVG\SystemBundle\Entity\Outflow $outflow)
    {
        $this->outflows->removeElement($outflow);
    }

    /**
     * Get outflows
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getOutflows()
    {
        return $this->outflows;
    }
    /**
     * @var string
     */
    private $hash;


    /**
     * Set hash
     *
     * @param string $hash
     *
     * @return Community
     */
    public function setHash($hash)
    {
        $this->hash = $hash;

        return $this;
    }

    /**
     * Get hash
     *
     * @return string
     */
    public function getHash()
    {
        return $this->hash;
    }
    /**
     * @var string
     */
    private $logo;


    /**
     * Set logo
     *
     * @param string $logo
     *
     * @return Community
     */
    public function setLogo($logo)
    {
        $this->logo = $logo;

        return $this;
    }

    /**
     * Get logo
     *
     * @return string
     */
    public function getLogo()
    {
        return $this->logo;
    }

    /**
     * @Vich\UploadableField(mapping="community_logo", fileNameProperty="logo")
     * @var File $file
     */
    private $file;

    /**
     * @param File|\Symfony\Component\HttpFoundation\File\UploadedFile $file
     * @return Community
     */
    
    public function setFile(File $file = null)
    {
        $this->file = $file;

        if ($file) {
            $this->updatedAt = new \DateTime();
        }

        return $this;
    }

    /**
     * @return File|null
     */
    public function getFile()
    {
        return $this->file;
    }

    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $carparks;


    /**
     * Add carpark
     *
     * @param \HVG\SystemBundle\Entity\Carpark $carpark
     *
     * @return Community
     */
    public function addCarpark(\HVG\SystemBundle\Entity\Carpark $carpark)
    {
        $this->carparks[] = $carpark;

        return $this;
    }

    /**
     * Remove carpark
     *
     * @param \HVG\SystemBundle\Entity\Carpark $carpark
     */
    public function removeCarpark(\HVG\SystemBundle\Entity\Carpark $carpark)
    {
        $this->carparks->removeElement($carpark);
    }

    /**
     * Get carparks
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getCarparks()
    {
        return $this->carparks;
    }
    /**
     * @var \DateTime
     */
    private $insurancePolicyExpiration;


    /**
     * Set insurancePolicyExpiration
     *
     * @param \DateTime $insurancePolicyExpiration
     *
     * @return Community
     */
    public function setInsurancePolicyExpiration($insurancePolicyExpiration)
    {
        $this->insurancePolicyExpiration = $insurancePolicyExpiration;

        return $this;
    }

    /**
     * Get insurancePolicyExpiration
     *
     * @return \DateTime
     */
    public function getInsurancePolicyExpiration()
    {
        return $this->insurancePolicyExpiration;
    }
    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $guestcarparks;


    /**
     * Add guestcarpark
     *
     * @param \HVG\SystemBundle\Entity\GuestCarpark $guestcarpark
     *
     * @return Community
     */
    public function addGuestcarpark(\HVG\SystemBundle\Entity\GuestCarpark $guestcarpark)
    {
        $this->guestcarparks[] = $guestcarpark;

        return $this;
    }

    /**
     * Remove guestcarpark
     *
     * @param \HVG\SystemBundle\Entity\GuestCarpark $guestcarpark
     */
    public function removeGuestcarpark(\HVG\SystemBundle\Entity\GuestCarpark $guestcarpark)
    {
        $this->guestcarparks->removeElement($guestcarpark);
    }

    /**
     * Get guestcarparks
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getGuestcarparks()
    {
        return $this->guestcarparks;
    }
    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $accessgates;


    /**
     * Add accessgate
     *
     * @param \HVG\SystemBundle\Entity\AccessGate $accessgate
     *
     * @return Community
     */
    public function addAccessgate(\HVG\SystemBundle\Entity\AccessGate $accessgate)
    {
        $this->accessgates[] = $accessgate;

        return $this;
    }

    /**
     * Remove accessgate
     *
     * @param \HVG\SystemBundle\Entity\AccessGate $accessgate
     */
    public function removeAccessgate(\HVG\SystemBundle\Entity\AccessGate $accessgate)
    {
        $this->accessgates->removeElement($accessgate);
    }

    /**
     * Get accessgates
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getAccessgates()
    {
        return $this->accessgates;
    }
    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $accessguards;


    /**
     * Add accessguard
     *
     * @param \HVG\SystemBundle\Entity\AccessGuard $accessguard
     *
     * @return Community
     */
    public function addAccessguard(\HVG\SystemBundle\Entity\AccessGuard $accessguard)
    {
        $this->accessguards[] = $accessguard;

        return $this;
    }

    /**
     * Remove accessguard
     *
     * @param \HVG\SystemBundle\Entity\AccessGuard $accessguard
     */
    public function removeAccessguard(\HVG\SystemBundle\Entity\AccessGuard $accessguard)
    {
        $this->accessguards->removeElement($accessguard);
    }

    /**
     * Get accessguards
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getAccessguards()
    {
        return $this->accessguards;
    }
    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $checkpoints;


    /**
     * Add checkpoint
     *
     * @param \HVG\SystemBundle\Entity\Checkpoint $checkpoint
     *
     * @return Community
     */
    public function addCheckpoint(\HVG\SystemBundle\Entity\Checkpoint $checkpoint)
    {
        $this->checkpoints[] = $checkpoint;

        return $this;
    }

    /**
     * Remove checkpoint
     *
     * @param \HVG\SystemBundle\Entity\Checkpoint $checkpoint
     */
    public function removeCheckpoint(\HVG\SystemBundle\Entity\Checkpoint $checkpoint)
    {
        $this->checkpoints->removeElement($checkpoint);
    }

    /**
     * Get checkpoints
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getCheckpoints()
    {
        return $this->checkpoints;
    }
    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $communityevents;


    /**
     * Add communityevent
     *
     * @param \HVG\SystemBundle\Entity\CommunityEvent $communityevent
     *
     * @return Community
     */
    public function addCommunityevent(\HVG\SystemBundle\Entity\CommunityEvent $communityevent)
    {
        $this->communityevents[] = $communityevent;

        return $this;
    }

    /**
     * Remove communityevent
     *
     * @param \HVG\SystemBundle\Entity\CommunityEvent $communityevent
     */
    public function removeCommunityevent(\HVG\SystemBundle\Entity\CommunityEvent $communityevent)
    {
        $this->communityevents->removeElement($communityevent);
    }

    /**
     * Get communityevents
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getCommunityevents()
    {
        return $this->communityevents;
    }
    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $zones;


    /**
     * Add zone
     *
     * @param \HVG\SystemBundle\Entity\Zone $zone
     *
     * @return Community
     */
    public function addZone(\HVG\SystemBundle\Entity\Zone $zone)
    {
        $this->zones[] = $zone;

        return $this;
    }

    /**
     * Remove zone
     *
     * @param \HVG\SystemBundle\Entity\Zone $zone
     */
    public function removeZone(\HVG\SystemBundle\Entity\Zone $zone)
    {
        $this->zones->removeElement($zone);
    }

    /**
     * Get zones
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getZones()
    {
        return $this->zones;
    }
}
