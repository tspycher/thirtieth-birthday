<?php

namespace Tspycher\Bundle\ThirtiethBirthdayBundle\PdfGenerator;

use Orkestra\Bundle\PdfBundle\Generator\AbstractPdfGenerator;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class PdfGenerator extends AbstractPdfGenerator
{
    /**
     * Performs the PDF generation
     *
     * @param array $parameters An array of parameters to be used to render the PDF
     * @param array $options    An array of options to be passed to the underlying PdfFactory
     *
     * @return \Orkestra\Bundle\PdfBundle\Pdf\PdfInterface
     */
    protected function doGenerate(array $parameters = array(), array $options = array())
    {
        $pdf = $this->createPdf('tcpdf', $options);

        $builder = $pdf->getNativeObject();

        $builder->addPage();
        $bMargin = $builder->getBreakMargin();
        $auto_page_break = $builder->getAutoPageBreak();
        $builder->SetAutoPageBreak(false, 0);
        $img_file = __DIR__ .'/../Resources/public/img/certificate.jpg';
        $builder->Image($img_file, 0, 0, 215, 280, '', '', '', false, 300, '', false, false, 0);

        $builder->SetAutoPageBreak($auto_page_break, $bMargin);
        $builder->setPageMark();

        // Add content
        //courierB
        $builder->SetFont('courier', '', 16);
        $builder->writeHTMLCell(215, 100, 0, 125, $this->render('TspycherThirtiethBirthdayBundle:Pdf:certificate.html.twig', $parameters), 0, 0, 0, true);

        #$builder->writeHTML($this->render('TspycherThirtiethBirthdayBundle:Pdf:certificate.html.twig', $parameters), true, false, true, false, '');
        $builder->setPrintHeader(false);

        return $pdf;
    }

    public function generate(array $parameters = array(), array $options = array())
    {
        return $this->doGenerate($parameters, $options);
    }
}