<?php


namespace Dragontale\CollectRecentEntries;

/* * *************************************************************
 *  Copyright notice:
 *
 *  (c) 2014 FaerieTree <development@dragontale.de>
 *  
 *  All rights reserved.
 *
 *  This script is part of the TYPO3 project. The TYPO3 project is
 *  free software; you can redistribute it and/or modify
 *  it under the terms of the GNU General Public License as published by
 *  the Free Software Foundation; either version 3 of the License, or
 *  (at your option) any later version.
 *
 *  The GNU General Public License can be found at
 *  http://www.gnu.org/copyleft/gpl.html.
 *
 *  This script is distributed in the hope that it will be useful,
 *  but WITHOUT ANY WARRANTY; without even the implied warranty of
 *  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 *  GNU General Public License for more details.
 *
 *  This copyright notice MUST APPEAR in all copies of the script!
 * ************************************************************* */
#class Tx_CollectRecentEntries_Select {
class Select {
    
    function getAllContentTypes($PA, $fobj) {
        

        $sql = "SELECT DISTINCT `CType`"
           . " FROM `tt_content`"
           . " WHERE tt_content.deleted < 1";

        #$res = PDO::query($sql);
        $res = $GLOBALS['TYPO3_DB']->exec_SELECTquery('DISTINCT CType', 'tt_content', 'tt_content.deleted < 1');
        #list($rows) = $GLOBALS['TYPO3_DB']->exec_SELECTgetRows('tx_realurl_nocache',
        #while ($row = $res->fetch(PDO::FETCH_ASSOC)) {
        $index = -1;
        $PA['items'] = array(); // array of size of count rows fetched.
        while ($row = $GLOBALS['TYPO3_DB']->sql_fetch_assoc($res)) {
            $title = $row['CType'];
            $value = $row['CType']; // TODO Would be the id of a table types if such a table existed in Typo3. Clarify this value. 
            $icon = '';
            ++$index;
            $PA['items'][$index] = array($title, $value, $icon);
        }

    }
    

}

?>
