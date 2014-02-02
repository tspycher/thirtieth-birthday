<?php
/**
 * Created by PhpStorm.
 * User: tspycher
 * Date: 02/02/14
 * Time: 16:56
 */
namespace Tspycher\Bundle\ThirtiethBirthdayBundle\DataFixtures;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
#use Tspycher\Bundle\ThirtiethBirthdayBundle\Entity\Person;
#use Tspycher\Bundle\ThirtiethBirthdayBundle\Entity\Participant;


class LoadPersonData extends AbstractFixture implements OrderedFixtureInterface
{
    /**
     * {@inheritDoc}
     */
    public function load(ObjectManager $manager)
    {
        $gift = $this->getReference('gift');
        $r = $manager->getRepository('TspycherThirtiethBirthdayBundle:People');

        for($i = 0; $i<=10; $i++) {
            $x = $r->participate(sprintf("user-%s@email.com", $i), sprintf("Mr %s", $i), 2);
            $r->donate($gift, $x->getPeople(), 200, "This is for you");
        }
    }

    /**
     * {@inheritDoc}
     */
    public function getOrder()
    {
        return 20;
    }
}