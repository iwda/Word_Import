
plugin.tx_iwdaword2digi_bspplugin {
  view {
    templateRootPaths.0 = EXT:iwda_word2digi/Resources/Private/Templates/
    templateRootPaths.1 = {$plugin.tx_iwdaword2digi_bspplugin.view.templateRootPath}
    partialRootPaths.0 = EXT:iwda_word2digi/Resources/Private/Partials/
    partialRootPaths.1 = {$plugin.tx_iwdaword2digi_bspplugin.view.partialRootPath}
    layoutRootPaths.0 = EXT:iwda_word2digi/Resources/Private/Layouts/
    layoutRootPaths.1 = {$plugin.tx_iwdaword2digi_bspplugin.view.layoutRootPath}
  }
  persistence {
    storagePid = {$plugin.tx_iwdaword2digi_bspplugin.persistence.storagePid}
    #recursive = 1
  }
  features {
    #skipDefaultArguments = 1
  }
  mvc {
    #callDefaultActionIfActionCantBeResolved = 1
  }
}

plugin.tx_iwdaword2digi._CSS_DEFAULT_STYLE (
    textarea.f3-form-error {
        background-color:#FF9F9F;
        border: 1px #FF0000 solid;
    }

    input.f3-form-error {
        background-color:#FF9F9F;
        border: 1px #FF0000 solid;
    }

    .tx-iwda-word2digi table {
        border-collapse:separate;
        border-spacing:10px;
    }

    .tx-iwda-word2digi table th {
        font-weight:bold;
    }

    .tx-iwda-word2digi table td {
        vertical-align:top;
    }

    .typo3-messages .message-error {
        color:red;
    }

    .typo3-messages .message-ok {
        color:green;
    }
)
