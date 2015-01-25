<?php

namespace Dragontale\CollectRecentEntries\Controller;

/* * *************************************************************
 *  Copyright notice:
 *
 *  (c) 2014 FaerieTree <development@dragontale.de>
 *  
 *  All rights reserved.
 *
 *  This script is part of the TYPO3 project. The TYPO3 project is
 *  free software; you can redistribute it and/or modify
 *  it under the terms of the GNU General Public License as published by
 *  the Free Software Foundation; either version 3 of the License, or
 *  (at your option) any later version.
 *
 *  The GNU General Public License can be found at
 *  http://www.gnu.org/copyleft/gpl.html.
 *
 *  This script is distributed in the hope that it will be useful,
 *  but WITHOUT ANY WARRANTY; without even the implied warranty of
 *  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 *  GNU General Public License for more details.
 *
 *  This copyright notice MUST APPEAR in all copies of the script!
 * ************************************************************* */
//Tx_CollectRecentEntries_Controller_RecentEntryCollectionsController
class RecentEntryCollectionController extends \TYPO3\CMS\Extbase\Mvc\Controller\ActionController {//Tx_Extbase_MVC_Controller_ActionController {

	/**
	 * singleton:
	 * @var Dragontale\CollectRecentEntries\Domain\Repository\RecentEntryCollectionRepository
	 * @inject 
	 */
	protected $recentEntryCollectionRepository;

	/**
	 * singleton:
	 * @var Dragontale\CollectRecentEntries\Domain\Repository\TypeToCollectRepository
	 * @inject 
	 */
	protected $typeToCollectRepository;

	/**
	 * singleton:
	 * @var Dragontale\CollectRecentEntries\Domain\Repository\PageToCollectFromRepository
	 * @inject 
	 */
	protected $pageToCollectFromRepository;
	

	//========================================================//
	// METHODS
	//========================================================//

	function indexAction() {
		$this->listAction();
	}

	private function getEntries($recentEntryCollection) {
		
	}
	public function listAction() {

		//$repository = t3lib_div::makeInstance("Tx_CollectRecentEntries_Domain_Repository_RecentEntryCollectionRepository");
		$repository = $this->recentEntryCollectionRepository;
		$recentEntryCollections = $repository->findAll();
		$recentEntryCollections_index = -1;
		$recentEntryCollections_count = sizeOf($recentEntryCollections);
		#echo '#recentEntryCollections: ' . $recentEntryCollections_count;
		while (++$recentEntryCollections_index < $recentEntryCollections_count)
		{
			#echo '<br/>'.$recentEntryCollections_index;
			$recentEntryCollection = $recentEntryCollections[$recentEntryCollections_index];
			$this->loadCriteria($recentEntryCollection);
			// Figure content elements (uids) that are matched by the criteria: 
			// (tt_)content elements' ids (uid).
			// (Needed for rendering in the frontend.)
			// Now moved to content view helper for easy access from within (fluid) templates.
			$recentEntryCollection->fillContentUids();
			#$cObject = \TYPO3\CMS\Core\Utility\GeneralUtility::makeInstance('TYPO3\CMS\Frontend\ContentObject\ContentObjectRenderer');
			#$contentObject = $this->configurationManager->getContentObject();
			#$config = array(
			#	'tables' => 'tt_content',
			#	'source' => $uid,
			#	'dontCheckPid' => 1
			#);

			#$res = $contentObject->RECORDS($config)->data;
			#echo 'content object RECORDS data: ';
			#print_r($res);

		}


		$this->view->assign("recentEntryCollections", $recentEntryCollections);
		#return $this->view->render(); // <-- Extbase also cares for that should it be forgotten here.
	}

	/**
	 * Load/assemble criteria of a recentEntryCollection.
	 */
	private function loadCriteria($recentEntryCollection)
	{
		// Determine types to collect:
		$repository = $this->typeToCollectRepository;
		$all = $repository->findAll(); // TODO filter here directly.
		$all_index = sizeOf($all);
		$results = array();
		#echo 'types to collect count: ' . $all_index .'<br/>';
		while (--$all_index > -1)
		{
			$typeToCollect = $all[$all_index];
			#print_r($typeToCollect);
			#if ($this->recentEntryCollectionRepository->findByUid($typeToCollect->collection_id) == $recentEntryCollection)
			if ($typeToCollect->getCollectionId() == $recentEntryCollection->getUid())
			{
				#echo '<div style="position: absolute; top:0; left:20%;">Type to collect: ' . $typeToCollect . '</div>' . "\r\n";
				#echo 'Type to collect: ' . $typeToCollect . "<br/>\r\n";
				$results[] = $typeToCollect;
			}
		}
		$recentEntryCollection->setTypesToCollect($results);

		// Determine pages to collect from:
		$repository = $this->pageToCollectFromRepository;
		$all = $repository->findAll(); // TODO filter here directly.
		$all_index = sizeOf($all);
		$results = array();
		while (--$all_index > -1)
		{
			$pageToCollectFrom = $all[$all_index];
			#if ($this->recentEntryCollectionRepository->findByUid($typeToCollect->getCollectionId()) == $recentEntryCollection)
			if ($pageToCollectFrom->getCollectionId() == $recentEntryCollection->getUid())
			{
				#echo 'Page to collect from: ' . $pageToCollectFrom . '<br/>' . "\r\n";
				$results[] = $pageToCollectFrom;
			}
		}
		$recentEntryCollection->setPagesToCollectFrom($results);
	}


	/**
	 * Displays a (backend!) form for creating a new collection.
	 *
	 * @param \Dragontale\CollectRecentEntries\Domain\Model\RecentEntryCollection $recentEntryCollection A fresh object.
	 * @return void
	 * @dontvalidate $recentEntryCollection
	 */
	public function newAction(\Dragontale\CollectRecentEntries\Domain\Model\RecentEntryCollection $recentEntryCollection = NULL) {
		$this->view->assign('newRecentEntryCollection', $recentEntryCollection);
	}

	/**
	 * Creates a new recent entry collection.
	 *
	 * @param \Dragontale\CollectRecentEntries\Domain\Model\RecentEntryCollection $recentEntryCollection A fresh object which has not yet been added to the repository.
	 * @return void
	 */
	public function createAction(\Dragontale\CollectRecentEntries\Domain\Model\RecentEntryCollection $recentEntryCollection = NULL) {
		// TODO access protection
		$this->recentEntryCollectionRepository->add($recentEntryCollection);
		$this->addFlashMessage('created');
		$this->redirect('index');
	}

	/**
	 * Displays a form for editing an existing recent entry collection.
	 *
	 * @param Tx_BlogExample_Domain_Model_Blog $recentEntryCollection The object to be edited. This might also be a clone of the original object already containing modifications if the edit form has been submitted, contained errors and therefore ended up in this action again.
	 * @return void
	 * @dontvalidate $recentEntryCollection
	 */
	public function editAction(\Dragontale\CollectRecentEntries\Domain\Model\RecentEntryCollection $recentEntryCollection = NULL) {
		$this->view->assign('recentEntryCollection', $recentEntryCollection);
	}

	/**
	 * Updates an existing object.
	 *
	 * @param \Dragontale\CollectRecentEntries\Domain\Model\RecentEntryCollection $recentEntryCollection A not yet persisted clone of the original object containing the modifications.
	 * @return void
	 */
	public function updateAction(\Dragontale\CollectRecentEntries\Domain\Model\RecentEntryCollection $recentEntryCollection = NULL) {
		// TODO access protection
		$this->recentEntryCollectionRepository->update($recentEntryCollection);
		$this->addFlashMessage('updated');
		$this->redirect('index');
	}

	/**
	 * Deletes an existing object.
	 *
	 * @param \Dragontale\CollectRecentEntries\Domain\Model\RecentEntryCollection $recentEntryCollection A persisted object to be deleted.
	 * @return void
	 */
	public function deleteAction(\Dragontale\CollectRecentEntries\Domain\Model\RecentEntryCollection $recentEntryCollection = NULL) {
		// TODO access protection
		$this->recentEntryCollectionRepository->remove($recentEntryCollection);
		$this->addFlashMessage('deleted', t3lib_FlashMessage::INFO);
		$this->redirect('index');
	}

	/**
	 * Deletes all persistedobjects.
	 *
	 * @return void
	 */
	public function deleteAllAction() {
		// TODO access protection
		$this->recentEntryCollectionRepository->removeAll();
		$this->redirect('index');
	}

	/**
	 * Creates several new objects.
	 *
	 * @return void
	 */
	public function populateAction() {
		$to_add_count = 5;
		// TODO access protection
		$objects_count = $this->recentEntryCollectionRepository->countAll();
		$factory = $this->objectManager->get('\Dragontale\CollectRecentEntries\Domain\Model\RecentEntryCollectionFactory');
		for ($object_index = $objects_count + 1; $object_index < ($objects_count + $to_add_count); $object_index++) {
			$recentEntryCollection = $factory->create($object_index);
			$this->recentEntryCollectionRepository->add($recentEntryCollection);
		}
		$this->addFlashMessage('populated');
		$this->redirect('index');
	}
}

?>
