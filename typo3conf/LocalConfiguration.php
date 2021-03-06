<?php
return [
    'BE' => [
        'debug' => false,
        'explicitADmode' => 'explicitAllow',
        'installToolPassword' => '$argon2i$v=19$m=65536,t=16,p=2$bFRLeThNZm1RNC9rYmVPag$Q14o15tGSo8J/I7k9Ih3QiGdjsZE9DCnC1kyEyxsiS8',
        'loginSecurityLevel' => 'normal',
        'passwordHashing' => [
            'className' => 'TYPO3\\CMS\\Core\\Crypto\\PasswordHashing\\Argon2iPasswordHash',
            'options' => [],
        ],
    ],
    'DB' => [
        'Connections' => [
            'Default' => [
                'charset' => 'utf8mb4',
                'dbname' => 'db_www',
                'driver' => 'mysqli',
                'host' => '127.0.0.1',
                'password' => '1qaz3edc5tgb',
                'port' => 3306,
                'tableoptions' => [
                    'charset' => 'utf8mb4',
                    'collate' => 'utf8mb4_unicode_ci',
                ],
                'user' => 'root',
            ],
        ],
    ],
    'EXT' => [
        'extConf' => [
            'backend' => 'a:6:{s:14:"backendFavicon";s:37:"fileadmin/static_file/img/favicon.ico";s:11:"backendLogo";s:37:"fileadmin/static_file/img/logo_sm.svg";s:20:"loginBackgroundImage";s:38:"fileadmin/static_file/img/login_bg.jpg";s:13:"loginFootnote";s:21:"© 2017 by San Li Lin";s:19:"loginHighlightColor";s:7:"#332e2e";s:9:"loginLogo";s:40:"fileadmin/static_file/img/login_logo.svg";}',
            'extension_builder' => 'a:3:{s:9:"backupDir";s:35:"uploads/tx_extensionbuilder/backups";s:15:"backupExtension";s:1:"1";s:15:"enableRoundtrip";s:1:"1";}',
            'extensionmanager' => 'a:2:{s:21:"automaticInstallation";s:1:"1";s:11:"offlineMode";s:1:"0";}',
            'news' => 'a:17:{s:20:"advancedMediaPreview";s:1:"1";s:11:"archiveDate";s:4:"date";s:34:"categoryBeGroupTceFormsRestriction";s:1:"0";s:19:"categoryRestriction";s:0:"";s:21:"contentElementPreview";s:1:"1";s:22:"contentElementRelation";s:1:"1";s:19:"dateTimeNotRequired";s:1:"0";s:35:"hidePageTreeForAdministrationModule";s:1:"0";s:13:"manualSorting";s:1:"0";s:12:"mediaPreview";s:5:"false";s:13:"prependAtCopy";s:1:"1";s:22:"resourceFolderImporter";s:12:"/news_import";s:12:"rteForTeaser";s:1:"0";s:24:"showAdministrationModule";s:1:"1";s:12:"showImporter";s:1:"0";s:18:"storageUidImporter";s:1:"1";s:6:"tagPid";s:1:"1";}',
            'slug' => 'a:11:{s:17:"defaultMaxEntries";s:2:"50";s:12:"defaultOrder";s:4:"DESC";s:14:"defaultOrderBy";s:7:"doktype";s:13:"recordEnabled";s:1:"0";s:17:"recordInfoEnabled";s:1:"1";s:16:"recordMaxEntries";s:2:"10";s:11:"recordOrder";s:4:"DESC";s:13:"recordOrderBy";s:6:"crdate";s:16:"treeDefaultDepth";s:1:"3";s:15:"treeDefaultRoot";s:0:"";s:11:"treeEnabled";s:1:"1";}',
            'staticfilecache' => 'a:23:{s:23:"clearCacheForAllDomains";s:1:"1";s:9:"boostMode";s:1:"0";s:18:"backendDisplayMode";s:4:"both";s:12:"debugHeaders";s:1:"0";s:20:"validHtaccessHeaders";s:45:"Content-Type,Content-Language,Link,X-SFC-Tags";s:20:"disableInDevelopment";s:1:"0";s:25:"renameTablesToOtherPrefix";s:1:"0";s:29:"useReverseUriLengthInPriority";s:1:"1";s:21:"useFallbackMiddleware";s:1:"1";s:14:"hashUriInCache";s:1:"0";s:25:"rawurldecodeCacheFileName";s:1:"0";s:20:"htaccessTemplateName";s:61:"EXT:staticfilecache/Resources/Private/Templates/Htaccess.html";s:22:"overrideCacheDirectory";s:0:"";s:23:"enableGeneratorManifest";s:1:"0";s:20:"enableGeneratorPlain";s:1:"0";s:19:"enableGeneratorGzip";s:1:"1";s:21:"enableGeneratorBrotli";s:1:"0";s:22:"sendCacheControlHeader";s:1:"1";s:47:"sendCacheControlHeaderRedirectAfterCacheTimeout";s:1:"0";s:15:"cacheTagsEnable";s:1:"0";s:19:"sendHttp2PushEnable";s:1:"0";s:27:"sendHttp2PushFileExtensions";s:6:"css,js";s:22:"sendHttp2PushFileLimit";s:2:"10";}',
        ],
    ],
    'EXTCONF' => [
        'lang' => [
            'availableLanguages' => [
                'ch',
                'zh',
            ],
        ],
    ],
    'EXTENSIONS' => [
        'backend' => [
            'backendFavicon' => 'fileadmin/static_file/img/favicon.ico',
            'backendLogo' => 'fileadmin/static_file/img/logo_sm.svg',
            'loginBackgroundImage' => 'fileadmin/static_file/img/login_bg.jpg',
            'loginFootnote' => '© 2017 by San Li Lin',
            'loginHighlightColor' => '#332e2e',
            'loginLogo' => 'fileadmin/static_file/img/login_logo.svg',
        ],
        'extension_builder' => [
            'backupDir' => 'uploads/tx_extensionbuilder/backups',
            'backupExtension' => '1',
            'enableRoundtrip' => '1',
        ],
        'extensionmanager' => [
            'automaticInstallation' => '1',
            'offlineMode' => '0',
        ],
        'news' => [
            'advancedMediaPreview' => '1',
            'archiveDate' => 'date',
            'categoryBeGroupTceFormsRestriction' => '0',
            'categoryRestriction' => '',
            'contentElementPreview' => '1',
            'contentElementRelation' => '1',
            'dateTimeNotRequired' => '0',
            'hidePageTreeForAdministrationModule' => '0',
            'manualSorting' => '0',
            'mediaPreview' => 'false',
            'prependAtCopy' => '1',
            'resourceFolderImporter' => '/news_import',
            'rteForTeaser' => '0',
            'showAdministrationModule' => '1',
            'showImporter' => '0',
            'storageUidImporter' => '1',
            'tagPid' => '1',
        ],
        'slug' => [
            'defaultMaxEntries' => '50',
            'defaultOrder' => 'DESC',
            'defaultOrderBy' => 'doktype',
            'recordEnabled' => '0',
            'recordInfoEnabled' => '1',
            'recordMaxEntries' => '10',
            'recordOrder' => 'DESC',
            'recordOrderBy' => 'crdate',
            'treeDefaultDepth' => '3',
            'treeDefaultRoot' => '',
            'treeEnabled' => '1',
        ],
        'staticfilecache' => [
            'backendDisplayMode' => 'both',
            'boostMode' => '0',
            'cacheTagsEnable' => '0',
            'clearCacheForAllDomains' => '1',
            'debugHeaders' => '0',
            'disableInDevelopment' => '0',
            'enableGeneratorBrotli' => '0',
            'enableGeneratorGzip' => '1',
            'enableGeneratorManifest' => '0',
            'enableGeneratorPlain' => '0',
            'hashUriInCache' => '0',
            'htaccessTemplateName' => 'EXT:staticfilecache/Resources/Private/Templates/Htaccess.html',
            'overrideCacheDirectory' => '',
            'rawurldecodeCacheFileName' => '0',
            'renameTablesToOtherPrefix' => '0',
            'sendCacheControlHeader' => '1',
            'sendCacheControlHeaderRedirectAfterCacheTimeout' => '0',
            'sendHttp2PushEnable' => '0',
            'sendHttp2PushFileExtensions' => 'css,js',
            'sendHttp2PushFileLimit' => '10',
            'useFallbackMiddleware' => '1',
            'useReverseUriLengthInPriority' => '1',
            'validHtaccessHeaders' => 'Content-Type,Content-Language,Link,X-SFC-Tags',
        ],
    ],
    'FE' => [
        'baseURL' => 'https://www.whongbin.cn/',
        'debug' => '4',
        'dicp' => '',
        'icp' => ' 宁ICP备17002278号',
        'loginSecurityLevel' => 'normal',
        'pageNotFound_handling' => 'REDIRECT:/error',
        'pageNotFound_handling_loginPageID' => 3,
        'pageNotFound_handling_redirectPageID' => 21,
        'pageUnavailable_handling' => 'REDIRECT:/error',
        'passwordHashing' => [
            'className' => 'TYPO3\\CMS\\Core\\Crypto\\PasswordHashing\\Argon2iPasswordHash',
            'options' => [],
        ],
        'sessionTimeout' => 86400,
        'silent' => '0',
    ],
    'FILE' => [
        'banner_index' => [
            'fileadmin/static_file/img/banner_index_1.jpg',
            'fileadmin/static_file/img/banner_index_2.jpg',
        ],
        'banner_inner' => 'fileadmin/static_file/img/banner_inner.jpg',
        'favicon' => 'fileadmin/static_file/img/favicon.ico',
        'login_logo' => 'fileadmin/static_file/img/login_logo.svg',
        'logo' => 'fileadmin/static_file/img/logo.svg',
        'logo_sm' => 'fileadmin/static_file/img/logo_sm.svg',
        'logoinner' => 'fileadmin/static_file/img/logo_inner.svg',
    ],
    'MAIL' => [
        'transport' => 'sendmail',
        'transport_sendmail_command' => '/usr/sbin/sendmail -t -i',
        'transport_smtp_encrypt' => '',
        'transport_smtp_password' => '',
        'transport_smtp_server' => '',
        'transport_smtp_username' => '',
    ],
    'SEO' => [
        'Promotion' => '',
        'author' => '王宏彬',
        'baidukey' => '499ecbcbbddc028cbf7c68615849ef74',
        'description' => '记录我从菜鸟开始的脚印,坚信总有人山高路远为你而来',
        'keywords' => 'SanLiLin,三里林,typo3,php,木木彡,王宏彬',
    ],
    'SYS' => [
        'UTF8filesystem' => true,
        'belogErrorReporting' => '0',
        'devIPmask' => '',
        'displayErrors' => 0,
        'encryptionKey' => 'ba29f48f84ee4552007c2f62ebba6f3113cbd6210289f030309dce6f2e4da451c0651a4ccbee47261cc13d9872b33dfc',
        'exceptionalErrors' => 4096,
        'features' => [
            'unifiedPageTranslationHandling' => true,
        ],
        'sitename' => 'SanLiLin',
        'systemLocale' => 'zh_CN.UTF-8',
        'systemLog' => true,
        'systemLogLevel' => '4',
        'systemMaintainers' => [
            1,
        ],
    ],
];
