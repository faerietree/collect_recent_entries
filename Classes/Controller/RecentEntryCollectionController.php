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

	public function listAction() {

		//$repository = t3lib_div::makeInstance("Tx_CollectRecentEntries_Domain_Repository_RecentEntryCollectionRepository");
		$repository = $this->recentEntryCollectionRepository;
		$all = $repository->findAll();
		$this->view->assign("recent_entry_collections", $all);
		return $this->view->render(); // <-- Extbase also cares for that should it be forgotten here.
	}

	/**
	 * Displays a (backend!) form for creating a new collection.
	 *
	 * @param Tx_BlogExample_Domain_Model_Blog $newBlog A fresh blog object taken as a basis for the rendering
	 * @return void
	 * @dontvalidate $newBlog
	 */
	public function newAction(Tx_BlogExample_Domain_Model_Blog $newBlog = NULL) {
		$this->view->assign('newBlog', $newBlog);
		$this->view->assign('administrators', $this->administratorRepository->findAll());
	}

	/**
	 * Creates a new blog
	 *
	 * @param Tx_BlogExample_Domain_Model_Blog $newBlog A fresh Blog object which has not yet been added to the repository
	 * @return void
	 */
	public function createAction(Tx_BlogExample_Domain_Model_Blog $newBlog) {
		// TODO access protection
		$this->blogRepository->add($newBlog);
		$this->addFlashMessage('created');
		$this->redirect('index');
	}

	/**
	 * Displays a form for editing an existing blog
	 *
	 * @param Tx_BlogExample_Domain_Model_Blog $blog The blog to be edited. This might also be a clone of the original blog already containing modifications if the edit form has been submitted, contained errors and therefore ended up in this action again.
	 * @return void
	 * @dontvalidate $blog
	 */
	public function editAction(Tx_BlogExample_Domain_Model_Blog $blog) {
		$this->view->assign('blog', $blog);
		$this->view->assign('administrators', $this->administratorRepository->findAll());
	}

	/**
	 * Updates an existing blog
	 *
	 * @param Tx_BlogExample_Domain_Model_Blog $blog A not yet persisted clone of the original blog containing the modifications
	 * @return void
	 */
	public function updateAction(Tx_BlogExample_Domain_Model_Blog $blog) {
		// TODO access protection
		$this->blogRepository->update($blog);
		$this->addFlashMessage('updated');
		$this->redirect('index');
	}

	/**
	 * Deletes an existing blog
	 *
	 * @param Tx_BlogExample_Domain_Model_Blog $blog The blog to delete
	 * @return void
	 */
	public function deleteAction(Tx_BlogExample_Domain_Model_Blog $blog) {
		// TODO access protection
		$this->blogRepository->remove($blog);
		$this->addFlashMessage('deleted', t3lib_FlashMessage::INFO);
		$this->redirect('index');
	}

	/**
	 * Deletes an existing blog
	 *
	 * @return void
	 */
	public function deleteAllAction() {
		// TODO access protection
		$this->blogRepository->removeAll();
		$this->redirect('index');
	}

	/**
	 * Creates a several new blogs
	 *
	 * @return void
	 */
	public function populateAction() {
		// TODO access protection
		$numberOfExistingBlogs = $this->blogRepository->countAll();
		$blogFactory = $this->objectManager->get('Tx_BlogExample_Domain_Service_BlogFactory');
		for ($blogNumber = $numberOfExistingBlogs + 1; $blogNumber < ($numberOfExistingBlogs + 5); $blogNumber++) {
			$blog = $blogFactory->createBlog($blogNumber);
			$this->blogRepository->add($blog);
		}
		$this->addFlashMessage('populated');
		$this->redirect('index');
	}
}

?>

};

?>


