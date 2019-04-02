.. include:: ../../../Includes.txt

TsTCPDF
=======

The use of TsTCPDF is the ability to use TCPDF using TypoScript and HTML templates
for the issue. But there are also the normal possibilities of TCPDF available.

.. code-block:: php

    $pdf = $this->objectManager->get(
        \Extcode\TCPDF\Service\TsTCPDF::class
    );
    $pdf->setSettings($pluginSettings);
    $pdf->setPdfType($pdfType);


A sample configuration for the header and footer of the document might look like this.
This example is taken from Cart Pdf extension.

.. code-block:: typoscript

    invoicePdf {
        debug = 0

        fontSize = 10

        header {
            margin = 30mm
            html {
                logo {
                    width = 50
                    positionX = 10
                    positionY = 5
                    templatePath = /InvoicePdf/Header/
                    file = EXT:cart/Documentation/Images/cart_logo.png
                }

                content {
                    width = 120
                    positionX = 80
                    positionY = 5
                    templatePath = /InvoicePdf/Header/
                    fontSize = 8
                    align = R
                }
            }

            line {
                1 {
                    x1 = 10
                    y1 = 24
                    x2 = 200
                    y2 = 24
                    style {
                        width = 0.5
                    }
                }
            }
        }

        footer {
            margin = 40mm

            html {
                content {
                    width = 190
                    height = 35
                    positionX = 15
                    positionY = 265
                    templatePath = /InvoicePdf/Footer/
                    fontSize = 8
                }

                page {
                    width = 100
                    height = 10
                    positionX = 115
                    positionY = 290
                    templatePath = /InvoicePdf/Footer/
                    fontSize = 8
                    align = R
                }
            }

            line {
                1 {
                    x1 = 10
                    y1 = 262
                    x2 = 200
                    y2 = 262
                    style {
                        width = 0.5
                    }
                }
            }
        }
    }
