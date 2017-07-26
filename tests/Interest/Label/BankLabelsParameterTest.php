<?php
declare(strict_types=1);

namespace Dnhb\ApiClient\Tests\Interest\Label;
use Dnhb\ApiClient\Data\AvailableForType;
use Dnhb\ApiClient\Data\MortgageType;
use Dnhb\ApiClient\Interest\Label\BankLabelsParameter;
use Dnhb\ApiClient\Interest\Label\InterestLabelParameter;
use PHPUnit\Framework\TestCase;


/**
 * Class BankLabelsParameterTest
 */
final class BankLabelsParameterTest extends TestCase
{

    /**
     * Test different parameters on correct usage of the different
     * types of parameters.
     */
    public function testParameter()
    {
        $bankLabelsParameter = new BankLabelsParameter(
            1,
             null,
            new MortgageType(MortgageType::INTEREST_ONLY),
            new AvailableForType(AvailableForType::TYPE_BOTH),
            false,
            100.0,
            1,
            true,
            null,
            1,
            100
        );

        $this->assertSame(1, $bankLabelsParameter->getMortgageProviderId());
        $this->assertNull($bankLabelsParameter->getProductId());
        $this->assertInstanceOf(MortgageType::class, $bankLabelsParameter->getMortgageType());
        $this->assertSame(MortgageType::INTEREST_ONLY, $bankLabelsParameter->getMortgageType()->getValue());
        $this->assertInstanceOf(AvailableForType::class, $bankLabelsParameter->getAvailableFor());
        $this->assertSame(AvailableForType::TYPE_BOTH, $bankLabelsParameter->getAvailableFor()->getValue());
        $this->assertFalse($bankLabelsParameter->getNhg());
        $this->assertSame(100.0, $bankLabelsParameter->getLtv());
        $this->assertSame(1, $bankLabelsParameter->getPeriod());
        $this->assertTrue($bankLabelsParameter->getOnlyUseIncludedLabels());
        $this->assertNull($bankLabelsParameter->getMaxLtv());
        $this->assertSame(1, $bankLabelsParameter->getPage());
        $this->assertSame(100, $bankLabelsParameter->getLimit());
    }
}