<?php
namespace Qinx\Qxnewsletter\Controller;

	/***************************************************************
	 *
	 *  Copyright notice
	 *
	 *  (c) 2016 Christian Pschorr <hello@qinx.me>
	 *
	 *  All rights reserved
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
	 ***************************************************************/

/**
 * NewsletterController
 */
class NewsletterController extends \TYPO3\CMS\Extbase\Mvc\Controller\ActionController {

	/**
	 * Return the current page uid, which is selected in page tree
	 *
	 * @return int
	 */
	protected function getPageUid() {
		return (int) \TYPO3\CMS\Core\Utility\GeneralUtility::_GP('id');
	}

	/**
	 * Read the source of the given page uid
	 *
	 * @param int $pageUid
	 * @return string
	 */
	protected function getPageSource($pageUid) {
		$pageUrl = \TYPO3\CMS\Core\Utility\GeneralUtility::getIndpEnv('TYPO3_SITE_URL') . 'index.php?id=' . $pageUid;
		echo $pageUrl;

		return \TYPO3\CMS\Core\Utility\GeneralUtility::getUrl($pageUrl);
	}

	/**
	 * Transform style block to inline style
	 *
	 * @param string $pageSource
	 * @return string
	 */
	protected function transform($pageSource) {
		$emogrifier = new \Pelago\Emogrifier($pageSource);

		return $emogrifier->emogrify();
	}

	public function readAction() {
		$pageSource = $this->getPageSource($this->getPageUid());

		$this->view->assign('pageSource', $pageSource);
	}
}