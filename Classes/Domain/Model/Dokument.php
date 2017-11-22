<?php
namespace Iwda\IwdaWord2digi\Domain\Model;

/**
 * This class represents a dokument.
 *
 * This class is used in this cases:
 *  - If it's an GET-request, we use this class in API-class to create the response
 *  - If it's an POST-request, we use this class in API-class as method-parameter (so the API-method has only one param)
 *  - Inside the online-documentation, we see the structure of the response, which the API will return
 *  - Creating swagger spec model (json schema)
 *
 * @subpackage Domain/Model
 */
class Dokument
{

    /**
     * @var array
     */
    public $content;
}