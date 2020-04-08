<?php
defined('TYPO3_MODE') || die('Access denied.');

call_user_func(
    function()
    {

        \TYPO3\CMS\Extbase\Utility\ExtensionUtility::configurePlugin(
            'Sll.SllFeUser',
            'Pi1',
            [
                'User' => 'list, show, new, create, edit, update, delete, interface, ajax',
                'Group' => 'list, show, new, create, edit, update, delete'
            ],
            // non-cacheable actions
            [
                'User' => 'list, show, new, create, edit, update, delete, interface, ajax',
                'Group' => 'list, show, new, create, edit, update, delete'
            ]
        );

    // wizards
    \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addPageTSConfig(
        'mod {
            wizards.newContentElement.wizardItems.plugins {
                elements {
                    pi1 {
                        iconIdentifier = sll_fe_user-plugin-pi1
                        title = LLL:EXT:sll_fe_user/Resources/Private/Language/locallang_db.xlf:tx_sll_fe_user_pi1.name
                        description = LLL:EXT:sll_fe_user/Resources/Private/Language/locallang_db.xlf:tx_sll_fe_user_pi1.description
                        tt_content_defValues {
                            CType = list
                            list_type = sllfeuser_pi1
                        }
                    }
                }
                show = *
            }
       }'
    );
		$iconRegistry = \TYPO3\CMS\Core\Utility\GeneralUtility::makeInstance(\TYPO3\CMS\Core\Imaging\IconRegistry::class);
		
			$iconRegistry->registerIcon(
				'sll_fe_user-plugin-pi1',
				\TYPO3\CMS\Core\Imaging\IconProvider\SvgIconProvider::class,
				['source' => 'EXT:sll_fe_user/Resources/Public/Icons/user_plugin_pi1.svg']
			);
		
    }
);
