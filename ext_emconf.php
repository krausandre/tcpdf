<?php

$EM_CONF[$_EXTKEY] = [
    'title' => 'TCPDF',
    'description' => 'Wrapper Extension for tcpdf',
    'category' => 'services',
    'author' => 'Daniel Lorenz',
    'author_email' => 'ext.tcpdf@extco.de',
    'author_company' => 'extco.de UG (haftungsbeschränkt)',
    'shy' => '',
    'priority' => '',
    'module' => '',
    'state' => 'beta',
    'internal' => '',
    'uploadfolder' => '0',
    'createDirs' => '',
    'modify_tables' => '',
    'clearCacheOnLoad' => 0,
    'lockType' => '',
    'version' => '0.3.0',
    'constraints' => [
        'depends' => [
            'typo3' => '6.2.0-7.99.99',
            'php' => '5.6.0'
        ],
        'conflicts' => [],
        'suggests' => [],
    ],
    'autoload' => [
        'psr-4' => [
            "Extcode\\TCPDF\\" => "Classes",
        ],
        'classmap' => [
            'Resources/Private/Library/tcpdf',
        ]
    ],
];
