<?php
if (!defined ('TYPO3_MODE')) {
 	die ('Access denied.');
}

// - only one piece of text is allowed
// - no point other than at the end (the point is required)
$extKey = 'Dragontale.' . $_EXTKEY;
//$extKey = $_EXTKEY;

//$GLOBALS['TYPO3_CONF_VARS']['EXTCONF'][$_EXTKEY] = unserialize($_EXTCONF);

/**
 * Configure the Plugin to call the
 * right combination of Controller and Action according to
 * the user input (default settings, FlexForm, URL etc.)
 */
//if ($GLOBALS['TYPO3_CONF_VARS']['EXTCONF'][$_EXTKEY]['registerSinglePlugin']) {

	\TYPO3\CMS\Extbase\Utility\ExtensionUtility::configurePlugin(
	// Prior to typo3 version 6.0:
	//Tx_Extbase_Utility_Extension::configurePlugin(
		$extKey,   // The extension name (in UpperCamelCase) or the extension key (in lower_underscore)
		'CollectRecentEntries',    // A unique name of the plugin in UpperCamelCase
		array (    // An array holding the controller-action-combinations that are accessible.
			// The first controller and its first action will be the default.
			'RecentEntryCollection' => 'index, create, show, delete, deleteAll',
			'TypeToCollect' => 'index, create, delete, deleteAll',
			'PageToCollectFrom' => 'index, create, delete, deleteAll',
		),
		array(    // An array of non-cachable controller-action-combinations (they must already be enabled)
			'RecentEntryCollection' => 'create, delete, deleteAll',
			'TypeToCollect' => 'create, delete, deleteAll',
			'PageToCollectFrom' => 'create, delete, deleteAll',
		)
	);
//}
/*else { // Allow to add plugin for each kind:
	//e.g.
	// Post plugins:
	Tx_Extbase_Utility_Extension::configurePlugin(
		$extKey,
		'PostList',
		array('Post' => 'index')
	);
	Tx_Extbase_Utility_Extension::configurePlugin(
		$extKey,
		'PostSingle',
		array('Post' => 'show', 'Comment' => 'create'),
		array('Comment' => 'create')
	);

	// Administration plugins:
	Tx_Extbase_Utility_Extension::configurePlugin(
		'BlogAdmin',
		array(
			'Blog' => 'new,create,delete,deleteAll,edit,update,populate',
			'Post' => 'new,create,delete,edit,update',
			'Comment' => 'delete',
		),
		array(
			'Blog' => 'create,delete,deleteAll,update,populate',
			'Post' => 'create,delete,update',
			'Comment' => 'delete',
		)
	);
}*/


//require_once(t3lib_extMgm::extPath('div') . 'class.tx_div.php');
//if(TYPO3_MODE == 'FE') tx_div::autoLoadAll($extKey);

//$TYPO3_CONF_VARS['FE']['eID_include']['ajaxDispatcher'] = \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::extPath('collectrecententries').'Classes/EIDispatcher.php';

# http://docs.typo3.org/typo3cms/CoreApiReference/ApiOverview/MainClasses/UsefulFunctions/Index.html
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addPItoST43($_EXTKEY);
?>
