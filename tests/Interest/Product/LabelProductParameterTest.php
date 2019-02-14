<?php

namespace Dnhb\ApiClient\Tests\Interest\Product;

use Dnhb\ApiClient\Data\AvailableForType;
use Dnhb\ApiClient\Data\MortgageType;
use Dnhb\ApiClient\Interest\Product\LabelProductParameter;
use PHPUnit\Framework\TestCase;

/**
 * Class MortgageProvidersParameterTest
 */
final class LabelProductParameterTest extends TestCase
{
    /**
     * Test different parameters on correct usage of the different
     * types of parameters.
     * @throws \Dnhb\ApiClient\Exception\ApiClientInvalidArgumentException
     */
    public function testParameter()
    {
        $bankLabelsParameter = new LabelProductParameter(
            1,
            null,
            1,
            new MortgageType(MortgageType::INTEREST_ONLY),
            new AvailableForType(AvailableForType::TYPE_BOTH),
            false,
            100.0,
            1,
            true,
            1,
            100
        );

        $this->assertSame(1, $bankLabelsParameter->getMortgageProviderId());
        $this->assertNull($bankLabelsParameter->getLabelId());
        $this->assertSame(1, $bankLabelsParameter->getProductId());
        $this->assertInstanceOf(MortgageType::class, $bankLabelsParameter->getMortgageType());
        $this->assertSame(MortgageType::INTEREST_ONLY, $bankLabelsParameter->getMortgageType()->getValue());
        $this->assertInstanceOf(AvailableForType::class, $bankLabelsParameter->getAvailableFor());
        $this->assertSame(AvailableForType::TYPE_BOTH, $bankLabelsParameter->getAvailableFor()->getValue());
        $this->assertFalse($bankLabelsParameter->getNhg());
        $this->assertSame(100.0, $bankLabelsParameter->getLtv());
        $this->assertSame(1, $bankLabelsParameter->getPeriod());
        $this->assertTrue($bankLabelsParameter->getOnlyUseIncludedLabels());
        $this->assertSame(1, $bankLabelsParameter->getPage());
        $this->assertSame(100, $bankLabelsParameter->getLimit());
    }
}