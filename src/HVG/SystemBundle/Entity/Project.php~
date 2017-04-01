<?php

namespace HVG\SystemBundle\Entity;

/**
 * Project
 */
class Project
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
    private $objetive;

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
    private $observations;

    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $actions;

    /**
     * @var \HVG\SystemBundle\Entity\ProjectStatus
     */
    private $status;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->observations = new \Doctrine\Common\Collections\ArrayCollection();
        $this->actions = new \Doctrine\Common\Collections\ArrayCollection();
    }

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
     * @return Project
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
     * Set objetive
     *
     * @param string $objetive
     *
     * @return Project
     */
    public function setObjetive($objetive)
    {
        $this->objetive = $objetive;

        return $this;
    }

    /**
     * Get objetive
     *
     * @return string
     */
    public function getObjetive()
    {
        return $this->objetive;
    }

    /**
     * Set createdAt
     *
     * @param \DateTime $createdAt
     *
     * @return Project
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
     * @return Project
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
     * @return Project
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
     * Add observation
     *
     * @param \HVG\SystemBundle\Entity\ProjectObservation $observation
     *
     * @return Project
     */
    public function addObservation(\HVG\SystemBundle\Entity\ProjectObservation $observation)
    {
        $this->observations[] = $observation;

        return $this;
    }

    /**
     * Remove observation
     *
     * @param \HVG\SystemBundle\Entity\ProjectObservation $observation
     */
    public function removeObservation(\HVG\SystemBundle\Entity\ProjectObservation $observation)
    {
        $this->observations->removeElement($observation);
    }

    /**
     * Get observations
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getObservations()
    {
        return $this->observations;
    }

    /**
     * Add action
     *
     * @param \HVG\SystemBundle\Entity\ProjectAction $action
     *
     * @return Project
     */
    public function addAction(\HVG\SystemBundle\Entity\ProjectAction $action)
    {
        $this->actions[] = $action;

        return $this;
    }

    /**
     * Remove action
     *
     * @param \HVG\SystemBundle\Entity\ProjectAction $action
     */
    public function removeAction(\HVG\SystemBundle\Entity\ProjectAction $action)
    {
        $this->actions->removeElement($action);
    }

    /**
     * Get actions
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getActions()
    {
        return $this->actions;
    }

    /**
     * Set status
     *
     * @param \HVG\SystemBundle\Entity\ProjectStatus $status
     *
     * @return Project
     */
    public function setStatus(\HVG\SystemBundle\Entity\ProjectStatus $status = null)
    {
        $this->status = $status;

        return $this;
    }

    /**
     * Get status
     *
     * @return \HVG\SystemBundle\Entity\ProjectStatus
     */
    public function getStatus()
    {
        return $this->status;
    }
    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $proposals;


    /**
     * Add proposal
     *
     * @param \HVG\SystemBundle\Entity\ProjectProposal $proposal
     *
     * @return Project
     */
    public function addProposal(\HVG\SystemBundle\Entity\ProjectProposal $proposal)
    {
        $this->proposals[] = $proposal;

        return $this;
    }

    /**
     * Remove proposal
     *
     * @param \HVG\SystemBundle\Entity\ProjectProposal $proposal
     */
    public function removeProposal(\HVG\SystemBundle\Entity\ProjectProposal $proposal)
    {
        $this->proposals->removeElement($proposal);
    }

    /**
     * Get proposals
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getProposals()
    {
        return $this->proposals;
    }
    /**
     * @var \HVG\SystemBundle\Entity\Community
     */
    private $community;


    /**
     * Set community
     *
     * @param \HVG\SystemBundle\Entity\Community $community
     *
     * @return Project
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
    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $commands;


    /**
     * Add command
     *
     * @param \HVG\SystemBundle\Entity\ProjectCommand $command
     *
     * @return Project
     */
    public function addCommand(\HVG\SystemBundle\Entity\ProjectCommand $command)
    {
        $this->commands[] = $command;

        return $this;
    }

    /**
     * Remove command
     *
     * @param \HVG\SystemBundle\Entity\ProjectCommand $command
     */
    public function removeCommand(\HVG\SystemBundle\Entity\ProjectCommand $command)
    {
        $this->commands->removeElement($command);
    }

    /**
     * Get commands
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getCommands()
    {
        return $this->commands;
    }
}
