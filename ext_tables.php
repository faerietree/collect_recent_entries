<?php
if (!defined('TYPO3_MODE')) die("Access denied.");


$extkeyUpperCamelCase = t3lib_div::underscoredToUpperCamelCase($_EXTKEY);
$extkeyConnectedLowerCase = strtolower($extkeyUpperCamelCase);
$extKey = 'Dragontale.' . $_EXTKEY;

\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::allowTableOnStandardPages('tx_' . $extkeyConnectedLowerCase . '_domain_model_recententrycollection');
$TCA["tx_" . $extkeyConnectedLowerCase . "_domain_model_recententrycollection"] = array(
	'ctrl' => array(
		'title' => 'LLL:EXT:' . $_EXTKEY . '/Resources/Private/Language/locallang_db.xml:tx_' . $extkeyConnectedLowerCase . '_domain_model_recententrycollection',
		'label' => 'title',
		'tstamp' => 'last_modified_time',
		'crdate' => 'creation_time',
		'cruser_id' => 'author_id',

		//'dividers2tabs' => 1,
		//'versioningWS' => 2,
		//'versioning_followPages' => 'true',
		//'origUid' => 't3_origuid',

		'languageField' => 'sys_language_uid',	
		'transOrigPointerField' => 'l10n_parent',	
		'transOrigDiffSourceField' => 'l10n_diffsource',	
		'default_sortby' => ' ORDER BY creation_time',
		'sortby' => 'order_by',
		'delete' => 'deleted',	
		'enablecolumns' => array (
			'disabled' => 'hidden',
		),

		'dynamicConfigFile' => \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::extPath($_EXTKEY).'Configuration/TCA/tca.php',
		'iconfile'          => \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::extRelPath($_EXTKEY).'Resources/Public/Icons/icon_tx_' . $extkeyConnectedLowerCase . '_domain_model_recententrycollection.gif'
	),

);

#\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::allowTableOnStandardPages('tx_' . $extkeyConnectedLowerCase . '_domain_model_pagetocollectfrom');
$TCA["tx_" . $extkeyConnectedLowerCase . "_domain_model_typetocollect"] = array(
'ctrl' => array(
	'title' => 'Types To Collect n:m',
	'label' => 'title',
	#'nxrecententrycollection' => 'mxtypetocollect',

	//'searchFields' => 'type,',
	'dynamicConfigFile' => \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::extPath($_EXTKEY).'Configuration/TCA/tca.php',
	'iconfile'          => \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::extRelPath($_EXTKEY).'Resources/Public/Icons/icon_tx_' . $extkeyConnectedLowerCase . '_domain_model_typetocollect.gif',
),

);

#\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::allowTableOnStandardPages('tx_' . $extkeyConnectedLowerCase . '_domain_model_typetocollect');
$TCA["tx_" . $extkeyConnectedLowerCase . "_domain_model_pagetocollectfrom"] = array(
'ctrl' => array(
	'title' => 'Pages To Collect From n:m',
	'label' => 'title',
	#'nxrecententrycollection' => 'mxpagetocollectfrom',

	//'searchFields' => 'page,',
	'dynamicConfigFile' => \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::extPath($_EXTKEY).'Configuration/TCA/tca.php',
	'iconfile'          => \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::extRelPath($_EXTKEY).'Resources/Private/Public/Icons/icon_tx_' . $extkeyConnectedLowerCase . '_domain_model_pagetocollectfrom.gif',
),

);





/**
 * Register Plugin to be listed in the Backend. (Don't forget to configure the Dispatcher in ext_localconf.php).
 */
//if ($GLOBALS['TYPO3_CONF_VARS']['EXTCONF'][$_EXTKEY]['registerSinglePlugin']) {
	\TYPO3\CMS\Extbase\Utility\ExtensionUtility::registerPlugin(
	//Tx_Extbase_Utility_Extension::registerPlugin(
		$extKey, // The extension name (in UpperCamelCase) or the extension key (in lower_underscore)
		'CollectRecentEntries',	// A unique name of the plugin in UpperCamelCase
		'Collect recent entries' // A title shown in the backend dropdown field
	);

	$pluginSignature = $extkeyConnectedLowerCase . '_plugin1'; // 1 of 1
	$GLOBALS['TCA']['tt_content']['types']['list']['subtypes_excludelist'][$pluginSignature] = 'select_key';
	$GLOBALS['TCA']['tt_content']['types']['list']['subtypes_addlist'][$pluginSignature] = 'pi_flexform,recursive';
	t3lib_extMgm::addPiFlexFormValue($pluginSignature, 'FILE:EXT:' . $_EXTKEY . '/Configuration/FlexForms/flexform_list.xml');


//}
//else { // multiple plugins
	// TODO should the need arise. (currently there's not much functionality to separate, e.g. separating the TypesToCollect makes no sense as it's just an enum and tightly connected to RecentEntryCollection, hence not standalone at all.)
//}


if (TYPO3_MODE === 'BE')	{
	/**
	* Registers a Backend Module.
	*/
	\TYPO3\CMS\Extbase\Utility\ExtensionUtility::registerModule(
		$extKey,
		'web', // <- parent module
		'tx_collectrecententries_module1', // <-- this module's key
		'', // <-- position
		array( // An array holding the controller-action-combinations that are accessible. The first controller and its first action will be the default.
			'RecentEntryCollection' => 'index,show,new,create,delete,deleteAll,edit', 
			'TypeToCollect' => 'index,show,new,create,delete,deleteAll',
			'PageToCollectFrom' => 'index,show,new,create,delete,deleteAll',
		),
		array(
			'access' => 'user,group',
			'icon'   => 'EXT:' . $_EXTKEY . '/ext_icon.gif',
			'labels' => 'LLL:EXT:' . $_EXTKEY . '/Resources/Private/Language/locallang_mod.xml',
		)
	);
           
        require_once(\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::extPath($_EXTKEY).'Classes/Select.php'); 

}

/*
 Add labels for context sensitive help (CSH).
 */
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addLLrefForTCAdescr('_MOD_web_CollectRecentEntriesModule1', 'EXT:' . $_EXTKEY . '/Resources/Private/Language/locallang_csh.xml');


/*
 Add default configuration.
 */
// t3lib_extMgm
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addStaticFile($_EXTKEY, 'Configuration/TypoScript', 'Collect Recent Entries Default Configuration');
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addStaticFile($_EXTKEY, 'Configuration/TypoScript/DefaultStyles', 'Collect Recent Entries Default Styles Configuration (optional)');




?>
