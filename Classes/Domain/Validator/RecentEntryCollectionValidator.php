<?php

/***************************************************************
 *  Copyright notice
 *
 *  (c) 2009 Jochen Rau <jochen.rau@typoplanet.de>
 *  (c) 2011 Bastian Waidelich <bastian@typo3.org>
 *  All rights reserved
 *
 *  This script is part of the TYPO3 project. The TYPO3 project is
 *  free software; you can redistribute it and/or modify
 *  it under the terms of the GNU General Public License as published by
 *  the Free Software Foundation; either version 2 of the License, or
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
 ***************************************************************/

/**
 * An exemplary Blog validator
 */
class Tx_CollectRecentEntries_Domain_Validator_RecentEntryCollectionValidator extends Tx_Extbase_Validation_Validator_AbstractValidator {

	/**
	 * Checks whether the given object is valid.
	 *
	 * @param Tx_CollectRecentEntries_Domain_Model_RecentEntryCollection $object The object to check for validity.
	 * @return boolean TRUE if the object could be validated, otherwise FALSE.
	 */
	public function isValid($object) {
		if (strtolower($object->getTitle()) === 'extbase') {
			$this->addError(Tx_Extbase_Utility_Localization::translate('error.RecentEntryCollection.invalidTitle', 'CollectRecentEntries'), 1297418974);
			return FALSE;
		}
		return TRUE;
	}

}
?>
