<?php if (!defined('TL_ROOT')) die('You cannot access this file directly!');

/**
 * Contao Open Source CMS
 * Copyright (C) 2005-2013 Leo Feyer
 *
 * Formerly known as TYPOlight Open Source CMS.
 *
 * This program is free software: you can redistribute it and/or
 * modify it under the terms of the GNU Lesser General Public
 * License as published by the Free Software Foundation, either
 * version 3 of the License, or (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the GNU
 * Lesser General Public License for more details.
 *
 * You should have received a copy of the GNU Lesser General Public
 * License along with this program. If not, please visit the Free
 * Software Foundation website at <http://www.gnu.org/licenses/>.
 *
 * PHP version 5
 * @copyright  Cliff Parnitzky 2012-2013
 * @author     Cliff Parnitzky
 * @package    ExtendedEmailRegex
 * @license    LGPL
 */

/**
 * Class ExtendedEmailRegex
 *
 * Provide methods to handle the regex
 * @copyright  Cliff Parnitzky 2012-2013
 * @author     Cliff Parnitzky
 * @package    ExtendedEmailRegex
 */
class ExtendedEmailRegex {
	/**
	 * Validate the custom regex
	 * @param string
	 * @return boolean
	 */
	public function addExtendedEmailRegex($strRegexp, $varValue, Widget $objWidget)
	{
		if ($strRegexp == 'emailList')
		{
			$emails = ExtendedEmailRegex::getEmailsFromList($varValue);
			
			foreach($emails as $email)
			{
				if ($email && !preg_match('/^(\w+[!#\$%&\'\*\+\-\/=\?^_`\.\{\|\}~]*)+(?<!\.)@\w+([_\.-]*\w+)*\.[a-z]{2,6}$/i', trim($email)))
				{
					$objWidget->addError(sprintf($GLOBALS['TL_LANG']['ERR']['emailList'], $objWidget->label));
					return true;
				}
			}
		}
		return false;
	}
	
	/**
	 * Separates all email from a comma-delimited list into an array.
	 * @param string
	 * @return array
	 */
	public static function getEmailsFromList($list) {
		return explode(',', $list);
	}
}

?>