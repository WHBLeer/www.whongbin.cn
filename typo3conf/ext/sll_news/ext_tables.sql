#
# Table structure for table 'tx_news_domain_model_news'
#
CREATE TABLE tx_news_domain_model_news (
    `reading` int(11) DEFAULT '0' NOT NULL,
    `islike` int(11) DEFAULT '0' NOT NULL,
    `dislike` int(11) DEFAULT '0' NOT NULL,
    `cover` int(11) unsigned DEFAULT '0' NOT NULL,
    `annexs` int(11) unsigned DEFAULT '0' NOT NULL,
);


#
# Table structure for table 'tx_sllfilemanager_domain_model_file'
#
CREATE TABLE tx_sllfilemanager_domain_model_file (

	`news` int(11) unsigned DEFAULT '0' NOT NULL,

);