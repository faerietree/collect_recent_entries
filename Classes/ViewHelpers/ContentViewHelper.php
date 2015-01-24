<?php
# Along motions-media, t3developer, teamgeist-medien example and stackoverflow (nbar, biesoir, Panagiotis).
namespace Dragontale\CollectRecentEntries\ViewHelpers;

class ContentViewHelper extends \TYPO3\CMS\Fluid\Core\ViewHelper\AbstractViewHelper {
 
    /**
     * @var \TYPO3\CMS\Extbase\Configuration\ConfigurationManagerInterface
     */
    protected $configurationManager;
 
    /**
     * @var Content Object
     */
    protected $cObj;
 
    /**
     * Parse content element.
     *
     * @param    int           UID des Content Element
     * @return   string        Geparstes Content Element
     */
    public function render($uid) {
	#echo 'render(): ' .$uid;
        $conf = array( // config
		'tables' => 'tt_content',
		'source' => $uid, #single uid or comma separated
		#'wrap' => '<div class="mydiv">|</div>',
		'dontCheckPid' => 1
        );
	#$content = $GLOBALS['TSFE']->cObj->RECORDS($conf);
	#echo 'render(): content: ' . $content. '<br/>'."\r\n";
        $content = $this->cObj->RECORDS($conf);
	#echo 'render(): content: ' . $content. '<br/>'."\r\n";
	return $content;
    }
 
    /**
     * Injects Configuration Manager
     *
     * @param \TYPO3\CMS\Extbase\Configuration\ConfigurationManagerInterface $configurationManager
     * @return void
    */
    public function injectConfigurationManager(\TYPO3\CMS\Extbase\Configuration\ConfigurationManagerInterface $configurationManager) {
        $this->configurationManager = $configurationManager;
        $this->cObj = $this->configurationManager->getContentObject();
    }
 
}


?>
