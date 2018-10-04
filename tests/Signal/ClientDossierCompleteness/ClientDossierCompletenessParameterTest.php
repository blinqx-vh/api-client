<?php
declare(strict_types=1);

namespace Dnhb\ApiClient\Tests\Signal\ClientDossierCompleteness;

use DateTime;
use Dnhb\ApiClient\Signal\ClientDossierCompleteness\ClientDossierCompletenessSignalParameter;
use PHPUnit\Framework\TestCase;

/**
 * Class ClientDossierCompletenessParameterTest
 */
final class ClientDossierCompletenessParameterTest extends TestCase
{
    /**
     * Test different parameters on correct usage of the different
     * types of parameters.
     */
    public function testParameter()
    {
        $parameter = new ClientDossierCompletenessSignalParameter(
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
