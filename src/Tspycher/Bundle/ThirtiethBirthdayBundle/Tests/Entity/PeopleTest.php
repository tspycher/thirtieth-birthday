<?php

namespace Tspycher\Bundle\ThirtiethBirthdayBundle\Tests\Entity;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Tspycher\Bundle\ThirtiethBirthdayBundle\Entity\Gift;

class PeopleTest extends AbstractEntityTest
{
    public $em;

    public function setUp() {
        $this->em = self::$container->get('doctrine')
            ->getManager('default');
    }

    public function testCreatePerson() {
        // Create Gift
        $gift= new Gift();
        $this->em->persist($gift);
        $this->em->flush();

        #$rg = $this->em->getRepository('TspycherThirtiethBirthdayBundle:Gift');
        #$gift = $rg->findOneBy(array());
        #\Doctrine\Common\Util\Debug::dump($g);

        $r = $this->em->getRepository('TspycherThirtiethBirthdayBundle:People');
        $x = $r->participate("user@email.com", "Fam. Miller", 5);
        #\Doctrine\Common\Util\Debug::dump($x);

        $d = $r->donate($gift, $x->getPeople(), 200, "This is for you");
        #\Doctrine\Common\Util\Debug::dump($d);

        $r2 = $this->em->getRepository('TspycherThirtiethBirthdayBundle:Participant');
        #\Doctrine\Common\Util\Debug::dump($r2->findOneByCode($x->getCode()), 4);


        #\Doctrine\Common\Util\Debug::dump($r->findOneBy(array()), 3);

        \Doctrine\Common\Util\Debug::dump($r2->getByCode($x->getCode()), 4);

    }


}
