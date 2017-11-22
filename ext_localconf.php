<?php
if(!defined('TYPO3_MODE')){
	die ('Access denied.');
}

$GLOBALS['TYPO3_CONF_VARS']['SC_OPTIONS']['restler']['restlerConfigurationClasses'][] = 'Iwda\\IwdaWord2digi\\System\\Restler\\Configuration';
$GLOBALS['TYPO3_Restler']['addApiClass']['typo3conf/ext/iwda_word2digi/Classes/Controller/RestController'][] 
= 'Iwda\\IwdaWord2digi\\Controller\\RestController';


