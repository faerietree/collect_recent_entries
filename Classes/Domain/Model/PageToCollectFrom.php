<?php
namespace Dragontale\CollectRecentEntries\Domain\Model;

class PageToCollectFrom extends \TYPO3\CMS\Extbase\DomainObject\AbstractEntity {
//class Tx_CollectRecentEntries_Domain_Model_PageToCollectFrom extends Tx_Extbase_DomainObject_AbstractEntity {

	/**
	 * @var choice of all the pages of this site.
	 */
	public $page_id;

	public function __construct()
	{
	}

};
?>

