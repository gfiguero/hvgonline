<?php

namespace HVG\SystemBundle\Entity;

/**
 * CarparkRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class CarparkRepository extends \Doctrine\ORM\EntityRepository
{
    public function findByUnit($unit, $sort, $direction)
    {
        return $this->getEntityManager()
            ->createQueryBuilder('c')
            ->select('c', 'cu')
            ->from('HVGSystemBundle:Carpark', 'c')
            ->join('c.unit', 'cu')
            ->where('c.unit = :unit')
            ->orderBy('c.'.$sort, $direction)
            ->setParameters(array('unit' => $unit))
            ->getQuery()
            ->getResult()
        ;
    }

    public function findByUnitgroup($unitgroup, $sort, $direction)
    {
        return $this->getEntityManager()
            ->createQueryBuilder('c')
            ->select('c', 'cu')
            ->from('HVGSystemBundle:Carpark', 'c')
            ->join('c.unit', 'cu')
            ->join('cu.unitgroup', 'cug')
            ->where('cug.id = :unitgroup')
            ->orderBy('c.'.$sort, $direction)
            ->setParameters(array('unitgroup' => $unitgroup))
            ->getQuery()
            ->getResult()
        ;
    }

    public function findByCommunity($community, $sort, $direction)
    {
        return $this->getEntityManager()
            ->createQueryBuilder('c')
            ->select('c', 'cc')
            ->from('HVGSystemBundle:Carpark', 'c')
            ->join('c.community', 'cc')
            ->where('cc.id = :community')
            ->orderBy('c.'.$sort, $direction)
            ->setParameters(array('community' => $community))
            ->getQuery()
            ->getResult()
        ;
    }
}
