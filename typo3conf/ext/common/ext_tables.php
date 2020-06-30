<?php
defined('TYPO3_MODE') || die('Access denied.');

call_user_func(
    function()
    {

        \TYPO3\CMS\Extbase\Utility\ExtensionUtility::registerPlugin(
            'Sll.Common',
            'Pi1',
            '系统配置'
        );

        $pluginSignature = str_replace('_', '', 'common') . '_pi1';
        $GLOBALS['TCA']['tt_content']['types']['list']['subtypes_addlist'][$pluginSignature] = 'pi_flexform';
        \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addPiFlexFormValue($pluginSignature, 'FILE:EXT:common/Configuration/FlexForms/flexform_pi1.xml');

        \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addStaticFile('common', 'Configuration/TypoScript', '通用配置');

        /***************
        * Add own stylesheet(s) to TYPO3 backend
        */
        $GLOBALS['TBE_STYLES']['skins']['common'] = array();
        $GLOBALS['TBE_STYLES']['skins']['common']['name'] = 'whb-skins';
        $GLOBALS['TBE_STYLES']['skins']['common']['stylesheetDirectories'] = array(
            'EXT:common/Resources/Public/Stylesheet/Backend/style.css'
        );
    }
);
