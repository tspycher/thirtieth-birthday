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
     * @Route("/participants", defaults={ "_format" = "json" })
     */
    public function postParticipantsAction(Request $request)
    {
        $x = json_decode($request->getContent(), true);
        $r = $this->getDoctrine()->getRepository('TspycherThirtiethBirthdayBundle:People');

        if($x['id_participant'] != 0 and $x['id_people'] != 0) {
            // Edit existing
            $y = $r->participate($x['email'], $x['name'], $x['numPlaces'], $x['id_participant'], $x['id_people']);
        } else {
            // Create new
            $y = $r->participate($x['email'], $x['name'], $x['numPlaces']);
        }
        return $y;
    }

    /**
     * @Rest\View
     * @Route("/participants/{token}")
     */
    public function getParticipantAction($token) {
        $r = $this->getDoctrine()->getRepository('TspycherThirtiethBirthdayBundle:Participant');
        return $r->getByCode($token);
        #return array("count" => );

    }

    /**
     * @Rest\View
     * @Route("/participantscount")
     */
    public function getParticipantsCountAction() {
        $r = $this->getDoctrine()->getRepository('TspycherThirtiethBirthdayBundle:Participant');
        return $r->count();
        #return array("count" => );

    }
}
