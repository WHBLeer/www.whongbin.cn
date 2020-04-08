<?php
defined('TYPO3_MODE') or die();
$extKey = 'sll_snow';
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addStaticFile($extKey, 'Configuration/TypoScript', 'Snow Flake');