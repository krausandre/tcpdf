<?php

$extensionPath = \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::extPath('tcpdf');

return [
    'Extcode\TCPDF\Service\TsTCPDF' => $extensionPath . 'Classes/Service/TsTCPDF.php',
    'TCPDF' => $extensionPath . 'Resources/Private/Library/tcpdf/tcpdf.php',
];
