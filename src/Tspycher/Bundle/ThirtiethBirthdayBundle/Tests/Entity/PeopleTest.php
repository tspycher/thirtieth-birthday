<?php

namespace Tspycher\Bundle\ThirtiethBirthdayBundle\Tests\Entity;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Bundle\SecurityBundle\Tests\DependencyInjection\MainConfigurationTest;
use Tspycher\Bundle\ThirtiethBirthdayBundle\Entity\Gift;

class PeopleTest extends AbstractEntityTest
{
    public $em;

    public function setUp() {
        $this->em = self::$container->get('doctrine')
            ->getManager('default');

        $loader = new \Doctrine\Common\DataFixtures\Loader;
        $loader->loadFromDirectory( __DIR__ . "/../../DataFixtures/ORM");
        $purger = new \Doctrine\Common\DataFixtures\Purger\ORMPurger($this->em);
        $executor = new \Doctrine\Common\DataFixtures\Executor\ORMExecutor($this->em, $purger);
        $executor->execute($loader->getFixtures());
    }

    public function testCreatePerson() {
        $r = $this->em->getRepository('TspycherThirtiethBirthdayBundle:People');
        $r2 = $this->em->getRepository('TspycherThirtiethBirthdayBundle:Participant');
        $x = $r->findOneBy(array());
        #\Doctrine\Common\Util\Debug::dump($x, 4);

        \Doctrine\Common\Util\Debug::dump($r2->getByCode($x->getParticipant()->getCode()), 4);

    }


}
