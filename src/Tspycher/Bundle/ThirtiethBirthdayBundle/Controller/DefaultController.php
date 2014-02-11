<?php

namespace Tspycher\Bundle\ThirtiethBirthdayBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class DefaultController extends Controller
{
    /**
     * @Route("/")
     * @Template()
     */
    public function indexAction()
    {
        return array();
    }

    /**
     * @Route("/certificate/{code}")
     * @param $code
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function certificate($code) {

        $generator = $this->get('pdfGenerator');

        $r = $this->getDoctrine()->getRepository('TspycherThirtiethBirthdayBundle:Participant');
        $x = $r->getByCode($code);
        if(is_null($x)) {
            throw new NotFoundHttpException('Sorry not existing!');
        }
        $pdf = $generator->generate(array("participant" => $x));
        return new Response($pdf->getContents(), 200, array('Content-type' => 'application/pdf'));
    }
}
