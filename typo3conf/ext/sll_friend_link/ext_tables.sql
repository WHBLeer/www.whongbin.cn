#
# Table structure for table 'tx_sllfriendlink_domain_model_links'
#
CREATE TABLE tx_sllfriendlink_domain_model_links (

	title varchar(255) DEFAULT '' NOT NULL,
	webmaster varchar(255) DEFAULT '' NOT NULL,
	email varchar(255) DEFAULT '' NOT NULL,
	links varchar(255) DEFAULT '' NOT NULL,
	introduction varchar(255) DEFAULT '' NOT NULL,
	icon text,
	nofollow smallint(5) unsigned DEFAULT '0' NOT NULL,
	type int(11) unsigned DEFAULT '0',

);

#
# Table structure for table 'tx_sllfriendlink_domain_model_type'
#
CREATE TABLE tx_sllfriendlink_domain_model_type (

	title varchar(255) DEFAULT '' NOT NULL,
	slug varchar(255) DEFAULT '' NOT NULL,

);
