<?php
declare(strict_types = 1);

namespace Dnhb\ApiClient\Tests\Calculation\Mortgage\MaximumByIncome;

use Dnhb\ApiClient\Api;
use Dnhb\ApiClient\Auth\Auth;
use Dnhb\ApiClient\Calculation\Mortgage\MaximumByIncome\MaximumMortgageByIncomePersonParameter;
use Dnhb\ApiClient\Client;
use Dnhb\ApiClient\Import\Parameter\PersonParameter;
use Dnhb\ApiClient\Request\Method;
use Dnhb\ApiClient\Tests\TestCase\ApiClientTestCase;

/**
 * Class MaximumMortgageByIncomeTest
 *
 * @package Dnhb\ApiClientTests\Calculation\Mortgage\MaximumByIncome
 */
final class MaximumMortgageByIncomeTest extends ApiClientTestCase
{
    /** */
    public function testRequest()
    {
        $api = $this->getApi('{"data":{"result":150000.0,"calculationValues":{"totalReferenceIncome":36000.0}}}');

        $persons = [
            new MaximumMortgageByIncomePersonParameter(35000.0, 18, 0.0, 0.0, 0.0, 0.0),
            new MaximumMortgageByIncomePersonParameter(0.0, 18, 0.0, 0.0, 0.0, 0.0),
        ];

        $result = $api->calculation()->getMaximumMortgageByIncome(
            2.35,
            $persons,
            false,
            360,
            120,
            0.0,
            0.0
        );

        self::assertSame(150000.0, $result);

        $this->assertRequestInContainer(
            Method::GET,
            '/calculation/v1/mortgage/maximum-by-income',
            implode(
                '&',
                [
                    'nhg=false',
                    'duration=360',
                    'percentage=2.35',
                    'rateFixation=10',
                    'notDeductible=0',
                    'groundRent=0',
                    'person%5B0%5D%5Bincome%5D=35000',
                    'person%5B0%5D%5Bage%5D=18',
                    'person%5B0%5D%5Balimony%5D=0',
                    'person%5B0%5D%5Bloans%5D=0',
                    'person%5B0%5D%5BstudentLoans%5D=0',
                    'person%5B0%5D%5BstudentLoanMonthlyAmount%5D=0',
                    'person%5B1%5D%5Bincome%5D=0',
                    'person%5B1%5D%5Bage%5D=18',
                    'person%5B1%5D%5Balimony%5D=0',
                    'person%5B1%5D%5Bloans%5D=0',
                    'person%5B1%5D%5BstudentLoans%5D=0',
                    'person%5B1%5D%5BstudentLoanMonthlyAmount%5D=0',
                    'api_key=key',
                ]
            )
        );
    }
}
