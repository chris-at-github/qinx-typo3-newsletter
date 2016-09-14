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
		$emogrifier = new \Pelago\Emogrifier($pageSource);

		return $emogrifier->emogrify();
	}
}