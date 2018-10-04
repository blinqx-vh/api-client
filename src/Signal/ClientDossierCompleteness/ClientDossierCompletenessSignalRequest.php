<?php
declare(strict_types=1);

namespace Dnhb\ApiClient\Signal\ClientDossierCompleteness;

use Dnhb\ApiClient\Contract\AbstractGetApiRequest;
use Dnhb\ApiClient\Request\WithArrayResult;

/**
 * Class ClientDossierCompletenessSignalRequest
 */
final class ClientDossierCompletenessSignalRequest extends AbstractGetApiRequest
{
    use WithArrayResult;

    /** @var string */
    protected $baseUrl = 'signal/v1/client-dossier-completeness';

    /**
     * ClientDossierCompletenessSignalRequest constructor.
     *
     * @param ClientDossierCompletenessSignalParameter $parameter
     */
    public function __construct(ClientDossierCompletenessSignalParameter $parameter)
    {
        $this->requestParams = $parameter->serialize();
    }
}
