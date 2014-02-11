<?php

namespace Tspycher\Bundle\ThirtiethBirthdayBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\Response;

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

        $pdf = $generator->generate();

        // Write the PDF to a file
        #file_put_contents('/some/path/to.pdf', $pdf->getContents());

        // Output the PDF to the browser
        return new Response($pdf->getContents(), 200, array('Content-type' => 'application/pdf'));
    }
}
