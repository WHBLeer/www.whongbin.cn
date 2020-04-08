<?php
defined('TYPO3_MODE') || die('Access denied.');

call_user_func(
    function()
    {

        \TYPO3\CMS\Extbase\Utility\ExtensionUtility::registerPlugin(
            'Sll.SllFileManager',
            'Pi1',
            '文件管理'
        );

        $pluginSignature = str_replace('_', '', 'sll_file_manager') . '_pi1';
        $GLOBALS['TCA']['tt_content']['types']['list']['subtypes_addlist'][$pluginSignature] = 'pi_flexform';
        \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addPiFlexFormValue($pluginSignature, 'FILE:EXT:sll_file_manager/Configuration/FlexForms/flexform_pi1.xml');

        \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addStaticFile('sll_file_manager', 'Configuration/TypoScript', 'File Manager');

        \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addLLrefForTCAdescr('tx_sllfilemanager_domain_model_file', 'EXT:sll_file_manager/Resources/Private/Language/locallang_csh_tx_sllfilemanager_domain_model_file.xlf');
        \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::allowTableOnStandardPages('tx_sllfilemanager_domain_model_file');

    }
);
