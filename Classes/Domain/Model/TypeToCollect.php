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

	public function __construct()
	{
	}

};
?>

