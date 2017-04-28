<?php

namespace HVG\SystemBundle\Entity;

/**
 * ResultRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class ResultRepository extends \Doctrine\ORM\EntityRepository
{
    public function findActive()
    {
        return $this->getEntityManager()
            ->createQueryBuilder('r')
            ->select('r')
            ->from('HVGSystemBundle:Result', 'r')
            ->whereIn('r.id', array(1,2,3))
            ->getQuery()
            ->getResult();
    }    
}
