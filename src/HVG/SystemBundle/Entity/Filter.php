<?php

namespace HVG\SystemBundle\Entity;

/**
 * Filter
 */
class Filter
{
    /**
     * @var \HVG\SystemBundle\Entity\Community
     */
    private $community;

    /**
     * Set community
     *
     * @param \HVG\SystemBundle\Entity\Community $community
     *
     * @return Filter
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

