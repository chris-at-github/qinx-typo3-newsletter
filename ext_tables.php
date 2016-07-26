<?php
if (!defined('TYPO3_MODE')) {
	die('Access denied.');
}

//\TYPO3\CMS\Extbase\Utility\ExtensionUtility::registerPlugin(
//	'Qinx.' . $_EXTKEY,
//	'Mod1',
//	'Newsletter'
//);

if(TYPO3_MODE === 'BE') {
	\TYPO3\CMS\Extbase\Utility\ExtensionUtility::registerModule(
		'Qinx.' . $_EXTKEY,
		'web',          // Main area
		'Mod1',         // Name of the module
		'',             // Position of the module
		array(          // Allowed controller action combinations
			'Newsletter' => 'read',
		),
		array(          // Additional configuration
			'access' => 'user,group',
			'icon'   => 'EXT:qxnewsletter/Resources/Public/Icons/tx_qxnewsletter_domain_model_newsletter.gif',
			'labels' => 'LLL:EXT:qxnewsletter/Resources/Private/Language/locallang_db.xlf:mod.label',
		)
	);
}

\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addStaticFile($_EXTKEY, 'Configuration/TypoScript', 'Qinx Newsletter');

//\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addLLrefForTCAdescr('tx_qxnewsletter_domain_model_newsletter', 'EXT:qxnewsletter/Resources/Private/Language/locallang_csh_tx_qxnewsletter_domain_model_newsletter.xlf');
//\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::allowTableOnStandardPages('tx_qxnewsletter_domain_model_newsletter');