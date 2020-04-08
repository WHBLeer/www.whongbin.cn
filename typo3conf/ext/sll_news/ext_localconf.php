<?php
if (!defined('TYPO3_MODE')) {
	die('Access denied.');
}

\TYPO3\CMS\Extbase\Utility\ExtensionUtility::configurePlugin(
	'Sll.' . $_EXTKEY,
	'News',
	array(
		'News' => 'list, index, felist, roosters, searchResult, detail, new, create, edit, update, delete, multidelete,ajax',
		
	),
	// non-cacheable actions
	array(
		'News' => 'list, index, felist, roosters, searchResult, detail, new, create, edit, update, delete, multidelete,ajax',
		
	)
);

//\TYPO3\CMS\Extbase\Utility\ExtensionUtility::registerTypeConverter('Sll\\SllNews\\Property\\TypeConverter\\UploadedFileReferenceConverter');
//\TYPO3\CMS\Extbase\Utility\ExtensionUtility::registerTypeConverter('Sll\\SllNews\\Property\\TypeConverter\\ObjectStorageConverter');
