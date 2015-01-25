<?php
namespace Dragontale\CollectRecentEntries\Domain\Model;

class PageToCollectFrom extends \TYPO3\CMS\Extbase\DomainObject\AbstractEntity {
//class Tx_CollectRecentEntries_Domain_Model_PageToCollectFrom extends Tx_Extbase_DomainObject_AbstractEntity {

	/**
         * Owning recent entry collection.
	 * @var int
	 */
	public $collectionId;

	/**
         * Choice of the page for this collection n:m pages interconnection.
	 * @var int
	 */
	public $pageId;


	// ========================================================//
	// METHODS 
	// ========================================================//
	public function __construct($collectionId, $pageId)
	{
		$this->setCollectionId($collectionId);
		$this->setPageId($pageId);
	}


	public function setCollectionId($collectionId)
	{
		$this->collectionId = (int)$collectionId;
	}

	public function getCollectionId()
	{
		return $this->collectionId;
	}


	public function setPageId($pageId)
	{
		#$this->title = (string)$page_id;
		$this->pageId = (int)$pageId;
	}

	public function getPageId()
	{
		return $this->pageId;
	}



};
?>
