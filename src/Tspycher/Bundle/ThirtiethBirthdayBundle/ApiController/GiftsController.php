<?php

namespace Tspycher\Bundle\ThirtiethBirthdayBundle\ApiController;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use FOS\RestBundle\Controller\FOSRestController;
use FOS\RestBundle\Controller\Annotations as Rest;

class GiftsController extends Controller {

    /**
     * @Rest\View
     * @Route("/gifts")
     */
    public function getGiftsAction()
    {
        $gifts = $this->container->get('doctrine')->getRepository('Tspycher\Bundle\ThirtiethBirthdayBundle\Entity\Gift')->findAll();
        return array( 'gift' => $gifts);
    }
}
