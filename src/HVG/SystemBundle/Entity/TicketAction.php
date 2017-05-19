<?php

namespace HVG\SystemBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\File\File;
use Vich\UploaderBundle\Mapping\Annotation as Vich;

/**
 * TicketAction
 * @Vich\Uploadable
 */
class TicketAction
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
     * @var string
     */
    private $filename;

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
     * @var \HVG\SystemBundle\Entity\Ticket
     */
    private $ticket;

    /**
     * @var \HVG\UserBundle\Entity\User
     */
    private $user;


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
     * @return TicketAction
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
     * @return TicketAction
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
     * @return TicketAction
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
     * @return TicketAction
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
     * Set ticket
     *
     * @param \HVG\SystemBundle\Entity\Ticket $ticket
     *
     * @return TicketAction
     */
    public function setTicket(\HVG\SystemBundle\Entity\Ticket $ticket = null)
    {
        $this->ticket = $ticket;

        return $this;
    }

    /**
     * Get ticket
     *
     * @return \HVG\SystemBundle\Entity\Ticket
     */
    public function getTicket()
    {
        return $this->ticket;
    }

    public function getUnit()
    {
        $unit = null;
        if($ticket = $this->getTicket()) $unit = $ticket->getUnit();
        return $unit;
    }

    public function getCommunity()
    {
        $community = null;
        if($unit = $this->getUnit()) $community = $unit->getCommunity();
        return $community;
    }

    public function getUnitGroup()
    {
        $unitGroup = null;
        if($unit = $this->getUnit()) $unitGroup = $unit->getUnitGroup();
        return $unitGroup;
    }
    /**
     * Set user
     *
     * @param \HVG\UserBundle\Entity\User $user
     *
     * @return TicketAction
     */
    public function setUser(\HVG\UserBundle\Entity\User $user = null)
    {
        $this->user = $user;

        return $this;
    }

    /**
     * Get user
     *
     * @return \HVG\UserBundle\Entity\User
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * @Vich\UploadableField(mapping="ticket_action_file", fileNameProperty="filename")
     * @var File
     */
    private $file;

    /**
     * @param File|\Symfony\Component\HttpFoundation\File\UploadedFile $file
     * @return Testing
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
     * @param string $filename
     *
     * @return PetitionAction
     */
    public function setFilename($filename)
    {
        $this->filename = $filename;
        
        return $this;
    }

    /**
     * @return string|null
     */
    public function getFilename()
    {
        return $this->filename;
    }

}
