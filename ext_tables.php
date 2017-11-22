<?php
defined('TYPO3_MODE') || die('Access denied.');

call_user_func(
    function($extKey)
    {

        \TYPO3\CMS\Extbase\Utility\ExtensionUtility::registerPlugin(
            'Iwda.IwdaWord2digi',
            'Bspplugin',
            'Beispiel Plugin'
        );

        \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addStaticFile($extKey, 'Configuration/TypoScript', 'Word2Digi');

        \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addLLrefForTCAdescr('tx_iwdaword2digi_domain_model_example', 'EXT:iwda_word2digi/Resources/Private/Language/locallang_csh_tx_iwdaword2digi_domain_model_example.xlf');
        \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::allowTableOnStandardPages('tx_iwdaword2digi_domain_model_example');

    },
    $_EXTKEY
);
