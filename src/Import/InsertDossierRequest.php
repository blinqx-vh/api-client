<?php
declare(strict_types = 1);

namespace Dnhb\ApiClient\Import;

use Assert\Assertion;
use Dnhb\ApiClient\Contract\AbstractPostApiRequest;
use Dnhb\ApiClient\Contract\PostParameterInterface;
use Dnhb\ApiClient\Import\Manager\ImportParameterManager;
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
     * @param ImportParameterManager|PostParameterInterface $importParameterManager
     */
    public function __construct(PostParameterInterface $importParameterManager)
    {
        Assertion::isInstanceOf(
            $importParameterManager,
            ImportParameterManager::class,
            'Parameter for InsertDossierRequest should be an instance of ' . ImportParameterManager::class
        );

        $this->options['body'] = json_encode($importParameterManager->toJsonableObject());
        parent::__construct($importParameterManager);
    }
}