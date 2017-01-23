<?php

namespace HVG\SystemBundle\Entity;

/**
 * SupervisorsLog
 */
class SupervisorsLog
{
    /**
     * @var integer
     */
    private $id;

    /**
     * @var string
     */
    private $news;

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
     * @var \HVG\SystemBundle\Entity\Agent
     */
    private $supervisor;


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
     * Set news
     *
     * @param string $news
     *
     * @return SupervisorsLog
     */
    public function setNews($news)
    {
        $this->news = $news;

        return $this;
    }

    /**
     * Get news
     *
     * @return string
     */
    public function getNews()
    {
        return $this->news;
    }

    /**
     * Set createdAt
     *
     * @param \DateTime $createdAt
     *
     * @return SupervisorsLog
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
     * @return SupervisorsLog
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
     * @return SupervisorsLog
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
     * Set supervisor
     *
     * @param \HVG\SystemBundle\Entity\Agent $supervisor
     *
     * @return SupervisorsLog
     */
    public function setSupervisor(\HVG\SystemBundle\Entity\Agent $supervisor = null)
    {
        $this->supervisor = $supervisor;

        return $this;
    }

    /**
     * Get supervisor
     *
     * @return \HVG\SystemBundle\Entity\Agent
     */
    public function getSupervisor()
    {
        return $this->supervisor;
    }
}

