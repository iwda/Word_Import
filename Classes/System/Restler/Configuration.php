<?php
namespace Iwda\IwdaWord2digi\System\Restler;

use Aoe\Restler\System\Restler\ConfigurationInterface;
use Luracast\Restler\Defaults;
use Luracast\Restler\Format\JsonFormat;
use Luracast\Restler\Restler;


class Configuration implements ConfigurationInterface
{
    /**
     * @param Restler $restler
     * @return void
     */
    public function configureRestler(Restler $restler)
    {
        // set german as supported language
        //Defaults::$supportedLanguages = array('de');
        //Defaults::$language = 'de';
        JsonFormat::$prettyPrint = true;

        $restler->setSupportedFormats('JsonFormat');

        
        $restler->addAPIClass('Iwda\\IwdaWord2digi\\Controller\\RestController', 'api/rest-api-client');


        // add exception-handler (which logs exceptions)
        $restler->addErrorClass('Iwda\\IwdaWord2digi\\System\\Restler\\ExceptionHandler');

    }
}
