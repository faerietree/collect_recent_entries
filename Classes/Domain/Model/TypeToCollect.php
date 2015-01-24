<?php
namespace Dragontale\CollectRecentEntries\Domain\Model;

class TypeToCollect extends \TYPO3\CMS\Extbase\DomainObject\AbstractEntity {
//class Tx_CollectRecentEntries_Domain_Model_TypeToCollect extends Tx_Extbase_DomainObject_AbstractEntity {

	/**
         * Owning recent entry collection.
	 * @var int
	 */
	public $collection_id;

	/**
	 * Choice of a type from the enum typo3 content types.
	 * @var string
	 */
	public $type;


	// ========================================================//
	// METHODS 
	// ========================================================//
	public function __construct($collection_id, $type)
	{
		$this->setCollectionId($collection_id);
		$this->setType($type);
	}


	public function setCollectionId($collection_id)
	{
		$this->collection_id = (int)$collection_id;
	}

	public function getCollectionId()
	{
		return $this->collection_id;
	}


	public function setType($type)
	{
		$this->type = (string)$type;
	}

	public function getType()
	{
		return $this->type;
	}



};
?>
