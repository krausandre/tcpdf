.. ==================================================
.. FOR YOUR INFORMATION
.. --------------------------------------------------
.. -*- coding: utf-8 -*- with BOM.

TsTCPDF
=======

Die Verwendung von TsTCPDF ist die Möglichkeit TCPDF zu verwenden unter der Verwendung von TypoScript und HTML-Templates
für die Ausgabe. Es stehen aber auch die normalen Möglichkeiten von TCPDF zur Verfügung.

.. code-block:: php

    $pdf = $this->objectManager->get(
        \Extcode\TCPDF\Service\TsTCPDF::class
    );
    $pdf->setSettings($pluginSettings);
    $pdf->setPdfType($pdfType);

|

Eine Beispielkongiguration für den Header und Footer des Dokuments könnten wie folgt aussehen. (Das Beispiel ist auf CartPdf übernommen.)

::

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

|
