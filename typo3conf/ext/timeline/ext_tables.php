<?php

defined('TYPO3_MODE') || die('Access denied.');

call_user_func(function($extKey) {
    TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addStaticFile($extKey, "Configuration/Typoscript", "TimeLine");
    TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addLLrefForTCAdescr('tx_timeline_domain_model_timelineevent', 'EXT:timeline/Resources/Private/Language/locallang_db.xlf');
    TYPO3\CMS\Core\Utility\ExtensionManagementUtility::allowTableOnStandardPages('tx_timeline_domain_model_timelineevent');
    \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addPiFlexFormValue("*", 'FILE:EXT:' . $extKey . '/Configuration/FlexForms/flexform_timeline.xml');
}, $_EXTKEY);

$iconRegistry = \TYPO3\CMS\Core\Utility\GeneralUtility::makeInstance(\TYPO3\CMS\Core\Imaging\IconRegistry::class);
$iconRegistry->registerIcon("timeline-icon", \TYPO3\CMS\Core\Imaging\IconProvider\SvgIconProvider::class, ['source' => 'EXT:timeline/Resources/Public/Icons/Timeline.svg']);

$GLOBALS['TCA']['tt_content']['types']['list']['subtypes_excludelist']["timeline_pi1"] = 'recursive';
$GLOBALS['TCA']['tt_content']['types']['list']['subtypes_addlist']["timeline_pi1"] = 'pi_flexform,tx_timeline_timelineevents';