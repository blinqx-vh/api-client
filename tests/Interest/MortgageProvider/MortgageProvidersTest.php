<?php


namespace Dnhb\ApiClient\Tests\Interest\MortgageProvider;


use Dnhb\ApiClient\Data\AvailableForType;
use Dnhb\ApiClient\Data\MortgageType;
use Dnhb\ApiClient\Request\Method;
use Dnhb\ApiClient\Tests\TestCase\ApiClientTestCase;

/**
 * Class MortgageProvidersTest
 */
final class MortgageProvidersTest extends ApiClientTestCase
{

    /**
     * Test the request.
     */
    public function testRequest()
    {
        $api = $this->getApi('
            {
              "data": [
                {
                  "id": 0,
                  "name": "string"
                }
              ]
            }
        ');

        $result = $api->interest()->getMortgageProviders(
            1,
            23,
            null,
            new MortgageType(MortgageType::ANNUITY),
            new AvailableForType(AvailableForType::TYPE_BOTH),
            true,
            100.0,
            1,
            false,
            1,
            250
        );

        foreach ($result as $assertableArray) {
            $this->executeAssertChecks($assertableArray);
        }

        $this->assertRequestInContainer(
            Method::GET,
            '/interest/v1/mortgage-provider',
            implode('&', [
                'mortgageProviderId=1',
                'labelId=23',
                'repaymentType=ANNUITY',
                'availableFor=BOTH',
                'nhg=true',
                'loanToValuePercentage=100',
                'period=1',
                'onlyUseIncludedLabels=false',
                'page=1',
                'limit=250',
                'api_key=key'
            ])
        );
    }

    /**
     * Assert check on array result return.
     *
     * @param $results
     */
    private function executeAssertChecks($results)
    {
        self::assertArrayHasKey('id', $results);
        self::assertArrayHasKey('name', $results);
    }
}