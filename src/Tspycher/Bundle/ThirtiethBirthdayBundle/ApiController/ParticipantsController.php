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
        $r2 = $this->getDoctrine()->getRepository('TspycherThirtiethBirthdayBundle:Participant');

        if($x['id_participant'] != 0 and $x['id_people'] != 0) {
            // Edit existing
            $y = $r->participate($x['email'], $x['name'], $x['numPlaces'], $x['id_participant'], $x['id_people']);
        } else {
            // Create new
            $y = $r->participate($x['email'], $x['name'], $x['numPlaces']);
        }

        if($x['id_gift'] != 0) {
            $r->donate(
                $this->getDoctrine()->getRepository('TspycherThirtiethBirthdayBundle:Gift')->find($x['id_gift']),
                $y->getPeople(),
                $x['giftAmount'],
                null);
        } else {
            // remove existing donations if set
            $r->removeDonation($y->getPeople());
        }
        $this->getDoctrine()->getManager()->clear();

        $this->sendMail($x['name'], $x['email'], $r2->getByCode($y->getCode()));
        $this->sendMail($x['name'], 'me@tspycher.com', $r2->getByCode($y->getCode()));

        return $y;
    }

    private function sendMail($name, $to, $participant) {
        $message = \Swift_Message::newInstance()
            ->setSubject(sprintf("%s Danke für die Anmeldung zu meinem 30igsten Geburtstag", $name))
            ->setFrom('me@tspycher.com')
            ->setTo($to)
            ->setBody(
                $this->renderView(
                    'TspycherThirtiethBirthdayBundle:Emails:paricipant.txt.twig',
                    array(
                        'name' => $name,
                        'participant' => $participant
                    )
                )
            )
        ;
        $this->get('mailer')->send($message);
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
     * @Rest\Get("/participantcount")
     */
    public function getParticipantsCountAction() {
        $r = $this->getDoctrine()->getRepository('TspycherThirtiethBirthdayBundle:Participant');
        return $r->count();
    }
}
