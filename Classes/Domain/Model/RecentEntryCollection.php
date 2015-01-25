<?php
namespace Dragontale\CollectRecentEntries\Domain\Model;

class RecentEntryCollection extends \TYPO3\CMS\Extbase\DomainObject\AbstractEntity {
//class Tx_CollectRecentEntries_Domain_Model_RecentEntryCollection extends Tx_Extbase_DomainObject_AbstractEntity {

	/**
	 @var string
	 */
	protected $title = "";

	/**
	 @var int
	 */
	protected $entryCountMax = 1; // 1, namely the most recent entry by default. 

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
	 * tt_content results as results according to the criteria, i.e. pages to collect from and types to collect.
	 */
	public $content_uids;


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

	public function setTypesToCollect($v)
	{
		$this->typesToCollect = $v;
	}

	public function setPagesToCollectFrom($v)
	{
		$this->pagesToCollectFrom = $v;
	}

	// Note: To show a different set of content or to show it per page best
	// define another recent entry collection. Here it's all mixed together. 
	public function fillContentUids()
	{	
		// flush:
		$this->content_uids = array();
		// refill:
		$where_criteria = array();
		if (!empty($this->pagesToCollectFrom))
		{
			$where_criterium_page = " tt_content.pid IN(";
		 	$pages_count = sizeOf($this->pagesToCollectFrom);
			$where_criterium_page .= $this->pagesToCollectFrom[0]->page_id; // <-- To allow to add the , in the loop.
			$pages_index = 1;
			while (++$pages_index < $pages_count)
			{
				$pageToCollectFrom = $this->pagesToCollectFrom[$pages_index];
				$where_criterium_page .= ", " . $pageToCollectFrom->page_id;
			}
			$where_criterium_page .= ")";
			
			$where_criteria[] = $where_criterium_page;
		}
		// else // Collect from all pages.

		if (!empty($this->typesToCollect))
		{
			$where_criterium = " tt_content.CType IN(";
		 	$types_count = sizeOf($this->typesToCollect);
			$where_criterium .= $this->typesToCollect[0]->type; // <-- To allow to add the , in the loop.
			$types_index = 1;
			while (++$types_index < $types_count)
			{
				$typeToCollect = $this->typesToCollect[$types_index];
				$where_criterium .= ", " . $typeToCollect->type;
			}
			$where_criterium .= ")";
			
			$where_criteria[] = $where_criterium;
		}
		// else // Collect all types.

		// Exclude pages/lists/plugin:
		$where_criteria[] = " tt_content.CType <> 'list' ";
		$where_criteria[] = " tt_content.deleted <> 1 ";

		// Query for all tt_content rows that fulfill the criteria:
		$fields = /*"SELECT ".*/" uid, pid, tstamp";#, crdate, date"
		$from = " tt_content";

		$where = '';#" WHERE ";
		if (!empty($where_criteria))
		{
			$where .= $where_criteria[0];
			for ($i = 1; $i < sizeOf($where_criteria); ++$i)
				$where .= "AND " . $where_criteria[$i];
		}

		$orderBy = " ORDER BY tstamp DESC"; # TODO This order doesn't work. Group by needs to come first. Check MySQL for how to order first and then group.
		$groupBy = " GROUP BY pid"; // such that those that belong together are rendered together. TODO Make this an option!
		$limit = /*" LIMIT ". "0, ".*/ $this->getEntryCountMax()/* .""*/;

		$queryParts = array(
			'SELECT' => $fields,
			'FROM' => $from,
			'WHERE' => $where,
			'GROUPBY' => $GLOBALS['TYPO3_DB']->stripGroupBy($groupBy),
			'ORDERBY' => $GLOBALS['TYPO3_DB']->stripOrderBy($orderBy),
			'LIMIT' => $limit
		);
		#print_r($queryParts);
                $res = $GLOBALS['TYPO3_DB']->exec_SELECT_queryArray($queryParts); // list($row) = SELECTgetRows
                #$res = $GLOBALS['TYPO3_DB']->exec_SELECTquery($queryParts['SELECT'],$queryParts['FROM'],$queryParts['WHERE'],$queryParts['GROUPBY'],$queryParts['ORDERBY'],$queryParts['LIMIT']); // list($row) = SELECTgetRows
		#echo 'Resource handle: <br />';
		#print_r($res);
		#$res = $GLOBALS['TYPO3_DB']->exec_query($sql);
		$index = -1;
		#echo 'index: ' . $index;
		while (($row = $GLOBALS['TYPO3_DB']->sql_fetch_assoc($res))
&& ++$index < $this->getEntryCountMax())
		{
			#print_r($row);
			#echo 'index: ' . $index . ': uid: ' . $row['uid'].'<br/>'. "\r\n";
			// TODO Postprocess here if need arises?
			#echo '<br/>'.$row['uid']."\r\n";
			$this->content_uids[$index] = $row['uid'];
		}
		print_r($this->content_uids);
		
	}


};
?>

