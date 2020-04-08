<?php
defined('TYPO3_MODE') || die();

if (!isset($GLOBALS['TCA']['fe_users']['ctrl']['type'])) {
    // no type field defined, so we define it here. This will only happen the first time the extension is installed!!
    $GLOBALS['TCA']['fe_users']['ctrl']['type'] = 'tx_extbase_type';
    $tempColumnstx_sllusermanager_fe_users = [];
    $tempColumnstx_sllusermanager_fe_users[$GLOBALS['TCA']['fe_users']['ctrl']['type']] = [
        'exclude' => true,
        'label'   => 'LLL:EXT:sll_user_manager/Resources/Private/Language/locallang_db.xlf:tx_sllusermanager.tx_extbase_type',
        'config' => [
            'type' => 'select',
            'renderType' => 'selectSingle',
            'items' => [
                ['',''],
                ['User','Tx_SllUserManager_User']
            ], 
            'default' => 'Tx_SllUserManager_User',
            'size' => 1,
            'maxitems' => 1,
        ]
    ];
    \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addTCAcolumns('fe_users', $tempColumnstx_sllusermanager_fe_users);
}

\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addToAllTCAtypes(
    'fe_users',
    $GLOBALS['TCA']['fe_users']['ctrl']['type'],
    '',
    'after:' . $GLOBALS['TCA']['fe_users']['ctrl']['label']
);

/* inherit and extend the show items from the parent class */

if (isset($GLOBALS['TCA']['fe_users']['types']['0']['showitem'])) {
    $GLOBALS['TCA']['fe_users']['types']['Tx_SllUserManager_User']['showitem'] = $GLOBALS['TCA']['fe_users']['types']['0']['showitem'];
} elseif(is_array($GLOBALS['TCA']['fe_users']['types'])) {
    // use first entry in types array
    $fe_users_type_definition = reset($GLOBALS['TCA']['fe_users']['types']);
    $GLOBALS['TCA']['fe_users']['types']['Tx_SllUserManager_User']['showitem'] = $fe_users_type_definition['showitem'];
} else {
    $GLOBALS['TCA']['fe_users']['types']['Tx_SllUserManager_User']['showitem'] = '';
}
$GLOBALS['TCA']['fe_users']['types']['Tx_SllUserManager_User']['showitem'] .= ',--div--;LLL:EXT:sll_user_manager/Resources/Private/Language/locallang_db.xlf:tx_sllusermanager_domain_model_user,';
$GLOBALS['TCA']['fe_users']['types']['Tx_SllUserManager_User']['showitem'] .= '';

$GLOBALS['TCA']['fe_users']['columns'][$GLOBALS['TCA']['fe_users']['ctrl']['type']]['config']['items'][] = ['LLL:EXT:sll_user_manager/Resources/Private/Language/locallang_db.xlf:fe_users.tx_extbase_type.Tx_SllUserManager_User','Tx_SllUserManager_User'];
