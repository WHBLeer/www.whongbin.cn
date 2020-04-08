<?php

use GeorgRinger\News\Domain\Repository\NewsRepository;

defined('TYPO3_MODE') || die('Access denied.');

call_user_func(function($extKey) {
    \TYPO3\CMS\Extbase\Utility\ExtensionUtility::configurePlugin(
        'DominicJoas.Timeline', 'Pi1', ['Timeline' => 'list',], ['Timeline' => '',]
    );

    // wizards
    \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addPageTSConfig(
        'mod {
            wizards.newContentElement.wizardItems.plugins {
		    elements {
                    timeline {
                        iconIdentifier = timeline-icon
                        title = LLL:EXT:timeline/Resources/Private/Language/locallang_db.xlf:tx_timeline_domain_model_timeline
                        description = LLL:EXT:timeline/Resources/Private/Language/locallang_db.xlf:tx_timeline_domain_model_timelineevent.description
                        tt_content_defValues {
                            CType = list
                            list_type = timeline_pi1
                        }
                    }
                }
                show = *
            }
        }'
    );
}, $_EXTKEY);

\TYPO3\CMS\Core\Utility\GeneralUtility::makeInstance(\TYPO3\CMS\Extbase\Object\Container\Container::class)->registerImplementation(NewsRepository::class, NewsRepository::class);
