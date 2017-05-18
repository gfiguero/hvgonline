<?php

namespace HVG\SystemBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\File\File;
use Vich\UploaderBundle\Mapping\Annotation as Vich;

/**
 * PetitionAction
 * @ORM\Entity
 * @Vich\Uploadable
 */
class PetitionAction
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
     * @var \HVG\SystemBundle\Entity\Petition
     */
    private $petition;


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
     * @return PetitionAction
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
     * @return PetitionAction
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
     * @return PetitionAction
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
     * @return PetitionAction
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
     * Set petition
     *
     * @param \HVG\SystemBundle\Entity\Petition $petition
     *
     * @return PetitionAction
     */
    public function setPetition(\HVG\SystemBundle\Entity\Petition $petition = null)
    {
        $this->petition = $petition;

        return $this;
    }

    /**
     * Get petition
     *
     * @return \HVG\SystemBundle\Entity\Petition
     */
    public function getPetition()
    {
        return $this->petition;
    }

    /**
     * @var \HVG\UserBundle\Entity\User
     */
    private $user;


    /**
     * Set user
     *
     * @param \HVG\UserBundle\Entity\User $user
     *
     * @return PetitionAction
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
     * If manually uploading a file (i.e. not using Symfony Form) ensure an instance
     * of 'UploadedFile' is injected into this setter to trigger the  update. If this
     * bundle's configuration parameter 'inject_on_load' is set to 'true' this setter
     * must be able to accept an instance of 'File' as the bundle will inject one here
     * during Doctrine hydration.
     *
     * @param File|\Symfony\Component\HttpFoundation\File\UploadedFile $file
     *
     * @return PetitionAction
     */
    public function setFile(File $file = null)
    {
        $this->file = $file;

        if ($file) {
            // It is required that at least one field changes if you are using doctrine
            // otherwise the event listeners won't be called and the file is lost
            $this->updatedAt = new \DateTime();
        }
        
        return $this;
    }

    /**
     * @return File|null
     */
    public function getFile()
    {
        return $this->imageFile;
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
