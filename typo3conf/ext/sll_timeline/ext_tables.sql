#
# Table structure for table 'tx_slltimeline_domain_model_event'
#
CREATE TABLE tx_slltimeline_domain_model_event (

	title varchar(255) DEFAULT '' NOT NULL,
	event_link varchar(255) DEFAULT '' NOT NULL,
	description text,
	start_date int(11) DEFAULT '0' NOT NULL,
	end_date int(11) DEFAULT '0' NOT NULL,
	format varchar(255) DEFAULT '' NOT NULL,
	side int(11) DEFAULT '0' NOT NULL,

);
