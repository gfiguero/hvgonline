<?php

namespace HVG\SystemBundle\Entity;

/**
 * Role
 */
class Role
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
     * Constructor
     */
    public function __construct()
    {
        $this->community_staff = new \Doctrine\Common\Collections\ArrayCollection();
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
     * @return Role
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
     * @return Role
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
     * @return Role
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
     * @return Role
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
    private $community_staffs;


    /**
     * Add communityStaff
     *
     * @param \HVG\SystemBundle\Entity\CommunityStaff $communityStaff
     *
     * @return Role
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
}
