<?php
namespace Dragontale\CollectRecentEntries\Domain\Model;

class PageToCollectFrom extends \TYPO3\CMS\Extbase\DomainObject\AbstractEntity {
//class Tx_CollectRecentEntries_Domain_Model_PageToCollectFrom extends Tx_Extbase_DomainObject_AbstractEntity {

	/**
         * Owning recent entry collection.
	 * @var int
	 */
	public $collection_id;

	/**
         * Choice of the page for this collection n:m pages interconnection.
	 * @var int
	 */
	public $page_id;


	// ========================================================//
	// METHODS 
	// ========================================================//
	public function __construct($collection_id, $page_id)
	{
		$this->setCollectionId($collection_id);
		$this->setPageId($page_id);
	}


	public function setCollectionId($collection_id)
	{
		$this->collection_id = (int)$collection_id;
	}

	public function getCollectionId()
	{
		return $this->collection_id;
	}


	public function setPageId($page_id)
	{
		#$this->title = (string)$page_id;
		$this->page_id = (int)$page_id;
	}

	public function getPageId()
	{
		return $this->page_id;
	}



};
?>
