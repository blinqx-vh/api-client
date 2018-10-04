<?php
declare(strict_types=1);

namespace Dnhb\ApiClient\Tests\Signal\ForSale;

use DateTime;
use Dnhb\ApiClient\Data\ForSaleStatus;
use Dnhb\ApiClient\Signal\ForSale\ForSaleSignalParameter;
use PHPUnit\Framework\TestCase;

/**
 * Class ForSaleParameterTest
 */
final class ForSaleParameterTest extends TestCase
{
    /**
     * Test different parameters on correct usage of the different
     * types of parameters.
     *
     * @throws \Dnhb\ApiClient\Exception\ApiClientInvalidArgumentException
     */
    public function testParameter()
    {
        $parameter = new ForSaleSignalParameter(
            new ForSaleStatus(ForSaleStatus::FOR_SALE),
            new DateTime('2018-01-01 00:00:00'),
            new DateTime('2018-01-01 00:00:00'),
            1,
            100
        );

        $this->assertInstanceOf(ForSaleStatus::class, $parameter->getStatus());
        $this->assertInstanceOf(DateTime::class, $parameter->getNewSince());
        $this->assertSame('2018-01-01 00:00:00', $parameter->getNewSince()->format('Y-m-d H:i:s'));
        $this->assertInstanceOf(DateTime::class, $parameter->getUpdatedSince());
        $this->assertSame('2018-01-01 00:00:00', $parameter->getUpdatedSince()->format('Y-m-d H:i:s'));
        $this->assertSame(1, $parameter->getPage());
        $this->assertSame(100, $parameter->getLimit());
    }
}
