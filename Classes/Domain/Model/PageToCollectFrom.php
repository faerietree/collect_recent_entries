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

	public function __construct()
	{
	}

};
?>

