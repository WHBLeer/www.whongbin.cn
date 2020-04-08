<?php
defined('TYPO3_MODE') || die();

\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addToAllTCAtypes(
    'tx_news_domain_model_news',
    $GLOBALS['TCA']['tx_news_domain_model_news']['ctrl']['type'],
    '',
    'after:' . $GLOBALS['TCA']['tx_news_domain_model_news']['ctrl']['label']
);

$tmp_sll_news_columns = [

    'reading' => [
        'exclude' => true,
        'label' => 'LLL:EXT:sll_news/Resources/Private/Language/locallang_db.xlf:tx_sllnews_domain_model_news.reading',
        'config' => [
            'type' => 'input',
            'size' => 4,
            'eval' => 'int'
        ]
    ],
    'islike' => [
        'exclude' => true,
        'label' => 'LLL:EXT:sll_news/Resources/Private/Language/locallang_db.xlf:tx_sllnews_domain_model_news.islike',
        'config' => [
            'type' => 'input',
            'size' => 4,
            'eval' => 'int'
        ]
    ],
    'dislike' => [
        'exclude' => true,
        'label' => 'LLL:EXT:news_article/Resources/Private/Language/locallang_db.xlf:tx_sllnews_domain_model_news.dislike',
        'config' => [
            'type' => 'input',
            'size' => 4,
            'eval' => 'int'
        ]
    ],
    'cover' => [
        'exclude' => true,
        'label' => 'LLL:EXT:sll_news/Resources/Private/Language/locallang_db.xlf:tx_sllnews_domain_model_news.album',
        'config' => [
            'type' => 'input',
            'size' => 4,
            'eval' => 'int'
        ]
    ],
    'annexs' => [
        'exclude' => true,
        'label' => 'LLL:EXT:sll_news/Resources/Private/Language/locallang_db.xlf:tx_sllnews_domain_model_news.annexs',
        'config' => [
            'type' => 'inline',
            'foreign_table' => 'tx_sllfilemanager_domain_model_file',
            'foreign_field' => 'news',
            'maxitems' => 9999,
            'appearance' => [
                'collapseAll' => 0,
                'levelLinksPosition' => 'top',
                'showSynchronizationLink' => 1,
                'showPossibleLocalizationRecords' => 1,
                'showAllLocalizationLink' => 1
            ],
        ],

    ],

];

\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addTCAcolumns('tx_news_domain_model_news',$tmp_sll_news_columns);
