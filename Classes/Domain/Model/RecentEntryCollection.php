<?php
namespace Dragontale\CollectRecentEntries\Domain\Model;

class RecentEntryCollection extends \TYPO3\CMS\Extbase\DomainObject\AbstractEntity {
//class Tx_CollectRecentEntries_Domain_Model_RecentEntryCollection extends Tx_Extbase_DomainObject_AbstractEntity {

	/**
	 @var string
	 */
	protected $title = "";

	/**
	 @var array of string (types directly)
	 @var array of int (typetocollect uid)
	 */
	protected $typesToCollect = array(); // ["image", "text", ..]
	/**
	 @var array of int (pages' uid directly)
	 @var array of int (pagetocollectfrom uid)
	 */
	protected $pagesToCollectFrom = array(); // [0, 1, ...] pid integer 

	/**
	 @var int
	 */
	protected $entryCountMax = 1; // 1, namely the most recent entry by default. 


	// ========================================================//
	// METHODS 
	// ========================================================//
	public function __construct($title = "", $entryCountMax = 1)
	{
		$this->setTitle($title);
		$this->setEntryCountMax($entryCountMax);
	
	}

	public function setTitle($v)
	{
		$this->title = (string)$v;
	}

	public function getTitle()
	{
		return $this->title;
	}

	public function setEntryCountMax($v)
	{
		$this->entryCountMax = (int)$v;
	}

	public function getEntryCountMax()
	{
		return $this->entryCountMax;

	}



};
?>

