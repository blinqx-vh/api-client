<?php
declare(strict_types = 1);

namespace Dnhb\ApiClient\Import\MHDN;

use Dnhb\ApiClient\Contract\AbstractPostApiRequest;
use Dnhb\ApiClient\Contract\XmlablePostParameter;
use Dnhb\ApiClient\Request\MimeType;
use Dnhb\ApiClient\Request\WithIdResult;

/**
 * Class MHDNRequest
 *
 * @package Dnhb\ApiClient\Import\MHDN
 */
final class MHDNRequest extends AbstractPostApiRequest
{
    use WithIdResult;
    /**
     * @var string
     */
    protected $baseUrl = 'client/v1/import/mhdn/insert';

    /**
     * MHDNRequest constructor.
     *
     * @param XmlablePostParameter $parameter
     */
    public function __construct(XmlablePostParameter $parameter)
    {
        $this->options['body'] = $parameter->asXml();
        $this->headers['Content-Type'] = MimeType::XML;
    }
}