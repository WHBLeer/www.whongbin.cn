#
# Table structure for table 'tx_sllfilemanager_domain_model_file'
#
CREATE TABLE tx_sllfilemanager_domain_model_file (

	title varchar(255) DEFAULT '' NOT NULL,
	slug varchar(255) DEFAULT '' NOT NULL,
	size double(11,2) DEFAULT '0.00' NOT NULL,
	absolute_path varchar(255) DEFAULT '' NOT NULL,
	relative_path varchar(255) DEFAULT '' NOT NULL,
	teaser text,
	download int(11) DEFAULT '0' NOT NULL,
	file_type int(11) DEFAULT '0' NOT NULL,
	file_extension varchar(255) DEFAULT '' NOT NULL,

);
