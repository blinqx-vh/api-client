<?php
declare(strict_types = 1);

namespace Dnhb\ApiClient\Import;

use Dnhb\ApiClient\Contract\AbstractPostApiRequest;
use Dnhb\ApiClient\Contract\JsonablePostParameter;
use Dnhb\ApiClient\Request\WithIdResult;

/**
 * Class InsertDossierRequest
 *
 * @package Dnhb\ApiClient\Import
 */
final class InsertDossierRequest extends AbstractPostApiRequest
{
    use WithIdResult;
    /**
     * @var string
     */
    protected $baseUrl = 'client/v1/import/insert';

    /**
     * InsertDossierRequest constructor.
     *
     * @param JsonablePostParameter $importParameterManager
     */
    public function __construct(JsonablePostParameter $importParameterManager)
    {
        $this->options['body'] = json_encode($importParameterManager->toJsonableObject(), JSON_PRESERVE_ZERO_FRACTION);
    }
}
