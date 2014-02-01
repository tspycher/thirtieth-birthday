<?php

namespace Tspycher\Bundle\ThirtiethBirthdayBundle\Tests\Entity;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

abstract class AbstractEntityTest extends WebTestCase
{

    static $container;
    static $application;

    public static function setUpBeforeClass()
    {
        //start the symfony kernel
        $kernel = static::createKernel();
        $kernel->boot();

        //get the DI container
        self::$container = $kernel->getContainer();
        self::$application = new \Symfony\Bundle\FrameworkBundle\Console\Application($kernel);
        self::$application->setAutoExit(false);

    }
}
