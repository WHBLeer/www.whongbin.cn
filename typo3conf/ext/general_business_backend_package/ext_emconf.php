<?php

/**
 * Extension Manager/Repository config file for ext "general_business_backend_package".
 */
$EM_CONF[$_EXTKEY] = [
    'title' => 'General Business Backend Package',
    'description' => '一个适用于typo3 9.5.x的通用业务后台模板',
    'category' => 'templates',
    'constraints' => [
        'depends' => [
            'typo3' => '9.5.0-9.5.99',
            'fluid_styled_content' => '9.5.0-9.5.99',
            'rte_ckeditor' => '9.5.0-9.5.99',
            // 'news' => '7.3.0-7.3.99'
        ],
        'conflicts' => [
        ],
    ],
    'autoload' => [
        'psr-4' => [
            'Yyy\\GeneralBusinessBackendPackage\\' => 'Classes'
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
