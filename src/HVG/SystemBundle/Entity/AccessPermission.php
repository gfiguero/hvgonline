<?php

namespace HVG\SystemBundle\Entity;

/**
 * AccessPermission
 */
class AccessPermission
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
    private $cardfront;

    /**
     * @var string
     */
    private $cardback;

    /**
     * @var \DateTime
     */
    private $expiredAt;

    /**
     * @var boolean
     */
    private $granted;

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
     * @var \HVG\SystemBundle\Entity\Unit
     */
    private $unit;

    /**
     * @var \HVG\SystemBundle\Entity\Person
     */
    private $applicant;

    /**
     * @var \HVG\SystemBundle\Entity\Person
     */
    private $visitant;


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
     * @return AccessPermission
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
     * Set cardfront
     *
     * @param string $cardfront
     *
     * @return AccessPermission
     */
    public function setCardfront($cardfront)
    {
        $this->cardfront = $cardfront;

        return $this;
    }

    /**
     * Get cardfront
     *
     * @return string
     */
    public function getCardfront()
    {
        return $this->cardfront;
    }

    /**
     * Set cardback
     *
     * @param string $cardback
     *
     * @return AccessPermission
     */
    public function setCardback($cardback)
    {
        $this->cardback = $cardback;

        return $this;
    }

    /**
     * Get cardback
     *
     * @return string
     */
    public function getCardback()
    {
        return $this->cardback;
    }

    /**
     * Set expiredAt
     *
     * @param \DateTime $expiredAt
     *
     * @return AccessPermission
     */
    public function setExpiredAt($expiredAt)
    {
        $this->expiredAt = $expiredAt;

        return $this;
    }

    /**
     * Get expiredAt
     *
     * @return \DateTime
     */
    public function getExpiredAt()
    {
        return $this->expiredAt;
    }

    /**
     * Set granted
     *
     * @param boolean $granted
     *
     * @return AccessPermission
     */
    public function setGranted($granted)
    {
        $this->granted = $granted;

        return $this;
    }

    /**
     * Get granted
     *
     * @return boolean
     */
    public function getGranted()
    {
        return $this->granted;
    }

    /**
     * Set createdAt
     *
     * @param \DateTime $createdAt
     *
     * @return AccessPermission
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
     * @return AccessPermission
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
     * @return AccessPermission
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
     * Set unit
     *
     * @param \HVG\SystemBundle\Entity\Unit $unit
     *
     * @return AccessPermission
     */
    public function setUnit(\HVG\SystemBundle\Entity\Unit $unit = null)
    {
        $this->unit = $unit;

        return $this;
    }

    /**
     * Get unit
     *
     * @return \HVG\SystemBundle\Entity\Unit
     */
    public function getUnit()
    {
        return $this->unit;
    }

    /**
     * Set applicant
     *
     * @param \HVG\SystemBundle\Entity\Person $applicant
     *
     * @return AccessPermission
     */
    public function setApplicant(\HVG\SystemBundle\Entity\Person $applicant = null)
    {
        $this->applicant = $applicant;

        return $this;
    }

    /**
     * Get applicant
     *
     * @return \HVG\SystemBundle\Entity\Person
     */
    public function getApplicant()
    {
        return $this->applicant;
    }

    /**
     * Set visitant
     *
     * @param \HVG\SystemBundle\Entity\Person $visitant
     *
     * @return AccessPermission
     */
    public function setVisitant(\HVG\SystemBundle\Entity\Person $visitant = null)
    {
        $this->visitant = $visitant;

        return $this;
    }

    /**
     * Get visitant
     *
     * @return \HVG\SystemBundle\Entity\Person
     */
    public function getVisitant()
    {
        return $this->visitant;
    }
}

