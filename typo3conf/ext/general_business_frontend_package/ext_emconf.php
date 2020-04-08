<?php

/**
 * Extension Manager/Repository config file for ext "general_business_frontend_package".
 */
$EM_CONF[$_EXTKEY] = [
    'title' => 'general business frontend package',
    'description' => '一个适用于typo3 9.5.x的自定义前台模板',
    'category' => 'templates',
    'constraints' => [
        'depends' => [
            'typo3' => '9.5.0-9.5.99',
            'fluid_styled_content' => '9.5.0-9.5.99',
            'rte_ckeditor' => '9.5.0-9.5.99'
        ],
        'conflicts' => [
        ],
    ],
    'autoload' => [
        'psr-4' => [
            'Yyy\\GeneralBusinessFrontendPackage\\' => 'Classes'
        ],
    ],
    'state' => 'stable',
    'uploadfolder' => 0,
    'createDirs' => '',
    'clearCacheOnLoad' => 1,
    'author' => '三里林',
    'author_email' => 'wanghongbin816@gmail.com',
    'author_company' => '三里林',
    'version' => '1.0.0',
];
