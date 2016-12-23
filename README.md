#Hypotheekbond API Client

##Description
Wrapper around the Hypotheekbond API


##Example usage

constructing the api client 

    $auth = Dnhb\ApiClient\Auth\Auth::apiKey("your-api-key");
    $client = new Client(new \GuzzleHttp\Client(), $auth);
    $api = new Dnhb\ApiClient\Api($client);
    
simple usage

    $constructionAddedValue = $api->calculation()->getConstructionAddedValue();
    
complex requests

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

    $payments = $api->calculation()->getMortgagePayments($loanParts, 125000.0, $persons); 
    $investment = $payments->getTotal()->getInvestment();
    $firstMonthInterest = $response->getPayments()[0]->getInterest();
     
   