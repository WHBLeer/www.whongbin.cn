<?php
defined('TYPO3_MODE') || die('Access denied.');

call_user_func(
    function()
    {

        \TYPO3\CMS\Extbase\Utility\ExtensionUtility::configurePlugin(
            'Sll.SllFriendLink',
            'Pi1',
            [
                'Links' => 'list, show, new, create, edit, update, deleted, footer, qlist',
                'Type' => 'list, new, create, edit, update, deleted'
            ],
            // non-cacheable actions
            [
                'Links' => 'list, show, new, create, edit, update, deleted, footer, qlist',
                'Type' => 'list, new, create, edit, update, deleted'
            ]
        );

    // wizards
    \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addPageTSConfig(
        'mod {
            wizards.newContentElement.wizardItems.plugins {
                elements {
                    pi1 {
                        iconIdentifier = sll_friend_link-plugin-pi1
                        title = LLL:EXT:sll_friend_link/Resources/Private/Language/locallang_db.xlf:tx_sll_friend_link_pi1.name
                        description = LLL:EXT:sll_friend_link/Resources/Private/Language/locallang_db.xlf:tx_sll_friend_link_pi1.description
                        tt_content_defValues {
                            CType = list
                            list_type = sllfriendlink_pi1
                        }
                    }
                }
                show = *
            }
       }'
    );
		$iconRegistry = \TYPO3\CMS\Core\Utility\GeneralUtility::makeInstance(\TYPO3\CMS\Core\Imaging\IconRegistry::class);
		
			$iconRegistry->registerIcon(
				'sll_friend_link-plugin-pi1',
				\TYPO3\CMS\Core\Imaging\IconProvider\SvgIconProvider::class,
				['source' => 'EXT:sll_friend_link/Resources/Public/Icons/user_plugin_pi1.svg']
			);
		
    }
);
