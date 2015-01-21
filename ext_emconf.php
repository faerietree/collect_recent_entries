<?php

/***************************************************************
 * Extension Manager/Repository configuration.
 * Note: Manual changes may get lost after automatic regeneration.
 ***************************************************************/

$EM_CONF[$_EXTKEY] = array (
	'title' => 'Collect Recent Entries',
	'description' => 'Collects and shows the most x most recent content elements of all or selected pages and content types.',
	'category' => 'plugin',
	'shy' => 0,
	'version' => '0.1.0',
	'dependencies' => 'extbase,fluid',
	'conflicts' => '',
	'priority' => '',
	'loadOrder' => '',
	'module' => '',
	'state' => 'beta',
	'uploadfolder' => 1,
	'createDirs' => 'uploads/' . $_EXTKEY . '/logs',
	'modify_tables' => '',
	'clearcacheonload' => 0,
	'lockType' => '',
	'author' => 'Faerietale Fellows',
	'author_email' => 'tale@faerietree.com',
	'author_company' => 'Faerietale Fellows',
	'CGLcompliance' => NULL,
	'CGLcompliance_note' => NULL,
	'constraints' => 
	array (
		'depends' => 
		array (
//			'cms' => '6.0.0-', // <-- relict, version < 6.0
//			'typo3' => '6.0.0-',
//			'extbase' => '1.0.0',
//			'fluid' => '1.0.0'
		),
		'conflicts' => 
		array (
		),
		'suggests' => 
		array (
		),
	),
);

?>
