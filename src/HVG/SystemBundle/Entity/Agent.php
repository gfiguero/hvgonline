<?php

namespace HVG\SystemBundle\Entity;

/**
 * Agent
 */
class Agent
{
    /**
     * @var integer
     */
    private $id;

    /**
     * @var string
     */
    private $fullname;

    /**
     * @var string
     */
    private $shortname;

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
    private $requirements;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->requirements = new \Doctrine\Common\Collections\ArrayCollection();
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
     * Set fullname
     *
     * @param string $fullname
     *
     * @return Agent
     */
    public function setFullname($fullname)
    {
        $this->fullname = $fullname;

        return $this;
    }

    /**
     * Get fullname
     *
     * @return string
     */
    public function getFullname()
    {
        return $this->fullname;
    }

    /**
     * Set shortname
     *
     * @param string $shortname
     *
     * @return Agent
     */
    public function setShortname($shortname)
    {
        $this->shortname = $shortname;

        return $this;
    }

    /**
     * Get shortname
     *
     * @return string
     */
    public function getShortname()
    {
        return $this->shortname;
    }

    /**
     * Set createdAt
     *
     * @param \DateTime $createdAt
     *
     * @return Agent
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
     * @return Agent
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
     * @return Agent
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
     * Add requirement
     *
     * @param \HVG\SystemBundle\Entity\Requirement $requirement
     *
     * @return Agent
     */
    public function addRequirement(\HVG\SystemBundle\Entity\Requirement $requirement)
    {
        $this->requirements[] = $requirement;

        return $this;
    }

    /**
     * Remove requirement
     *
     * @param \HVG\SystemBundle\Entity\Requirement $requirement
     */
    public function removeRequirement(\HVG\SystemBundle\Entity\Requirement $requirement)
    {
        $this->requirements->removeElement($requirement);
    }

    /**
     * Get requirements
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getRequirements()
    {
        return $this->requirements;
    }
}

