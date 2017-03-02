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
     

Import requests

    $scope = new Scope('Scope');
        
    $dossier = new DossierParameter('DossierParameter', $scope);
    $dossier->createPerson('ApplicantParameter')
        ->setIsPrimaryContact(true)
        ->setLastName('LastName');
        
    $dossierId = $api->import()->insertDossier($scope);
    
Complex import requests
    
    $scope = new Scope('Scope');
        
    $address = new AddressParameter('Address', $scope);
    $address->setPostalCode('1000AA')
        ->setHouseNumber('1')
        ->setStreet('Damrak')
        ->setCity('Amsterdam');
        
    $dossier = new DossierParameter('DossierParameter', $scope);
    $dossier->setClientStatus(new ClientStatus(ClientStatus::PROSPECT))
        ->setMaritalStatus(new MaritalStatus(MaritalStatus::MARRIED_PRENUPTIAL_AGREEMENT))
        ->setNote('This is a note')
        ->addCorrespondenceAddress($address);
        
    $dossier->createHouse('HouseParameter')
        ->addAddress($address);
        
    $dossier->createPerson('Person1')
        ->setIsPrimaryContact(true)
        ->setLastName('LastName');
        
    $dossierId = $api->import()->insertDossier($scope);
    
Import Parameter relations in two ways
    
    $scope = new Scope('Scope');
        
    $dossier = new DossierParameter('BasicDossier', $scope);
    $dossier->createPerson('FirstPerson') // Note that createPerson returns a PersonParamater
        ->setIsPrimaryContact(true)
        ->setLastName('First');
        
    $person = new PersonParameter('SecondPerson', $scope); // Note that you have to specify the scope
    $person->setIsPrimaryContact(false)
        ->setLastName('Second');
            
    $dossier->addPerson($person); // Note that you have to create the relation between the person and the dossier
        
The second way is especially usefull for objects that can be used for different
Parameter objects, like the AddressParameter which can be related to the 
DossierParameter (addCorrespondenceAddress()) and the HouseParameter (addAddress())
    