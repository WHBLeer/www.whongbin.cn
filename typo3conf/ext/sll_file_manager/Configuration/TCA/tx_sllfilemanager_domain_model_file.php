<?php
return [
    'ctrl' => [
        'title' => 'LLL:EXT:sll_file_manager/Resources/Private/Language/locallang_db.xlf:tx_sllfilemanager_domain_model_file',
        'label' => 'title',
        'tstamp' => 'tstamp',
        'crdate' => 'crdate',
        'cruser_id' => 'cruser_id',
        'versioningWS' => true,
        'languageField' => 'sys_language_uid',
        'transOrigPointerField' => 'l10n_parent',
        'transOrigDiffSourceField' => 'l10n_diffsource',
        'delete' => 'deleted',
        'enablecolumns' => [
            'disabled' => 'hidden',
            'starttime' => 'starttime',
            'endtime' => 'endtime',
        ],
        'searchFields' => 'title,slug,absolute_path,relative_path,teaser,file_extension',
        'iconfile' => 'EXT:sll_file_manager/Resources/Public/Icons/tx_sllfilemanager_domain_model_file.gif'
    ],
    'interface' => [
        'showRecordFieldList' => 'sys_language_uid, l10n_parent, l10n_diffsource, hidden, title, slug, size, absolute_path, relative_path, teaser, download, file_type, file_extension',
    ],
    'types' => [
        '1' => ['showitem' => 'sys_language_uid, l10n_parent, l10n_diffsource, hidden, title, slug, size, absolute_path, relative_path, teaser, download, file_type, file_extension, --div--;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:tabs.access, starttime, endtime'],
    ],
    'columns' => [
        'sys_language_uid' => [
            'exclude' => true,
            'label' => 'LLL:EXT:core/Resources/Private/Language/locallang_general.xlf:LGL.language',
            'config' => [
                'type' => 'select',
                'renderType' => 'selectSingle',
                'special' => 'languages',
                'items' => [
                    [
                        'LLL:EXT:core/Resources/Private/Language/locallang_general.xlf:LGL.allLanguages',
                        -1,
                        'flags-multiple'
                    ]
                ],
                'default' => 0,
            ],
        ],
        'l10n_parent' => [
            'displayCond' => 'FIELD:sys_language_uid:>:0',
            'exclude' => true,
            'label' => 'LLL:EXT:core/Resources/Private/Language/locallang_general.xlf:LGL.l18n_parent',
            'config' => [
                'type' => 'select',
                'renderType' => 'selectSingle',
                'default' => 0,
                'items' => [
                    ['', 0],
                ],
                'foreign_table' => 'tx_sllfilemanager_domain_model_file',
                'foreign_table_where' => 'AND {#tx_sllfilemanager_domain_model_file}.{#pid}=###CURRENT_PID### AND {#tx_sllfilemanager_domain_model_file}.{#sys_language_uid} IN (-1,0)',
            ],
        ],
        'l10n_diffsource' => [
            'config' => [
                'type' => 'passthrough',
            ],
        ],
        't3ver_label' => [
            'label' => 'LLL:EXT:core/Resources/Private/Language/locallang_general.xlf:LGL.versionLabel',
            'config' => [
                'type' => 'input',
                'size' => 30,
                'max' => 255,
            ],
        ],
        'hidden' => [
            'exclude' => true,
            'label' => 'LLL:EXT:core/Resources/Private/Language/locallang_general.xlf:LGL.visible',
            'config' => [
                'type' => 'check',
                'renderType' => 'checkboxToggle',
                'items' => [
                    [
                        0 => '',
                        1 => '',
                        'invertStateDisplay' => true
                    ]
                ],
            ],
        ],
        'starttime' => [
            'exclude' => true,
            'label' => 'LLL:EXT:core/Resources/Private/Language/locallang_general.xlf:LGL.starttime',
            'config' => [
                'type' => 'input',
                'renderType' => 'inputDateTime',
                'eval' => 'datetime,int',
                'default' => 0,
                'behaviour' => [
                    'allowLanguageSynchronization' => true
                ]
            ],
        ],
        'endtime' => [
            'exclude' => true,
            'label' => 'LLL:EXT:core/Resources/Private/Language/locallang_general.xlf:LGL.endtime',
            'config' => [
                'type' => 'input',
                'renderType' => 'inputDateTime',
                'eval' => 'datetime,int',
                'default' => 0,
                'range' => [
                    'upper' => mktime(0, 0, 0, 1, 1, 2038)
                ],
                'behaviour' => [
                    'allowLanguageSynchronization' => true
                ]
            ],
        ],

        'title' => [
            'exclude' => true,
            'label' => 'LLL:EXT:sll_file_manager/Resources/Private/Language/locallang_db.xlf:tx_sllfilemanager_domain_model_file.title',
            'config' => [
                'type' => 'input',
                'size' => 30,
                'eval' => 'trim'
            ],
        ],
        'slug' => [
            'exclude' => true,
            'label' => 'LLL:EXT:sll_file_manager/Resources/Private/Language/locallang_db.xlf:tx_sllfilemanager_domain_model_file.slug',
            'config' => [
                'type' => 'input',
                'size' => 30,
                'eval' => 'trim'
            ],
        ],
        'size' => [
            'exclude' => true,
            'label' => 'LLL:EXT:sll_file_manager/Resources/Private/Language/locallang_db.xlf:tx_sllfilemanager_domain_model_file.size',
            'config' => [
                'type' => 'input',
                'size' => 30,
                'eval' => 'double2'
            ]
        ],
        'absolute_path' => [
            'exclude' => true,
            'label' => 'LLL:EXT:sll_file_manager/Resources/Private/Language/locallang_db.xlf:tx_sllfilemanager_domain_model_file.absolute_path',
            'config' => [
                'type' => 'input',
                'size' => 30,
                'eval' => 'trim'
            ],
        ],
        'relative_path' => [
            'exclude' => true,
            'label' => 'LLL:EXT:sll_file_manager/Resources/Private/Language/locallang_db.xlf:tx_sllfilemanager_domain_model_file.relative_path',
            'config' => [
                'type' => 'input',
                'size' => 30,
                'eval' => 'trim'
            ],
        ],
        'teaser' => [
            'exclude' => true,
            'label' => 'LLL:EXT:sll_file_manager/Resources/Private/Language/locallang_db.xlf:tx_sllfilemanager_domain_model_file.teaser',
            'config' => [
                'type' => 'text',
                'cols' => 40,
                'rows' => 15,
                'eval' => 'trim'
            ]
        ],
        'download' => [
            'exclude' => true,
            'label' => 'LLL:EXT:sll_file_manager/Resources/Private/Language/locallang_db.xlf:tx_sllfilemanager_domain_model_file.download',
            'config' => [
                'type' => 'input',
                'size' => 4,
                'eval' => 'int'
            ]
        ],
        'file_type' => [
            'exclude' => true,
            'label' => 'LLL:EXT:sll_file_manager/Resources/Private/Language/locallang_db.xlf:tx_sllfilemanager_domain_model_file.file_type',
            'config' => [
                'type' => 'input',
                'size' => 4,
                'eval' => 'int'
            ]
        ],
        'file_extension' => [
            'exclude' => true,
            'label' => 'LLL:EXT:sll_file_manager/Resources/Private/Language/locallang_db.xlf:tx_sllfilemanager_domain_model_file.file_extension',
            'config' => [
                'type' => 'input',
                'size' => 30,
                'eval' => 'trim'
            ],
        ],
    
    ],
];
