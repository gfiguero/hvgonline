<?php

namespace HVG\SystemBundle\Entity;

use HVG\SystemBundle\Entity\Community;
/**
 * GuestRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class GuestRepository extends \Doctrine\ORM\EntityRepository
{
    public function findByCommunity(Community $community)
    {
        $qb = $this->getEntityManager()->createQueryBuilder('g');
        $qb->select('g')
            ->from('HVGSystemBundle:Guest', 'g')
            ->orderBy('g.createdAt', 'DESC');
        return $qb->getQuery()->getResult();
    }

}