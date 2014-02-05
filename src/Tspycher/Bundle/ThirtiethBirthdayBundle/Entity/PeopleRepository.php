<?php

namespace Tspycher\Bundle\ThirtiethBirthdayBundle\Entity;

use Doctrine\ORM\EntityRepository;

/**
 * PeopleRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class PeopleRepository extends EntityRepository
{

    /**
     * Overloading $this->doante Method
     * @param $method
     * @param $args
     * @return array|object|void
     */
    public function __call($method, $args)
    {
        // Note: value of $name is case sensitive.
        if ($method == "donate")
            print "Calling object method '$method' " . implode(', ', $args). "\n";

        #return false;
        return call_user_func_array(array($this, $method), $args);
    }

    public function donate(Gift $gift, People $people, $amount, $message) {
        $d = $this->getEntityManager()->getRepository('TspycherThirtiethBirthdayBundle:Donate')
            ->findOneBy(array('people' => $people->getId()));

        if(is_null($d)) {
            $d = new Donate();
            $d->setPeople($people);
        }
        $d->setGift($gift);
        $d->setAmount($amount);
        $d->setMessage($message);

        $this->getEntityManager()->persist($d);
        $this->getEntityManager()->flush();
        return $d;
    }

    public function participate($email, $name, $numSeats, $id_participant = null, $id_people = null) {
        if(!is_null($id_participant) and !is_null($id_people) ) {
            $p = $this->find($id_people);
            $pa = $this->getEntityManager()->getRepository('TspycherThirtiethBirthdayBundle:Participant')->find($id_participant);
        } else {
            $p = new People();
            $pa = new Participant();
            $pa->createCode();
        }

        $p->setName($name);
        $p->setEmail($email);

        $pa->setNumberOfSeats($numSeats);
        $pa->setPeople($p);

        $this->getEntityManager()->persist($pa);
        $this->getEntityManager()->flush();
        return $pa;

    }


}
