<?php
if (!defined ('TYPO3_MODE')) die ('Access denied.');



$TCA['tx_collectrecententries_domain_model_recententrycollection'] = array (
	'ctrl' => $TCA['tx_collectrecententries_domain_model_recententrycollection']['ctrl'],

	'interface' => array (
		'showRecordFieldList' => 'title,types_to_collect,pages_to_collect_from'
	),

	'feInterface' => $TCA['tx_collectrecententries_domain_model_recententrycollection']['feInterface'],

	'columns' => array (
		'title' => array (
			'exclude' => 0,
			#'label' => 'LLL:EXT:'.$_EXTKEY.'/Resources/Private/Language/locallang_db.xml:tx_collectrecententries_domain_model_recententrycollection.title',
			'label' => 'Collection Title',
			'config' => array(
				'type' => 'input',
				'size' => '30',
				'eval' => 'trim',
				'max' => 256
			)
		),
		'entry_count_max' => array(
			'label' => 'Entry Count Maximum',
			'config' => array(
				'type' => 'input',
				'size' => '10',
				'eval' => 'trim'
			)
		),
		'types_to_collect' => array (
			'exclude' => 1,
			'label' => "LLL:EXT:collect_recent_entries/Resources/Private/Language/locallang_db.xml:tx_collectrecententries.types_to_collect",
			'config' => array (
				'type' => "inline",
				//'type' => "select",
				'foreign_table' => 'tx_collectrecententries_domain_model_typetocollect',
				'foreign_field' => 'collection_id',
				#'foreign_table_where' => 'collection_id = ###REC_FIELD_uid###',
				'maxitems' => 100,
				'appearance' => array(
					'showSynchronizationLink' => 1,
					'showAllLocalizationLink' => 1,
					'showPossibleLocalizationRecords' => 1,
					'showRemovedLocalizationRecords' => 1,
					'enabledControls' => array(
						'new' => 1,
						'delete' => 1,
						'sort' => 1,
						'hide' => 1,
						'dragdrop' => 1,
					),
					'levelLinksPosition' => 'none',
				),
				'behaviour' => array(
					'localizationMode' => 'inline',
				)
			)
		),
		'pages_to_collect_from' => array (
			'exclude' => 1,
			'label' => "LLL:EXT:collect_recent_entries/Resources/Private/Language/locallang_db.xml:tx_collectrecententries.pages_to_collect_from",
			'config' => array (
			        'type' => "inline",
				#'type' => "select",
				'foreign_table' => 'tx_collectrecententries_domain_model_pagetocollectfrom',
				'foreign_field' => 'collection_id',
				#'foreign_table_where' => 'collection_id = ###REC_FIELD_uid###', <-- still NEW<hash> if it's a new record.
				'maxitems' => 500,
				'appearance' => array(
					'showSynchronizationLink' => 1,
					'showAllLocalizationLink' => 1,
					'showPossibleLocalizationRecords' => 1,
					'showRemovedLocalizationRecords' => 1,
					'enabledControls' => array(
						'new' => 1,
						'delete' => 1,
						'sort' => 1,
						'hide' => 1,
						'dragdrop' => 1,
					),
					'levelLinksPosition' => 'none',
				),
				'behaviour' => array(
					'localizationMode' => 'select',
				)
			)
		),

		'sys_language_uid' => array (
			'exclude' => 1,
			'label'  => 'LLL:EXT:lang/locallang_general.xml:LGL.language',
			'config' => array (
				'type'                => 'select',
				'foreign_table'       => 'sys_language',
				'foreign_table_where' => 'ORDER BY sys_language.title',
				'items' => array(
					array('LLL:EXT:lang/locallang_general.xml:LGL.allLanguages', -1),
					array('LLL:EXT:lang/locallang_general.xml:LGL.default_value', 0)
				)
			)
		),
		'l10n_parent' => array (
			'displayCond' => 'FIELD:sys_language_uid:>:0',
			'exclude'     => 1,
			'label'       => 'LLL:EXT:lang/locallang_general.xml:LGL.l10n_parent',
			'config'      => array (
				'type'  => 'select',
				'items' => array (
					array('', 0),
				),
				'foreign_table'       => 'tx_collectrecententries_domain_model_recententrycollection',
				'foreign_table_where' => 'AND tx_collectrecententries_domain_model_recententrycollection.uid=###REC_FIELD_l10_parent### AND tx_collectrecententries_domain_model_recententrycollection.sys_language_uid IN (-1,0)',
				//'foreign_table_where' => 'AND tx_collectrecententries_domain_model_recententrycollection.pid=###CURRENT_PID### AND tx_collectrecententries_domain_model_recententrycollection.sys_language_uid IN (-1,0)',
			)
		),
		'l10n_diffsource' => array (
			'config' => array (
				'type' => 'passthrough'
			)
		),

		't3ver_label' => Array (
			'displayCond' => 'FIELD:t3ver_label:REQ:true',
			'label' => 'LLL:EXT:lang/locallang_general.php:LGL.versionLabel',
			'config' => Array (
				'type'=>'none',
				'cols' => 27
			)
		),

		'hidden' => array (
			'exclude' => 1,
			'label'   => 'LLL:EXT:lang/locallang_general.xml:LGL.hidden',
			'config'  => array (
				'type'    => 'check',
				'default' => '0'
			)
		)

	),

	'types' => array (
		'0' => array('showitem' => 'title;;;;2-2-2, entry_count_max, types_to_collect;;;;3-3-3, pages_to_collect_from')
	),

	'palettes' => array (
		'1' => array('showitem' => '')
	)
);



$TCA['tx_collectrecententries_domain_model_typetocollect'] = array (
	'ctrl' => $TCA['tx_collectrecententries_domain_model_typetocollect']['ctrl'],
	'interface' => array (
		'showRecordFieldList' => 'type'
	),
	'feInterface' => $TCA['tx_collectrecententries_domain_model_typetocollect']['feInterface'],
	'columns' => array (
		'collection_id' => array(
                	'exclude' => 0,
			'label'       => 'LLL:EXT:collect_recent_entries/Resources/Private/Language/locallang_db.xml:tx_collectrecententries.collection_id',
			'config' => array(
				#'eval' => 'required',
				'type' => 'select',
				'foreign_table' => 'tx_collectrecententries_domain_model_recententrycollection',
				#'foreign_field' => ' uid',
				'foreign_table_where' => 'AND tx_collectrecententries_domain_model_recententrycollection.deleted < 1',
				'size' => '1',
				'minitems' => '1',
				'maxitems' => '1',
			)
		),
		'type' => array (
			'exclude'     => 0,
			'label'       => 'LLL:EXT:collect_recent_entries/Resources/Private/Language/locallang_db.xml:tx_collectrecententries.type',
			'config'      => array (
				'type'  => 'select',
				#'items' => array (
                                # http://docs.typo3.org/typo3cms/TCAReference/singlehtml/#columns-select-properties-items
				#	array('', 0, 'IMAGE', 'TEXT'), // add more if no longer deriving all possible content element types.
				#),
                                'itemsProcFunc' => '\\Dragontale\\CollectRecentEntries\\Select->getAllContentTypes',
				#'foreign_table' => 'tt_content',
				#'foreign_table_field' => 'CType',
				#'foreign_field' => 'type',
				#'foreign_unique' => 'CType', // prevent redundant definitions of key(CType, collection_id). TODO works?
				#'foreign_selector' => 'DISTINCT CType, deleted',
				#'foreign_table_where' => 'AND 1 <> 0 AND tt_content.deleted < 1',
			)
		)
	),
	'types' => array (
		'0' => array('showitem' => 'collection_id;;;;2-2-2, type')
	),
	'palettes' => array (
		'1' => array('showitem' => '')
	)
);



$TCA['tx_collectrecententries_domain_model_pagetocollectfrom'] = array (
	'ctrl' => $TCA['tx_collectrecententries_domain_model_pagetocollectfrom']['ctrl'],
	'interface' => array (
		'showRecordFieldList' => 'page_id'
	),
	'feInterface' => $TCA['tx_collectrecententries_domain_model_pagetocollectfrom']['feInterface'],
	'columns' => array (
		'page_id' => array (
			'exclude'     => 0,
			'label'       => 'LLL:EXT:collect_recent_entries/Resources/Private/Language/locallang_db.xml:tx_collectrecententries.page_id',
			'config'      => array (
				'type'  => 'select',
				#'items' => array (
				#	array('', 0),
				#),
				'foreign_table' => 'pages',
				#'foreign_field' => ' uid',
				'foreign_table_where' => 'AND pages.deleted < 1',
			)
		),
		'collection_id' => array (
                	'exclude' => 0,
			'label'       => 'LLL:EXT:collect_recent_entries/Resources/Private/Language/locallang_db.xml:tx_collectrecententries.collection_id',
			'config' => array(
				#'eval' => 'required',
				'type' => 'select',
				'foreign_table' => 'tx_collectrecententries_domain_model_recententrycollection',
				#'foreign_field' => ' uid',
				'foreign_table_where' => 'AND tx_collectrecententries_domain_model_recententrycollection.deleted < 1',
				'size' => '1',
				'minitems' => '1',
				'maxitems' => '1',
				/*
				'type' => 'user',
				'userFunc' => 'usercollectionfield->getCollectionId' //TODO When to handle foreign tables via 'userFunc' in Extbase?
				*/
			)
		)
	),
	'types' => array (
		'0' => array('showitem' => 'collection_id;;;;2-2-2, page_id;;;;3-3-3')
	),
	'palettes' => array (
		'1' => array('showitem' => '')
	)
);


?>
