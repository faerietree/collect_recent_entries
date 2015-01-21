#
# Note a collection in its simplest form not needs to specify any requirements (e.g. types, pages, max count).
# If no requirements are specified, the 1 most recent entries of each page are collected. 
#
# Note: Usually the table names should be in plural form, but it is not certain that Extbase + Flow support this (rather the opposite the model .php class name must be equal to this table name). Hence no plural.
CREATE TABLE tx_collectrecententries_domain_model_recententrycollection (
	uid INT(11) UNSIGNED DEFAULT '0' NOT NULL auto_increment,
	pid INT(11) UNSIGNED DEFAULT '0',

	title VARCHAR(255) DEFAULT 'Collection', 
	entry_count_max TINYINT(4) DEFAULT '1',
	types_to_collect BLOB,
	pages_to_collect_from BLOB,

	creation_time INT(11) DEFAULT '0',
	author_id INT(11) DEFAULT '0',
	last_modified_time INT(11) DEFAULT '0',
	last_modified_by INT(11) DEFAULT '0',

	t3ver_oid int(11) DEFAULT '0' NOT NULL,
	t3ver_id int(11) DEFAULT '0' NOT NULL,
	t3ver_wsid int(11) DEFAULT '0' NOT NULL,
	t3ver_label varchar(30) DEFAULT '' NOT NULL,
	t3ver_state tinyint(4) DEFAULT '0' NOT NULL,
	t3ver_stage tinyint(4) DEFAULT '0' NOT NULL,
	t3ver_count int(11) DEFAULT '0' NOT NULL,
	t3ver_tstamp int(11) DEFAULT '0' NOT NULL,
	t3_origuid int(11) DEFAULT '0' NOT NULL,

	sys_language_uid INT(11) DEFAULT '0',
	l10n_parent  INT(11) DEFAULT '0',
	l10n_diffsource MEDIUMTEXT,

	order_by VARCHAR(55),
	order_descending TINYINT(1) DEFAULT 0,

	deleted TINYINT(4) DEFAULT '0',
	hidden TINYINT(4) DEFAULT '0',

	PRIMARY KEY(uid),
	KEY parent (pid)

);	


#
# Each collection has its entries (content elements).
# Which content elements shall be collected is defined by 
# all its assigned requirements:
#     types (e.g. [IMAGE, TEXT, ...]) .
#     max count (e.g. 2 to only collect the 2 most recent entries of that matches the required type and pages.).
#     pages (e.g. [pid1, pid2, pidX]) .
#
#PRIMARY KEY(collection_id, type), -- because type is never changing. If anything then it is removed and a new type database record is inserted.
CREATE TABLE tx_collectrecententries_domain_model_typetocollect (

	uid INT(11) UNSIGNED DEFAULT '0' NOT NULL auto_increment,
	pid INT(11) UNSIGNED DEFAULT '0',

	collection_id INT(11) NOT NULL,
	type VARCHAR(11) NOT NULL,

	PRIMARY KEY(uid), 
	KEY parent (collection_id),
);

CREATE TABLE tx_collectrecententries_domain_model_pagetocollectfrom (

	uid INT(11) UNSIGNED DEFAULT '0' NOT NULL auto_increment,
	pid INT(11) UNSIGNED DEFAULT '0',

	collection_id INT(11) NOT NULL,
	page_id VARCHAR(11) NOT NULL,

	PRIMARY KEY(uid),
	KEY parent (collection_id)
);

