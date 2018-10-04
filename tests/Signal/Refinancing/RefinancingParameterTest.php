<?php
declare(strict_types=1);


namespace Dnhb\ApiClient\Tests\Signal\Refinancing;

use DateTime;
use Dnhb\ApiClient\Signal\Refinancing\RefinancingSignalParameter;
use PHPUnit\Framework\TestCase;

/**
 * Class RefinancingParameterTest
 */
final class RefinancingParameterTest extends TestCase
{
    /**
     * Test different parameters on correct usage of the different
     * types of parameters.
     */
    public function testParameter()
    {
        $parameter = new RefinancingSignalParameter(
            new DateTime('2018-01-01 00:00:00'),
            new DateTime('2018-01-01 00:00:00'),
            1,
            100
        );

        $this->assertInstanceOf(DateTime::class, $parameter->getNewSince());
        $this->assertSame('2018-01-01 00:00:00', $parameter->getNewSince()->format('Y-m-d H:i:s'));
        $this->assertInstanceOf(DateTime::class, $parameter->getUpdatedSince());
        $this->assertSame('2018-01-01 00:00:00', $parameter->getUpdatedSince()->format('Y-m-d H:i:s'));
        $this->assertSame(1, $parameter->getPage());
        $this->assertSame(100, $parameter->getLimit());
    }
}
