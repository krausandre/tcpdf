.. include:: ../../../Includes.txt

TCPDF
=====

Using TCPDF is the easiest way to use TCPDF.

.. code-block:: php

    $pdf = $this->objectManager->get(
        \Extcode\TCPDF\Service\TCPDF::class
    );

In this way, the full functionality of TCPDF is available in pdf.

If the PDF is to be built using TypoScript and HTML templates, you should have a look at: doc: `../TsTCPDF/Index`.
