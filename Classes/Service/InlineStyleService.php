<?php
/**
 * Created by PhpStorm.
 * User: wasserthal
 * Date: 11.08.2016
 * Time: 17:08
 */

namespace Qinx\Qxnewsletter\Service;

class InlineStyleService {

	/**
	 * objectManager
	 *
	 * @var \TYPO3\CMS\Extbase\Object\ObjectManager
	 */
	protected $objectManager;

	/**
	 * Plugin TypoScript Settings
	 *
	 * @var array $settings
	 */
	protected $settings;

	/**
	 * return an instance of objectManager
	 *
	 * @param none
	 * @return \TYPO3\CMS\Extbase\Object\ObjectManager
	 */
	public function getObjectManager() {
		if(($this->objectManager instanceof \TYPO3\CMS\Extbase\Object\ObjectManager) === false) {
			$this->objectManager = \TYPO3\CMS\Core\Utility\GeneralUtility::makeInstance('TYPO3\\CMS\\Extbase\\Object\\ObjectManager');
		}

		return $this->objectManager;
	}

	/**
	 * Return the typoscript settings for this plugin
	 *
	 * @return array
	 */
	public function getSettings() {
		if(isset($this->settings) === false) {
			$this->settings = $this->getObjectManager()->get('TYPO3\\CMS\\Extbase\\Configuration\\ConfigurationManager')->getConfiguration(
				\TYPO3\CMS\Extbase\Configuration\ConfigurationManagerInterface::CONFIGURATION_TYPE_SETTINGS, 'Qxnewsletter', 'Frontend'
			);
		}

		return $this->settings;
	}

	/**
	 * After render hook for non cached pages
	 *
	 * @param array $params
	 * @param object $pObj
	 */
	public function hookOutputNoCache(&$params, &$pObj) {
		$params['pObj']->content = $this->transform($params['pObj']->content);
	}

	/**
	 * After render hook for cached pages
	 *
	 * @param array $params
	 * @param object $pObj
	 */
	public function hookOutputCache(&$params, &$pObj) {
		$params['pObj']->content = $this->transform($params['pObj']->content);
	}

	/**
	 * Transform style block to inline style
	 *
	 * @param string $pageSource
	 * @return string
	 */
	protected function transform($pageSource) {
		$settings = $this->getSettings();
		$rootline = \TYPO3\CMS\Core\Utility\GeneralUtility::makeInstance('TYPO3\CMS\Core\Utility\RootlineUtility', $GLOBALS['TSFE']->page['pid'])->get();
		$emogrifier = new \Pelago\Emogrifier($pageSource);

		// Replace styles only if you are in newsletter folder
		foreach($rootline as $page) {
			if((int) $page['uid'] === (int) $settings['rootPid']) {
				return $emogrifier->emogrify();
			}
		}

		return $pageSource;
	}
}