<?php

namespace HVG\SystemBundle\Entity;

/**
 * AccessLog
 */
class AccessLog
{
    /**
     * @var integer
     */
    private $id;

    /**
     * @var string
     */
    private $description;

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
     * @var \HVG\SystemBundle\Entity\Checkpoint
     */
    private $checkpoint;

    /**
     * @var \HVG\SystemBundle\Entity\AccessGuard
     */
    private $accessguard;


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
     * Set description
     *
     * @param string $description
     *
     * @return AccessLog
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get description
     *
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set createdAt
     *
     * @param \DateTime $createdAt
     *
     * @return AccessLog
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
     * @return AccessLog
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
     * @return AccessLog
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
     * Set checkpoint
     *
     * @param \HVG\SystemBundle\Entity\Checkpoint $checkpoint
     *
     * @return AccessLog
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

    public function getCommunity()
    {
        return $this->checkpoint->getCommunity();
    }

    /**
     * Set accessguard
     *
     * @param \HVG\SystemBundle\Entity\AccessGuard $accessguard
     *
     * @return AccessLog
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
}

