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
            'indexed_search' => 'a:20:{s:6:"catdoc";s:9:"/usr/bin/";s:9:"debugMode";s:1:"0";s:23:"disableFrontendIndexing";s:1:"0";s:21:"enableMetaphoneSearch";s:1:"1";s:11:"flagBitMask";s:3:"192";s:18:"fullTextDataLength";s:1:"0";s:16:"ignoreExtensions";s:0:"";s:17:"indexExternalURLs";s:1:"0";s:6:"maxAge";s:1:"0";s:16:"maxExternalFiles";s:1:"5";s:6:"minAge";s:2:"24";s:8:"pdf_mode";s:2:"20";s:8:"pdftools";s:9:"/usr/bin/";s:7:"ppthtml";s:9:"/usr/bin/";s:18:"trackIpInStatistic";s:1:"2";s:5:"unrtf";s:9:"/usr/bin/";s:5:"unzip";s:9:"/usr/bin/";s:26:"useCrawlerForExternalFiles";s:1:"0";s:16:"useMysqlFulltext";s:1:"0";s:6:"xlhtml";s:9:"/usr/bin/";}',
            'indexed_search_autocomplete' => 'a:1:{s:19:"disableJquerySource";s:1:"1";}',
            'news' => 'a:17:{s:20:"advancedMediaPreview";s:1:"1";s:11:"archiveDate";s:4:"date";s:34:"categoryBeGroupTceFormsRestriction";s:1:"0";s:19:"categoryRestriction";s:0:"";s:21:"contentElementPreview";s:1:"1";s:22:"contentElementRelation";s:1:"1";s:19:"dateTimeNotRequired";s:1:"0";s:35:"hidePageTreeForAdministrationModule";s:1:"0";s:13:"manualSorting";s:1:"0";s:12:"mediaPreview";s:5:"false";s:13:"prependAtCopy";s:1:"1";s:22:"resourceFolderImporter";s:12:"/news_import";s:12:"rteForTeaser";s:1:"0";s:24:"showAdministrationModule";s:1:"1";s:12:"showImporter";s:1:"0";s:18:"storageUidImporter";s:1:"1";s:6:"tagPid";s:1:"1";}',
            'site_generator' => 'a:16:{s:14:"baseFolderName";s:7:"Website";s:19:"commonMountPointUid";s:0:"";s:17:"explicitAllowdeny";s:183:"tt_content:CType:media:ALLOW,tt_content:CType:textteaser:ALLOW,tt_content:CType:text:ALLOW,tt_content:CType:textpic:ALLOW,tt_content:CType:image:ALLOW,tt_content:CType:textmedia:ALLOW";s:9:"groupMods";s:65:"web_layout,web_ViewpageView,web_list,file_FilelistList,user_setup";s:11:"groupPrefix";s:5:"Group";s:13:"homePageTitle";s:4:"Home";s:9:"iso-639-1";s:2:"en";s:9:"langTitle";s:7:"English";s:6:"locale";s:11:"en_US.UTF-8";s:9:"modelsPid";s:0:"";s:15:"onlyOneFormPage";s:5:"false";s:20:"siteIdentifierPrefix";s:14:"siteGenerator-";s:8:"sitesPid";s:0:"";s:14:"subFolderNames";s:16:"documents,images";s:12:"tablesModify";s:62:"pages,sys_file,sys_file_metadata,sys_file_reference,tt_content";s:12:"tablesSelect";s:62:"pages,sys_file,sys_file_metadata,sys_file_reference,tt_content";}',
            'slug' => 'a:11:{s:17:"defaultMaxEntries";s:2:"20";s:12:"defaultOrder";s:4:"DESC";s:14:"defaultOrderBy";s:6:"crdate";s:13:"recordEnabled";s:1:"0";s:17:"recordInfoEnabled";s:1:"1";s:16:"recordMaxEntries";s:2:"10";s:11:"recordOrder";s:4:"DESC";s:13:"recordOrderBy";s:6:"crdate";s:16:"treeDefaultDepth";s:1:"3";s:15:"treeDefaultRoot";s:0:"";s:11:"treeEnabled";s:1:"1";}',
            'staticfilecache' => 'a:23:{s:18:"backendDisplayMode";s:4:"both";s:9:"boostMode";s:1:"0";s:15:"cacheTagsEnable";s:1:"0";s:23:"clearCacheForAllDomains";s:1:"1";s:12:"debugHeaders";s:1:"0";s:20:"disableInDevelopment";s:1:"0";s:21:"enableGeneratorBrotli";s:1:"0";s:19:"enableGeneratorGzip";s:1:"1";s:23:"enableGeneratorManifest";s:1:"0";s:20:"enableGeneratorPlain";s:1:"0";s:14:"hashUriInCache";s:1:"0";s:20:"htaccessTemplateName";s:61:"EXT:staticfilecache/Resources/Private/Templates/Htaccess.html";s:22:"overrideCacheDirectory";s:0:"";s:25:"rawurldecodeCacheFileName";s:1:"0";s:25:"renameTablesToOtherPrefix";s:1:"0";s:22:"sendCacheControlHeader";s:1:"1";s:47:"sendCacheControlHeaderRedirectAfterCacheTimeout";s:1:"0";s:19:"sendHttp2PushEnable";s:1:"0";s:27:"sendHttp2PushFileExtensions";s:6:"css,js";s:22:"sendHttp2PushFileLimit";s:2:"10";s:21:"useFallbackMiddleware";s:1:"1";s:29:"useReverseUriLengthInPriority";s:1:"1";s:20:"validHtaccessHeaders";s:45:"Content-Type,Content-Language,Link,X-SFC-Tags";}',
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
        'indexed_search' => [
            'catdoc' => '/usr/bin/',
            'debugMode' => '0',
            'disableFrontendIndexing' => '0',
            'enableMetaphoneSearch' => '1',
            'flagBitMask' => '192',
            'fullTextDataLength' => '0',
            'ignoreExtensions' => '',
            'indexExternalURLs' => '0',
            'maxAge' => '0',
            'maxExternalFiles' => '5',
            'minAge' => '24',
            'pdf_mode' => '20',
            'pdftools' => '/usr/bin/',
            'ppthtml' => '/usr/bin/',
            'trackIpInStatistic' => '2',
            'unrtf' => '/usr/bin/',
            'unzip' => '/usr/bin/',
            'useCrawlerForExternalFiles' => '0',
            'useMysqlFulltext' => '0',
            'xlhtml' => '/usr/bin/',
        ],
        'indexed_search_autocomplete' => [
            'disableJquerySource' => '1',
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
        'site_generator' => [
            'baseFolderName' => 'Website',
            'commonMountPointUid' => '',
            'explicitAllowdeny' => 'tt_content:CType:media:ALLOW,tt_content:CType:textteaser:ALLOW,tt_content:CType:text:ALLOW,tt_content:CType:textpic:ALLOW,tt_content:CType:image:ALLOW,tt_content:CType:textmedia:ALLOW',
            'groupMods' => 'web_layout,web_ViewpageView,web_list,file_FilelistList,user_setup',
            'groupPrefix' => 'Group',
            'homePageTitle' => 'Home',
            'iso-639-1' => 'en',
            'langTitle' => 'English',
            'locale' => 'en_US.UTF-8',
            'modelsPid' => '',
            'onlyOneFormPage' => 'false',
            'siteIdentifierPrefix' => 'siteGenerator-',
            'sitesPid' => '',
            'subFolderNames' => 'documents,images',
            'tablesModify' => 'pages,sys_file,sys_file_metadata,sys_file_reference,tt_content',
            'tablesSelect' => 'pages,sys_file,sys_file_metadata,sys_file_reference,tt_content',
        ],
        'slug' => [
            'defaultMaxEntries' => '20',
            'defaultOrder' => 'DESC',
            'defaultOrderBy' => 'crdate',
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
        'pageNotFound_handling' => 'REDIRECT:/404',
        'pageNotFound_handling_loginPageID' => 3,
        'pageNotFound_handling_redirectPageID' => 21,
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
        'devIPmask' => '',
        'displayErrors' => '0',
        'encryptionKey' => 'ba29f48f84ee4552007c2f62ebba6f3113cbd6210289f030309dce6f2e4da451c0651a4ccbee47261cc13d9872b33dfc',
        'exceptionalErrors' => 4096,
        'features' => [
            'unifiedPageTranslationHandling' => true,
        ],
        'sitename' => '彬蔚乐儿',
        'systemLocale' => 'zh_CN.UTF-8',
        'systemLog' => true,
        'systemLogLevel' => '4',
        'systemMaintainers' => [
            1,
        ],
    ],
];
