<?php
declare(strict_types = 1);

namespace Dnhb\ApiClient\Calculation\Regulation\ConstructionAddedValue;

use Dnhb\ApiClient\Contract\AbstractGetApiRequest;
use Dnhb\ApiClient\Request\WithFloatResult;

/**
 * Class ConstructionAddedValue
 *
 * @package Dnhb\ApiClient\Calculation\Regulation\ConstructionAddedValue
 */
final class ConstructionAddedValueRequest extends AbstractGetApiRequest
{
    use WithFloatResult;
    /** @var string */
    protected $baseUrl = 'calculation/v1/regulation/construction-added-value';
}