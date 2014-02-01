<?php

namespace Tspycher\Bundle\ThirtiethBirthdayBundle\Tests\Entity;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class PeopleTest extends AbstractEntityTest
{
    public $em;

    public function setUp() {
        $this->em = self::$container->get('doctrine')
            ->getManager('default');
    }

    public function testCreatePerson() {
        $r = $this->em->getRepository('TspycherThirtiethBirthdayBundle:People');
        
    }


}
