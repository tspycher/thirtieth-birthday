<?php
/**
 * Created by PhpStorm.
 * User: tspycher
 * Date: 03/02/14
 * Time: 20:51
 */
namespace Tspycher\Bundle\ThirtiethBirthdayBundle\ApiController;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use FOS\RestBundle\Controller\FOSRestController;
use FOS\RestBundle\Controller\Annotations as Rest;
use Symfony\Component\HttpFoundation\Request;

class ParticipantsController extends Controller {

    /**
     * @Rest\View
     * @Route("/participants")
     */
    public function postParticipantsAction(Request $request)
    {
        return array( 'data' => "blubb");
    }
}
