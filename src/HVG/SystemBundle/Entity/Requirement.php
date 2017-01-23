<?php

namespace HVG\SystemBundle\Entity;

/**
 * Requirement
 */
class Requirement
{
    /**
     * @var integer
     */
    private $id;

    /**
     * @var string
     */
    private $issue;

    /**
     * @var \DateTime
     */
    private $committal;

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
    private $comments;

    /**
     * @var \HVG\SystemBundle\Entity\Agent
     */
    private $creator;

    /**
     * @var \HVG\SystemBundle\Entity\Agent
     */
    private $carrier;

    /**
     * @var \HVG\SystemBundle\Entity\RequirementStatus
     */
    private $status;

    /**
     * @var \HVG\SystemBundle\Entity\CommunicationChannel
     */
    private $channel;

    /**
     * @var \HVG\SystemBundle\Entity\Community
     */
    private $community;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->comments = new \Doctrine\Common\Collections\ArrayCollection();
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
     * Set issue
     *
     * @param string $issue
     *
     * @return Requirement
     */
    public function setIssue($issue)
    {
        $this->issue = $issue;

        return $this;
    }

    /**
     * Get issue
     *
     * @return string
     */
    public function getIssue()
    {
        return $this->issue;
    }

    /**
     * Set committal
     *
     * @param \DateTime $committal
     *
     * @return Requirement
     */
    public function setCommittal($committal)
    {
        $this->committal = $committal;

        return $this;
    }

    /**
     * Get committal
     *
     * @return \DateTime
     */
    public function getCommittal()
    {
        return $this->committal;
    }

    /**
     * Set createdAt
     *
     * @param \DateTime $createdAt
     *
     * @return Requirement
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
     * @return Requirement
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
     * @return Requirement
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
     * Add comment
     *
     * @param \HVG\SystemBundle\Entity\RequirementComment $comment
     *
     * @return Requirement
     */
    public function addComment(\HVG\SystemBundle\Entity\RequirementComment $comment)
    {
        $this->comments[] = $comment;

        return $this;
    }

    /**
     * Remove comment
     *
     * @param \HVG\SystemBundle\Entity\RequirementComment $comment
     */
    public function removeComment(\HVG\SystemBundle\Entity\RequirementComment $comment)
    {
        $this->comments->removeElement($comment);
    }

    /**
     * Get comments
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getComments()
    {
        return $this->comments;
    }

    /**
     * Set creator
     *
     * @param \HVG\SystemBundle\Entity\Agent $creator
     *
     * @return Requirement
     */
    public function setCreator(\HVG\SystemBundle\Entity\Agent $creator = null)
    {
        $this->creator = $creator;

        return $this;
    }

    /**
     * Get creator
     *
     * @return \HVG\SystemBundle\Entity\Agent
     */
    public function getCreator()
    {
        return $this->creator;
    }

    /**
     * Set carrier
     *
     * @param \HVG\SystemBundle\Entity\Agent $carrier
     *
     * @return Requirement
     */
    public function setCarrier(\HVG\SystemBundle\Entity\Agent $carrier = null)
    {
        $this->carrier = $carrier;

        return $this;
    }

    /**
     * Get carrier
     *
     * @return \HVG\SystemBundle\Entity\Agent
     */
    public function getCarrier()
    {
        return $this->carrier;
    }

    /**
     * Set status
     *
     * @param \HVG\SystemBundle\Entity\RequirementStatus $status
     *
     * @return Requirement
     */
    public function setStatus(\HVG\SystemBundle\Entity\RequirementStatus $status = null)
    {
        $this->status = $status;

        return $this;
    }

    /**
     * Get status
     *
     * @return \HVG\SystemBundle\Entity\RequirementStatus
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * Set channel
     *
     * @param \HVG\SystemBundle\Entity\CommunicationChannel $channel
     *
     * @return Requirement
     */
    public function setChannel(\HVG\SystemBundle\Entity\CommunicationChannel $channel = null)
    {
        $this->channel = $channel;

        return $this;
    }

    /**
     * Get channel
     *
     * @return \HVG\SystemBundle\Entity\CommunicationChannel
     */
    public function getChannel()
    {
        return $this->channel;
    }

    /**
     * Set community
     *
     * @param \HVG\SystemBundle\Entity\Community $community
     *
     * @return Requirement
     */
    public function setCommunity(\HVG\SystemBundle\Entity\Community $community = null)
    {
        $this->community = $community;

        return $this;
    }

    /**
     * Get community
     *
     * @return \HVG\SystemBundle\Entity\Community
     */
    public function getCommunity()
    {
        return $this->community;
    }
}

