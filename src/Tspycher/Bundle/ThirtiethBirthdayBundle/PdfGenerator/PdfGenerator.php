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
        // Use the createPdf method to create the desired type of PDF
        $pdf = $this->createPdf('tcpdf', $options);

        /** @var \TCPDF $builder */
        $builder = $pdf->getNativeObject();

        $builder->addPage();

        $builder->writeHtmlCell(0, 0, 0, 20, $this->render('TspycherThirtiethBirthdayBundle:Pdf:certificate.html.twig', $parameters));
        #$builder->writeHtmlCell(0, 0, 20, 43, $this->render('MyBundle:Pdf/Invoice:invoiceIntro.html.twig', $parameters));
        #$builder->writeHtmlCell(0, 0, 20, 66, $this->render('MyBundle:Pdf/Invoice:invoiceBody.html.twig', $parameters));
        #$builder->writeHtmlCell(0, 0, 20, 165, $this->render('MyBundle:Pdf/Invoice:invoiceFooter.html.twig', $parameters));

        $builder->line(0, 190.5, 215.9, 190.5, array('dash' => 3));

        #$builder->writeHtmlCell(0, 0, 21, 200, $this->render('MyBundle:Pdf/Invoice/Detachment:detachmentCompany.html.twig', $parameters));
        #$builder->writeHtmlCell(0, 0, 0, 200, $this->render('MyBundle:Pdf/Invoice/Detachment:detachmentHead.html.twig', $parameters));
        #$builder->writeHtmlCell(0, 0, 19.5, 230, $this->render('MyBundle:Pdf/Invoice/Detachment:detachmentInfo.html.twig', $parameters));
        #$builder->writeHtmlCell(0, 0, 22, 210, $this->render('MyBundle:Pdf/Invoice/Detachment:detachmentDetails.html.twig', $parameters));


        // Call any native methods on the underlying library object
        #builder = $pdf->getNativeObject();
        #$builder->useTemporaryFile();
        #$builder->setInput($this->render('TspycherThirtiethBirthdayBundle:Pdf/certificate.html.twig', $parameters));

        // Return the original PDF, calling getContents to retrieve the rendered content
        return $pdf;
    }

    /**
     * Configure the parameters OptionsResolver.
     *
     * Use this method to specify default and required options
     *
     * @param \Symfony\Component\OptionsResolver\OptionsResolverInterface $resolver
     */
    protected function setDefaultParameters(OptionsResolverInterface $resolver)
    {
        $resolver->setRequired(array( ));
        $resolver->setAllowedTypes(array( ));
    }
}