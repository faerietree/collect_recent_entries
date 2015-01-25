<?php
namespace Dragontale\CollectRecentEntries\Domain\Repository;

//class Tx_CollectRecentEntries_Domain_Repository_RecentEntryCollectionRepository extends Tx_Extbase_Persistence_Repository {
class RecentEntryCollectionRepository extends \TYPO3\CMS\Extbase\Persistence\Repository {

	#$currentUid = $GLOBALS['TSFE']->id;

	# credit biesior for the fix as dontCheckPid apparently wasn't enough. Holy cow...
	# System wide settings:
	public function initializeObject() {
		#$this->defaultQuerySettings->setRespectStoragePage(FALSE);

		/** @var $querySettings \TYPO3\CMS\Extbase\Persistence\Generic\Typo3QuerySettings */
	        $querySettings = $this->objectManager->get('TYPO3\\CMS\\Extbase\\Persistence\\Generic\\Typo3QuerySettings');
	        // go for $defaultQuerySettings = $this->createQuery()->getQuerySettings(); if you want to make use of the TS persistence.storagePid with defaultQuerySettings(), see #51529 for details

	        // don't add the pid constraint
	        $querySettings->setRespectStoragePage(FALSE);
	        // set the storagePids to respect
	        #$querySettings->setStoragePageIds(array(1, 26, 989));

	        // don't add fields from enablecolumns constraint
	        // this function is deprecated
		#$querySettings->setRespectEnableFields(FALSE);

        	// define the enablecolumn fields to be ignored
	        // if nothing else is given, all enableFields are ignored
	        #$querySettings->setIgnoreEnableFields(TRUE);       
        	// define single fields to be ignored
	        #$querySettings->setEnableFieldsToBeIgnored(array('disabled','starttime'));
	
	        // add deleted rows to the result
        	#$querySettings->setIncludeDeleted(TRUE);
	
	        // don't add sys_language_uid constraint
        	#$querySettings->setRespectSysLanguage(FALSE);
	
	        // perform translation to dedicated language
	        #$querySettings->setSysLanguageUid(42);


        	$this->setDefaultQuerySettings($querySettings);
	}
	// Example for a function setup changing query settings
	public function findSomething() {
		$query = $this->createQuery();
		// don't add the pid constraint
		$query->getQuerySettings()->setRespectStoragePage(FALSE);
		// the same functions as shown in initializeObject can be applied.
	        return $query->execute();
	}
	
};

?>
