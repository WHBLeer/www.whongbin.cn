<?php
defined('TYPO3_MODE') || die();

//pages
$columns_news = array(
    'hit' => array (
        'exclude' => 1,
        'label' => 'LLL:EXT:general_business_backend_package/Resources/Private/Language/locallang_db.xlf:tx_general_business_backend_package_pi2.hit',
        'config' => [
                'type' => 'input',
                'size' => 4,
                'eval' => 'int'
            ]
    ),
    'album' => array (
        'exclude' => 1,
        'label' => 'LLL:EXT:general_business_backend_package/Resources/Private/Language/locallang_db.xlf:tx_general_business_backend_package_pi2.album',
        'config' => [
                'type' => 'input',
                'size' => 30,
                'eval' => 'trim'
            ],
    ),
);

\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addTCAcolumns('tx_news_domain_model_news',$columns_news);
