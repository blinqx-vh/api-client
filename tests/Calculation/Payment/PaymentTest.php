<?php
declare(strict_types = 1);

namespace Dnhb\ApiClient\Tests\Calculation\Payment;


use DateTime;
use Dnhb\ApiClient\Calculation\Mortgage\Payment\PaymentFixedRatePeriodParameter;
use Dnhb\ApiClient\Calculation\Mortgage\Payment\PaymentLoanpartParameter;
use Dnhb\ApiClient\Calculation\Mortgage\Payment\PaymentPersonParameter;
use Dnhb\ApiClient\Calculation\Mortgage\Payment\Response\Payment;
use Dnhb\ApiClient\Calculation\Mortgage\Payment\Response\TotalPayment;
use Dnhb\ApiClient\Data\MortgageType;
use Dnhb\ApiClient\Request\Method;
use Dnhb\ApiClient\Tests\TestCase\ApiClientTestCase;

/**
 * Class PaymentTest
 *
 * @package Dnhb\ApiClientTests\Calculation\Payment
 */
class PaymentTest extends ApiClientTestCase
{
    /** */
    public function testRequest()
    {
        $api = $this->getApi(
            '{"data":{"months":[{"month":1,"date":"2017-01-20","repayment":100000,"gross":0,"net":0,"remainingDebt":0,' .
            '"interest":0}],"total":{"interestPayment":0,"repayment":100000,"gross":100000,"net":100000,"remainingDebt' .
            '":0,"investment":100000}}}'
        );

        $fixedRatePeriods = [
            new PaymentFixedRatePeriodParameter(10, 2.65)
        ];

        $loanParts = [
            new PaymentLoanpartParameter(
                new MortgageType(MortgageType::LINEAR),
                100000.0,
                1,
                $fixedRatePeriods
            )
        ];

        $persons = [
            new PaymentPersonParameter(new DateTime('1980-01-01'), 15000),
            new PaymentPersonParameter(new DateTime('1985-01-01'), 35000)
        ];

        $result = $api->calculation()->getMortgagePayments($loanParts, 125000.0, $persons);


        $this->assertPayment($result->getPayments()[0]);
        $this->assertTotal($result->getTotal());

        // @TODO assert post body

        $this->assertRequestInContainer(
            Method::POST,
            '/calculation/v1/mortgage/payment',
            'api_key=key'
        );
    }

    /**
     * @param Payment $payment
     */
    private function assertPayment(Payment $payment)
    {
        self::assertSame(1, $payment->getMonth());
        self::assertSame('2017-01-20', $payment->getDate());
        self::assertSame(100000.0, $payment->getRepayment());
        self::assertSame(0.0, $payment->getGross());
        self::assertSame(0.0, $payment->getNet());
        self::assertSame(0.0, $payment->getRemainingDebt());
        self::assertSame(0.0, $payment->getInterest());
    }

    /**
     * @param TotalPayment $total
     */
    private function assertTotal(TotalPayment $total)
    {
        self::assertSame(0.0, $total->getInterestPayment());
        self::assertSame(100000.0, $total->getRepayment());
        self::assertSame(100000.0, $total->getGross());
        self::assertSame(100000.0, $total->getNet());
        self::assertSame(0.0, $total->getRemainingDebt());
        self::assertSame(100000.0, $total->getInvestment());
    }
}
