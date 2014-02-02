<?php
/**
 * Created by PhpStorm.
 * User: tspycher
 * Date: 02/02/14
 * Time: 16:56
 */
namespace Tspycher\Bundle\ThirtiethBirthdayBundle\DataFixtures;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Tspycher\Bundle\ThirtiethBirthdayBundle\Entity\Gift;

class LoadGiftData extends AbstractFixture implements OrderedFixtureInterface
{
    /**
     * {@inheritDoc}
     */
    public function load(ObjectManager $manager)
    {
        $gift = new Gift();
        $gift->setPrice(2200);
        $gift->setUrl("http://canon.ch");
        $gift->setName("Canon EF 70-200mm f/2.8L II USM");
        $gift->setPictureUrl("http://canon.ch");

        $this->addReference('gift', $gift);

        $manager->persist($gift);
        $manager->flush();
    }

    /**
     * {@inheritDoc}
     */
    public function getOrder()
    {
        return 10;
    }
}