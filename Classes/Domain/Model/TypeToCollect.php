<?php
namespace Dragontale\CollectRecentEntries\Domain\Model;

class TypeToCollect extends \TYPO3\CMS\Extbase\DomainObject\AbstractEntity {
//class Tx_CollectRecentEntries_Domain_Model_TypeToCollect extends Tx_Extbase_DomainObject_AbstractEntity {

	/**
	 * @var choice of the enum typo3 content types
	 */
	public $type;

	public function __construct()
	{
	}

};
?>

