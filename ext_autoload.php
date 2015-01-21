<?php
$extensionClassesPath = \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::extPath('collect_recent_entries') . 'Classes/';

return array(
	'tx_collectrecententries_viewhelpers_abstractbackendviewhelper' => $extensionClassesPath . 'ViewHelpers/AbstractBackendViewHelper.php',

	'tx_collectrecententries_domain_model_recententrycollection' => $extensionClassesPath . 'Domain/Model/RecentEntryCollection.php',
	'tx_collectrecententries_domain_model_typetocollect' => $extensionClassesPath . 'Domain/Model/TypeToCollect.php',
	'tx_collectrecententries_domain_model_pagetocollectfrom' => $extensionClassesPath . 'Domain/Model/PageToCollectFrom.php',

	'tx_collectrecententries_domain_repository_recententrycollectionrepository' => $extensionClassesPath . 'Domain/Repository/RecentEntryCollectionRepository.php',
	'tx_collectrecententries_domain_repository_typetocollectrepository' => $extensionClassesPath . 'Domain/Repository/TypeToCollectRepository.php',
	'tx_collectrecententries_domain_repository_pagetocollectfromrepository' => $extensionClassesPath . 'Domain/Repository/PageToCollectFromRepository.php',

	'tx_collectrecententries_domain_validator_recententrycollectionvalidator' => $extensionClassesPath . 'Domain/Validator/RecentEntryCollectionValidator.php',	

	'tx_collectrecententries_controller_recententrycollectioncontroller' => $extensionClassesPath . 'Controller/RecentEntryCollectionController.php',
	'tx_collectrecententries_controller_typetocollectcontroller' => $extensionClassesPath . 'Controller/TypeToCollectController.php',
	'tx_collectrecententries_controller_pagetocollectfromcontroller' => $extensionClassesPath . 'Controller/PageToCollectFromController.php'

);

?>
