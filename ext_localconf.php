<?php
if(!defined('TYPO3_MODE')) {
	die('Access denied.');
}

\TYPO3\CMS\Extbase\Utility\ExtensionUtility::configurePlugin(
	'Qinx.' . $_EXTKEY,
	'Mod1',
	array(
		'Newsletter' => 'list, show',
	),

	// non-cacheable actions
	array(
		'Newsletter' => '',
	)
);

// hook is called before Caching / pages on their way in the cache.
$GLOBALS['TYPO3_CONF_VARS']['SC_OPTIONS']['tslib/class.tslib_fe.php']['contentPostProc-all'][] = \Qinx\Qxnewsletter\Service\InlineStyleService::class . '->hookOutputCache';

// hook is called after Caching / pages with COA_/USER_INT objects.
$GLOBALS['TYPO3_CONF_VARS']['SC_OPTIONS']['tslib/class.tslib_fe.php']['contentPostProc-output'][] = \Qinx\Qxnewsletter\Service\InlineStyleService::class . '->hookOutputNoCache';