<?php
namespace Dragontale\CollectRecentEntries\Domain\Model;

class TypeToCollect extends \TYPO3\CMS\Extbase\DomainObject\AbstractEntity {
//class Tx_CollectRecentEntries_Domain_Model_TypeToCollect extends Tx_Extbase_DomainObject_AbstractEntity {

	/**
         * Owning recent entry collection.
	 * @var int
	 */
	public $collectionId;

	/**
	 * Choice of a type from the enum typo3 content types.
	 * @var string
	 */
	public $type;


	// ========================================================//
	// METHODS 
	// ========================================================//
	public function __construct($collectionId, $type)
	{
		echo 'collection_id: ' . $collectionId;
		$this->setCollectionId($collectionId);
		$this->setType($type);
	}


	public function setCollectionId($collectionId)
	{
		$this->collectionId = (int)$collectionId;
	}

	public function getCollectionId()
	{
		return $this->collectionId;
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
