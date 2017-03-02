<?php
declare(strict_types=1);

namespace Dnhb\ApiClient\Tests\Calculation\Fine;


use DateTime;
use Dnhb\ApiClient\Data\MortgageType;
use Dnhb\ApiClient\Request\Method;
use Dnhb\ApiClient\Tests\TestCase\ApiClientTestCase;

/**
 * Class FineLoanpartTest
 *
 * @package Dnhb\ApiClientTests\Calculation\Fine
 */
final class FineLoanpartTest extends ApiClientTestCase
{

    /** */
    public function testRequest()
    {
        $api = $this->getApi('{"data":{"result":10000}}');

        $result = $api->calculation()->getLoanpartFine(
            DateTime::createFromFormat('Y-m-d', '2000-10-10'),
            360,
            DateTime::createFromFormat('Y-m-d', '2000-10-10'),
            240,
            100000.0,
            4.65,
            200000.0,
            new MortgageType(MortgageType::LINEAR),
            DateTime::createFromFormat('Y-m-d', '2020-10-10'),
            2.15,
            10.0
        );

        self::assertSame(10000.0, $result);

        $this->assertRequestInContainer(
            Method::GET,
            '/calculation/v1/fine/loanpart',
            implode('&', [
                'loanPartStartDate=2000-10-10',
                'loanPartDuration=360',
                'fixedRateTermStartDate=2000-10-10',
                'fixedRateTermDurationInMonths=240',
                'remainingDebt=100000',
                'percentage=4.65',
                'originalDebt=200000',
                'mortgageType=linear',
                'refinancingDate=2020-10-10',
                'presentDayInterest=2.15',
                'fineFreePercentage=10',
                'api_key=key'
            ])
        );
    }
}