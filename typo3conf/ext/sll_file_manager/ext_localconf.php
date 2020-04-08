<?php
defined('TYPO3_MODE') || die('Access denied.');

call_user_func(
    function()
    {

        \TYPO3\CMS\Extbase\Utility\ExtensionUtility::configurePlugin(
            'Sll.SllFileManager',
            'Pi1',
            [
                'File' => 'list, new, create, edit, update, delete, interface, ajax, multidelete'
            ],
            // non-cacheable actions
            [
                'File' => 'list, new, create, edit, update, delete, interface, ajax, multidelete'
            ]
        );

    // wizards
    \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addPageTSConfig(
        'mod {
            wizards.newContentElement.wizardItems.plugins {
                elements {
                    pi1 {
                        iconIdentifier = sll_file_manager-plugin-pi1
                        title = LLL:EXT:sll_file_manager/Resources/Private/Language/locallang_db.xlf:tx_sll_file_manager_pi1.name
                        description = LLL:EXT:sll_file_manager/Resources/Private/Language/locallang_db.xlf:tx_sll_file_manager_pi1.description
                        tt_content_defValues {
                            CType = list
                            list_type = sllfilemanager_pi1
                        }
                    }
                }
                show = *
            }
       }'
    );
		$iconRegistry = \TYPO3\CMS\Core\Utility\GeneralUtility::makeInstance(\TYPO3\CMS\Core\Imaging\IconRegistry::class);
		
			$iconRegistry->registerIcon(
				'sll_file_manager-plugin-pi1',
				\TYPO3\CMS\Core\Imaging\IconProvider\SvgIconProvider::class,
				['source' => 'EXT:sll_file_manager/Resources/Public/Icons/user_plugin_pi1.svg']
			);
		
    }
);
