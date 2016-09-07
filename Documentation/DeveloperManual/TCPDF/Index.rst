.. ==================================================
.. FOR YOUR INFORMATION
.. --------------------------------------------------
.. -*- coding: utf-8 -*- with BOM.

TCPDF
=====

Die Verwendung von TCPDF ist die einfachste Möglichkeit TCPDF zu verwenden.

::

    $pdf = $this->objectManager->get(
        \Extcode\TCPDF\Service\TCPDF::class
    );

|
Damit steht in $pdf dann der ganze Funktionsumfang von TCPDF zur Verfügung.

Soll das PDF über TypoScript und HTML-Templates gebaut werden, sollte :doc:`../TsTCPDF/Index` verwendet werden.