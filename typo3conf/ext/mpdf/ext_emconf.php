<?php

$EM_CONF[$_EXTKEY] = [
    'title' => 'MPDF',
    'description' => 'mPDF is a PHP library which generates PDF files from UTF-8 encoded HTML. It is based on FPDF and HTML2FPDF with a number of enhancements. More: https://mpdf.github.io/',
    'category' => 'tools',
    'author' => 'Filmmusic.io',
    'author_email' => 'info@filmmusic.io',
    'state' => 'stable',
    'internal' => '',
    'uploadfolder' => '0',
    'createDirs' => '',
    'clearCacheOnLoad' => 0,
    'version' => '8.0.1',
    'constraints' => [
        'depends' => [
            'typo3' => '8.6.0-9.9.9',
        ],
        'conflicts' => [],
        'suggests' => [],
    ],
];
