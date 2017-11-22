
plugin.tx_iwdaword2digi_bspplugin {
  view {
    # cat=plugin.tx_iwdaword2digi_bspplugin/file; type=string; label=Path to template root (FE)
    templateRootPath = EXT:iwda_word2digi/Resources/Private/Templates/
    # cat=plugin.tx_iwdaword2digi_bspplugin/file; type=string; label=Path to template partials (FE)
    partialRootPath = EXT:iwda_word2digi/Resources/Private/Partials/
    # cat=plugin.tx_iwdaword2digi_bspplugin/file; type=string; label=Path to template layouts (FE)
    layoutRootPath = EXT:iwda_word2digi/Resources/Private/Layouts/
  }
  persistence {
    # cat=plugin.tx_iwdaword2digi_bspplugin//a; type=string; label=Default storage PID
    storagePid =
  }
}
