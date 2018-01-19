<?php

namespace HVG\SystemBundle\Entity;

/**
 * TicketRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class TicketRepository extends \Doctrine\ORM\EntityRepository
{
    public function findByFilter($unit, $unitgroup)
    {
        if($unit) {
            return $this->getEntityManager()
                ->createQueryBuilder('t')
                ->select('t')
                ->from('HVGSystemBundle:Ticket', 't')
                ->where('t.unit = :unit')
                ->setParameter('unit', $unit)
                ->getQuery()
                ->getResult();            
        } elseif ($unitgroup) {
            return $this->getEntityManager()
                ->createQueryBuilder('t')
                ->select('t')
                ->from('HVGSystemBundle:Ticket', 't')
                ->join('t.unit', 'tu')
                ->where('tu.unitgroup = :unitgroup')
                ->setParameter('unitgroup', $unitgroup)
                ->getQuery()
                ->getResult();            
        } else {
            return $this->getEntityManager()
                ->createQueryBuilder('t')
                ->select('t')
                ->from('HVGSystemBundle:Ticket', 't')
                ->getQuery()
                ->getResult();            
        }
    }

    public function findByAreaCommunity($areas, $communities)
    {
        return $this->getEntityManager()
            ->createQueryBuilder('t')
            ->select('t')
            ->from('HVGSystemBundle:Ticket', 't')
            ->join('t.unit', 'tu')
            ->where('t.area IN (:areas)')
            ->andWhere('tu.community IN (:communities)')
            ->setParameters(array('areas' => $areas, 'communities' => $communities))
            ->getQuery()
            ->getResult();            
    }

    public function findByCommunity($status, $community, $sort, $direction)
    {
        $qb = $this->getEntityManager()->createQueryBuilder('t');
        $qb = $qb->select('t', 'u', 'c')->from('HVGSystemBundle:Ticket', 't');

        $qb = $qb->join('t.unit', 'u');
        $qb = $qb->join('u.community', 'c');
        $qb = $qb->andWhere('c.id = :community');
        $qb = $qb->setParameter('community', $community);
        if ($status) {
            $qb = $qb->andWhere('t.status = :status');
            $qb = $qb->setParameter('status', $status);
        }
        $qb = $qb->orderBy('t.'.$sort, $direction);
        return $qb->getQuery()->getResult();
    }

    public function findByUnitgroup($status, $unitgroup, $sort, $direction)
    {
        $qb = $this->getEntityManager()->createQueryBuilder('t');
        $qb = $qb->select('t', 'u', 'ug')->from('HVGSystemBundle:Ticket', 't');
        $qb = $qb->join('t.unit', 'u');
        $qb = $qb->join('u.unitgroup', 'ug');
        $qb = $qb->andWhere('ug.id = :unitgroup');
        $qb = $qb->setParameter('unitgroup', $unitgroup);
        if ($status) {
            $qb = $qb->andWhere('t.status = :status');
            $qb = $qb->setParameter('status', $status);
        }
        $qb = $qb->orderBy('t.'.$sort, $direction);
        return $qb->getQuery()->getResult();
    }

    public function findByUnit($status, $unit, $sort, $direction)
    {
        $qb = $this->getEntityManager()->createQueryBuilder('t');
        $qb = $qb->select('t', 'u')->from('HVGSystemBundle:Ticket', 't');
        $qb = $qb->join('t.unit', 'u');
        $qb = $qb->andWhere('u.id = :unit');
        $qb = $qb->setParameter('unit', $unit);
        if ($status) {
            $qb = $qb->andWhere('t.status = :status');
            $qb = $qb->setParameter('status', $status);
        }
        $qb = $qb->orderBy('t.'.$sort, $direction);
        return $qb->getQuery()->getResult();
    }

    public function findByStatus($status = null, $community = null, $unitgroup = null, $unit = null, $sort, $direction, $user)
    {
        $qb = $this->getEntityManager()->createQueryBuilder('t');
        $qb = $qb->select('t', 'u')->from('HVGSystemBundle:Ticket', 't');
        $qb = $qb->join('t.unit', 'u');
        $qb = $qb->join('u.unitgroup', 'g');
        $qb = $qb->join('u.community', 'c');

        if($unit){
            $qb = $qb->andWhere('u.id = :unit');
            $qb = $qb->setParameter('unit', $unit->getId());
        } elseif ($unitgroup) {
            $qb = $qb->andWhere('g.id = :unitgroup');
            $qb = $qb->setParameter('unitgroup', $unitgroup->getId());
        } elseif ($community) {
            $qb = $qb->andWhere('c.id = :community');
            $qb = $qb->setParameter('community', $community->getId());
        }

        if ($status) {
            $qb = $qb->andWhere('t.status = :status');
            $qb = $qb->setParameter('status', $status);
        }

        $qb = $qb->orderBy('t.'.$sort, $direction);
        return $qb->getQuery()->getResult();
    }

    public function findByUser($status = null, $community = null, $unitgroup = null, $unit = null, $sort, $direction, $user)
    {
        $qb = $this->getEntityManager()->createQueryBuilder('t');
        $qb = $qb->select('t', 'u', 'g', 'c', 'z')->from('HVGSystemBundle:Ticket', 't');
        $qb = $qb->join('t.unit', 'u');
        $qb = $qb->join('u.unitgroup', 'g');
        $qb = $qb->join('u.community', 'c');
        $qb = $qb->leftJoin('t.zone', 'z');
        $qb = $qb->leftJoin('z.users', 's');

        $qb = $qb->andWhere('s.id = :user');
        $qb = $qb->setParameter('user', $user->getId());

        if($unit){
            $qb = $qb->andWhere('u.id = :unit');
            $qb = $qb->setParameter('unit', $unit->getId());
        } elseif ($unitgroup) {
            $qb = $qb->andWhere('g.id = :unitgroup');
            $qb = $qb->setParameter('unitgroup', $unitgroup->getId());
        } elseif ($community) {
            $qb = $qb->andWhere('c.id = :community');
            $qb = $qb->setParameter('community', $community->getId());
        }

        if ($status) {
            $qb = $qb->andWhere('t.status = :status');
            $qb = $qb->setParameter('status', $status);
        }

        $qb = $qb->orderBy('t.'.$sort, $direction);
        return $qb->getQuery()->getResult();
    }
}
