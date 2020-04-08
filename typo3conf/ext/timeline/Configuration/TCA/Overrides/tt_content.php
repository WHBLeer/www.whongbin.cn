<?php

\TYPO3\CMS\Extbase\Utility\ExtensionUtility::registerPlugin(
    'DominicJoas.Timeline',
    'Pi1',
    'Timeline',
    'timeline-icon'
);

\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addTCAcolumns('tt_content', array(
    'tx_timeline_timelineevents' => array(
        'exclude' => 0,
        'label' => 'LLL:EXT:timeline/Resources/Private/Language/locallang_db.xlf:tx_timeline_domain_model_timelineevent',
        'config' => array(
            'type' => 'inline',
            'foreign_table' => 'tx_timeline_domain_model_timelineevent',
            'foreign_field' => 'timetable_id',
            'foreign_label' => 'title',
            'foreign_sortby' => 'sorting',
            'maxitems' => '100',
            'appearance' => array(
                #'collapseAll' => 0,
                'expandSingle' => true,
                'useSortable' => true,
                'newRecordLinkAddTitle' => 1,
                'newRecordLinkPosition' => 'both',
                'showAllLocalizationLink' => true,
                'showPossibleLocalizationRecords' => true,
                'enabledControls' => [
                    'info' => true,
                    'new' => true,
                    'dragdrop' => true,
                    'sort' => true,
                    'hide' => true,
                    'delete' => true,
                    'localize' => true,
                ],
            ),
            'behaviour' => array(
                'localizationMode' => 'select',
                'localizeChildrenAtParentLocalization' => true,
            ),
        )
    ),
));