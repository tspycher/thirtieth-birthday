<?php

namespace Tspycher\Bundle\ThirtiethBirthdayBundle\Entity;

use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\NoResultException;

/**
 * PeopleRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class ParticipantRepository extends EntityRepository
{

    public function getByCode($code) {
        try {
            $query = $this->createQueryBuilder('p')
                ->where('p.code = :code')
                ->setParameter('code', $code)
                ->getQuery()
                ->getSingleResult();
            return $query;
        } catch (NoResultException $e) {
            return null;
        }
        #return $this->findOneBy(array('code'=>$code));
    }

    public function count() {
        $x = 0;
        foreach($this->findAll() as $p)
            $x += $p->getNumberOfSeats();

        return array('seats' => $x, 'participants' => count($this->findAll()));
    }
}
