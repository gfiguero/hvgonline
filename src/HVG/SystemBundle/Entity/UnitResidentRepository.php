<?php

namespace HVG\SystemBundle\Entity;

/**
 * UnitResidentRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class UnitResidentRepository extends \Doctrine\ORM\EntityRepository
{
    public function findNameByUnit($unit)
    {
        return $this->getEntityManager()
            ->createQueryBuilder('r')
            ->select('r.name, r.phone')
            ->from('HVGSystemBundle:UnitResident', 'r')
            ->where('r.unit = :unit')
            ->setParameters(array('unit' => $unit))
            ->getQuery()
            ->getArrayResult()
        ;
    }

    public function findByUnitgroup($unitgroup)
    {
        return $this->getEntityManager()
            ->createQueryBuilder('r')
            ->select('r')
            ->from('HVGSystemBundle:UnitResident', 'r')
            ->join('r.unit', 'ru')
            ->join('ru.unitgroup', 'ruu')
            ->where('ruu.id = :unitgroup')
            ->setParameters(array('unitgroup' => $unitgroup))
            ->getQuery()
            ->getResult()
        ;
    }

    public function findByCommunity($community)
    {
        return $this->getEntityManager()
            ->createQueryBuilder('r')
            ->select('r')
            ->from('HVGSystemBundle:UnitResident', 'r')
            ->join('r.unit', 'ru')
            ->join('ru.community', 'ruc')
            ->where('ruc.id = :community')
            ->setParameters(array('community' => $community))
            ->getQuery()
            ->getResult()
        ;
    }

    public function findBySearch($community, $search)
    {
        return $this->getEntityManager()
            ->createQueryBuilder('r')
            ->select('r', 'ru')
            ->from('HVGSystemBundle:UnitResident', 'r')
            ->leftJoin('r.unit', 'ru')
            ->join('ru.community', 'ruc')
            ->where('ruc.id = :community')
            ->andWhere('r.name LIKE :search')
            ->setParameters(array('community' => $community, 'search' => '%'.$search.'%'))
            ->getQuery()
            ->getResult()
        ;
    }
}
