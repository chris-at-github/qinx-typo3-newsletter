<?php
if (!defined('TYPO3_MODE')) {
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
