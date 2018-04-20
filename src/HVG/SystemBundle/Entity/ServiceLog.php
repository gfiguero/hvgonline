<?php

namespace HVG\SystemBundle\Entity;

/**
 * ServiceLog
 */
class ServiceLog
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
     * @var \HVG\SystemBundle\Entity\Service
     */
    private $service;

    /**
     * @var \HVG\SystemBundle\Entity\ServiceAgent
     */
    private $serviceagent;


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
     * @return ServiceLog
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
     * @return ServiceLog
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
     * Set service
     *
     * @param \HVG\SystemBundle\Entity\Service $service
     *
     * @return ServiceLog
     */
    public function setService(\HVG\SystemBundle\Entity\Service $service = null)
    {
        $this->service = $service;

        return $this;
    }

    /**
     * Get service
     *
     * @return \HVG\SystemBundle\Entity\Service
     */
    public function getService()
    {
        return $this->service;
    }

    /**
     * Set serviceagent
     *
     * @param \HVG\SystemBundle\Entity\ServiceAgent $serviceagent
     *
     * @return ServiceLog
     */
    public function setServiceagent(\HVG\SystemBundle\Entity\ServiceAgent $serviceagent = null)
    {
        $this->serviceagent = $serviceagent;

        return $this;
    }

    /**
     * Get serviceagent
     *
     * @return \HVG\SystemBundle\Entity\ServiceAgent
     */
    public function getServiceagent()
    {
        return $this->serviceagent;
    }
}

