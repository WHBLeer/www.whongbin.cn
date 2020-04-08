<?php
defined('TYPO3_MODE') || die('Access denied.');

call_user_func(
    function()
    {

        \TYPO3\CMS\Extbase\Utility\ExtensionUtility::registerPlugin(
            'Sll.SllFriendLink',
            'Pi1',
            '友情链接'
        );

        $pluginSignature = str_replace('_', '', 'sll_friend_link') . '_pi1';
        $GLOBALS['TCA']['tt_content']['types']['list']['subtypes_addlist'][$pluginSignature] = 'pi_flexform';
        \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addPiFlexFormValue($pluginSignature, 'FILE:EXT:sll_friend_link/Configuration/FlexForms/flexform_pi1.xml');

        \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addStaticFile('sll_friend_link', 'Configuration/TypoScript', 'Friendly link');

        \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addLLrefForTCAdescr('tx_sllfriendlink_domain_model_links', 'EXT:sll_friend_link/Resources/Private/Language/locallang_csh_tx_sllfriendlink_domain_model_links.xlf');
        \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::allowTableOnStandardPages('tx_sllfriendlink_domain_model_links');

        \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addLLrefForTCAdescr('tx_sllfriendlink_domain_model_type', 'EXT:sll_friend_link/Resources/Private/Language/locallang_csh_tx_sllfriendlink_domain_model_type.xlf');
        \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::allowTableOnStandardPages('tx_sllfriendlink_domain_model_type');

    }
);
