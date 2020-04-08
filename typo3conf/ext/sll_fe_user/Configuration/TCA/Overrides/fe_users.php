<?php
defined('TYPO3_MODE') || die();

\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addToAllTCAtypes(
    'fe_users',
    '--div--; Dozentenprofil,openid, headimgurl, nickname',
    '0',
    'after:endtime'
);

$tmp_user_columns = [

    'openid' => [
        'exclude' => true,
        'label' => 'LLL:EXT:sll_fe_user/Resources/Private/Language/locallang_db.xlf:tx_sllfeuser_domain_model_user.openid',
        'config' => [
            'type' => 'input',
            'size' => 30,
            'eval' => 'trim'
        ],
    ],
    'headimgurl' => [
        'exclude' => true,
        'label' => 'LLL:EXT:sll_fe_user/Resources/Private/Language/locallang_db.xlf:tx_sllfeuser_domain_model_user.headimgurl',
        'config' => [
            'type' => 'input',
            'size' => 30,
            'eval' => 'trim'
        ],
    ],
    'nickname' => [
        'exclude' => true,
        'label' => 'LLL:EXT:sll_fe_user/Resources/Private/Language/locallang_db.xlf:tx_sllfeuser_domain_model_user.nickname',
        'config' => [
            'type' => 'input',
            'size' => 30,
            'eval' => 'trim'
        ],
    ],
    'crdate' => [
        'exclude' => true,
        'label' => 'LLL:EXT:sll_fe_user/Resources/Private/Language/locallang_db.xlf:tx_sllfeuser_domain_model_user.crdate',
        'config' => [
            'type' => 'input',
            'size' => 20,
            'eval' => 'datetime'
        ],
    ],
    'tstamp' => [
        'exclude' => true,
        'label' => 'LLL:EXT:sll_fe_user/Resources/Private/Language/locallang_db.xlf:tx_sllfeuser_domain_model_user.tstamp',
        'config' => [
            'type' => 'input',
            'size' => 20,
            'eval' => 'datetime'
        ],
    ],

];

\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addTCAcolumns('fe_users',$tmp_user_columns);
