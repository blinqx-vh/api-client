<?php
declare(strict_types = 1);

namespace Dnhb\ApiClient\Tests\Import;

use Assert\InvalidArgumentException;
use DateTime;
use Dnhb\ApiClient\Data\ClientStatus;
use Dnhb\ApiClient\Data\CreditType;
use Dnhb\ApiClient\Data\Gender;
use Dnhb\ApiClient\Data\LifeInsuranceCoverageType;
use Dnhb\ApiClient\Data\MaritalStatus;
use Dnhb\ApiClient\Data\PaymentPeriod;
use Dnhb\ApiClient\Import\Manager\ImportParameterManager;
use Dnhb\ApiClient\Import\Parameter\AddressParameter;
use Dnhb\ApiClient\Import\Parameter\DossierParameter;
use Dnhb\ApiClient\Import\Parameter\ObligationParameter;
use Dnhb\ApiClient\Import\Scope;
use Dnhb\ApiClient\Request\Method;
use Dnhb\ApiClient\Tests\TestCase\ApiClientTestCase;

final class ImportTest extends ApiClientTestCase
{
    private static function assertEqualParameter(string $expected, Scope $scope): void
    {
        $importParameterManager = new ImportParameterManager();
        $importParameterManager->addScope($scope);

        self::assertEquals(
            $expected,
            json_encode($importParameterManager->toJsonableObject(), JSON_THROW_ON_ERROR)
        );
    }

    /** Most basic request possible */
    public function testRequest(): void
    {
        $api = $this->getApi('{"data":{"id":1}}');

        $scope = new Scope('Scope');

        $dossier = new DossierParameter('DossierParameter', $scope);
        $dossier->createPerson('ApplicantParameter')
            ->setIsPrimaryContact(true)
            ->setLastName('LastName');

        self::assertEqualParameter(
            '{"Scope":{"DossierParameter":{"@type":"Dossier","hasPersons":["ApplicantParameter"],"hasHouses":[],"hasExternalDocuments":[],"hasLifeInsurances":[],"clientStatus":"PROSPECT","labels":[]},"ApplicantParameter":{"@type":"Person","isPrimaryContact":true,"lastName":"LastName"}}}',
            $scope
        );

        $result = $api->import()->insertDossier($scope);
        self::assertEquals(1, $result);

        $this->assertRequestInContainer(
            Method::POST,
            '/client/v1/import/insert',
            'api_key=key'
        );
    }

    public function testFullDossier(): void
    {
        $api = $this->getApi('{"data":{"id":1}}');

        $scope = new Scope('Scope');

        $dossier = new DossierParameter('DossierParameter', $scope);

        $dossier->setClientStatus(new ClientStatus(ClientStatus::PROSPECT))
            ->setMaritalStatus(new MaritalStatus(MaritalStatus::MARRIED_PRENUPTIAL_AGREEMENT))
            ->setNote('This is a note');

        $address = new AddressParameter('Address', $scope);
        $address->setPostalCode('1000AA')
            ->setHouseNumber('1')
            ->setAddition('a')
            ->setStreet('Damrak')
            ->setCity('Amsterdam');

        $dossier->addCorrespondenceAddress($address);

        $dossier->createHouse('House')
            ->setWoz(250000.00)
            ->addAddress($address);

        $dossier->createPerson('Applicant')
            ->setIsPrimaryContact(true)
            ->setGender(new Gender(Gender::MALE))
            ->setInitials('D.')
            ->setFirstName('Döavid')
            ->setLastName('James')
            ->setDateOfBirth(new DateTime('01-01-1980'))
            ->setEmail('d.james@example.com')
            ->setPrivatePhoneNumber('0201234567')
            ->setMobilePhoneNumber('0612345678')
            ->setIncome(40000)
            ->setIncomeAfterAowDate(10000)
            ->setSmokes(true);

        $dossier->createPerson('Partner')
            ->setIsPrimaryContact(false)
            ->setGender(new Gender(Gender::FEMALE))
            ->setInitials('T.')
            ->setFirstName('Tina')
            ->setLastName('James')
            ->setDateOfBirth(new DateTime('1982-06-02'))
            ->setEmail('t.james@example.com')
            ->setMobilePhoneNumber('0612345687')
            ->setIncome(15000)
            ->setIncomeAfterAowDate(5000)
            ->setSmokes(true);

        $dossier->createExternalDocument('Ext1')
            ->setUrl('www.example.com/picture_david.jpg')
            ->setDescription('A picture of david');

        $dossier->createExternalDocument('Ext2')
            ->setUrl('http://facebook.com/profile/david')
            ->setDescription('Davids facebook');

        $dossier->createLifeInsurance('ORV')
            ->setStartDate(new DateTime('2010-10-20'))
            ->setEndDate(new DateTime('2040-10-20'))
            ->setInsuranceCompanyId(1)
            ->setCoverage(250000.0)
            ->setPremium(25.0)
            ->setPremiumDuration(360)
            ->setCoverageType(new LifeInsuranceCoverageType(LifeInsuranceCoverageType::CONSTANT))
            ->setPaymentPeriod(new PaymentPeriod(PaymentPeriod::MONTH));

        self::assertEqualParameter(
            '{"Scope":{"DossierParameter":{"@type":"Dossier","hasPersons":["Applicant","Partner"],"hasHouses":["House"],"hasExternalDocuments":["Ext1","Ext2"],"hasCorrespondenceAddress":"Address","hasLifeInsurances":["ORV"],"maritalStatus":"MARRIED_PRENUPTIAL_AGREEMENT","clientStatus":"PROSPECT","note":"This is a note","labels":[]},"Address":{"@type":"Address","postalCode":"1000AA","houseNumber":"1","addition":"a","street":"Damrak","city":"Amsterdam"},"House":{"@type":"House","hasAddress":"Address","woz":250000},"Applicant":{"@type":"Person","isPrimaryContact":true,"lastName":"James","firstName":"D\u00f6avid","initials":"D.","email":"d.james@example.com","dateOfBirth":"1980-01-01","gender":"MALE","privatePhoneNumber":"0201234567","mobilePhoneNumber":"0612345678","income":40000,"incomeAfterAowDate":10000,"smokes":true},"Partner":{"@type":"Person","isPrimaryContact":false,"lastName":"James","firstName":"Tina","initials":"T.","email":"t.james@example.com","dateOfBirth":"1982-06-02","gender":"FEMALE","mobilePhoneNumber":"0612345687","income":15000,"incomeAfterAowDate":5000,"smokes":true},"Ext1":{"@type":"ExternalDocument","url":"www.example.com\/picture_david.jpg","description":"A picture of david"},"Ext2":{"@type":"ExternalDocument","url":"http:\/\/facebook.com\/profile\/david","description":"Davids facebook"},"ORV":{"@type":"LifeInsurance","startDate":"2010-10-20","insuranceCompanyId":1,"premium":25,"premiumPeriod":"MONTH","premiumDuration":360,"coverage":250000,"coverageType":"CONSTANT","endDate":"2040-10-20"}}}',
            $scope
        );

        $result = $api->import()->insertDossier($scope);
        self::assertEquals(1, $result);

        $this->assertRequestInContainer(
            Method::POST,
            '/client/v1/import/insert',
            'api_key=key'
        );
    }

    public function testRequestFailsOnInvalidIncome(): void
    {
        $this->expectException(InvalidArgumentException::class);

        $scope = new Scope('Scope');

        $dossier = new DossierParameter('DossierParameter', $scope);
        $dossier->createPerson('ApplicantParameter')
            ->setIsPrimaryContact(true)
            ->setLastName('LastName')
            ->setIncome(-1000);
    }

    public function testRequestWithObligations(): void
    {
        $api = $this->getApi('{"data":{"id":1}}');

        $scope = new Scope('Scope');

        $dossier = new DossierParameter('DossierParameter', $scope);

        $dossier->setClientStatus(new ClientStatus(ClientStatus::PROSPECT))
            ->setMaritalStatus(new MaritalStatus(MaritalStatus::MARRIED_PRENUPTIAL_AGREEMENT))
            ->setNote('This is a note');

        $address = new AddressParameter('Address', $scope);
        $address->setPostalCode('1000AA')
            ->setHouseNumber('1')
            ->setAddition('a')
            ->setStreet('Damrak')
            ->setCity('Amsterdam');

        $dossier->addCorrespondenceAddress($address);

        $dossier->createHouse('House')
            ->setWoz(250000.00)
            ->addAddress($address);

        // Obligations - applicant
        $studentLoanObligation = new ObligationParameter('Obligation1', $scope);
        $studentLoanObligation
            ->setCreditType(new CreditType(CreditType::STUDENT_DEBT))
            ->setCreditAmount(5000);

        $privateLeaseObligation = new ObligationParameter('Obligation2', $scope);
        $privateLeaseObligation
            ->setCreditType(new CreditType(CreditType::FINANCIAL_LEASE))
            ->setCreditAmount(500);

        // Obligations - partner
        $partnerStudentLoanObligation = new ObligationParameter('Obligation3', $scope);
        $partnerStudentLoanObligation
            ->setCreditType(new CreditType(CreditType::STUDENT_DEBT))
            ->setCreditAmount(2000);

        $partnerPrivateLeaseObligation = new ObligationParameter('Obligation4', $scope);
        $partnerPrivateLeaseObligation
            ->setCreditType(new CreditType(CreditType::FINANCIAL_LEASE))
            ->setCreditAmount(650);

        $dossier->createPerson('Applicant')
            ->setIsPrimaryContact(true)
            ->setGender(new Gender(Gender::MALE))
            ->setInitials('D.')
            ->setFirstName('Döavid')
            ->setLastName('James')
            ->setDateOfBirth(new DateTime('01-01-1980'))
            ->setEmail('d.james@example.com')
            ->setPrivatePhoneNumber('0201234567')
            ->setMobilePhoneNumber('0612345678')
            ->setIncome(40000)
            ->setIncomeAfterAowDate(10000)
            ->setSmokes(true)
            ->addObligation($studentLoanObligation)
            ->addObligation($privateLeaseObligation);

        $dossier->createPerson('Partner')
            ->setIsPrimaryContact(false)
            ->setGender(new Gender(Gender::FEMALE))
            ->setInitials('T.')
            ->setFirstName('Tina')
            ->setLastName('James')
            ->setDateOfBirth(new DateTime('1982-06-02'))
            ->setEmail('t.james@example.com')
            ->setMobilePhoneNumber('0612345687')
            ->setIncome(15000)
            ->setIncomeAfterAowDate(5000)
            ->setSmokes(true)
            ->addObligation($partnerStudentLoanObligation)
            ->addObligation($partnerPrivateLeaseObligation);

        $dossier->createExternalDocument('Ext1')
            ->setUrl('www.example.com/picture_david.jpg')
            ->setDescription('A picture of david');

        $dossier->createExternalDocument('Ext2')
            ->setUrl('http://facebook.com/profile/david')
            ->setDescription('Davids facebook');

        $dossier->createLifeInsurance('ORV')
            ->setStartDate(new DateTime('2010-10-20'))
            ->setEndDate(new DateTime('2040-10-20'))
            ->setInsuranceCompanyId(1)
            ->setCoverage(250000.0)
            ->setPremium(25.0)
            ->setPremiumDuration(360)
            ->setCoverageType(new LifeInsuranceCoverageType(LifeInsuranceCoverageType::CONSTANT))
            ->setPaymentPeriod(new PaymentPeriod(PaymentPeriod::MONTH));

        self::assertEqualParameter(
            '{"Scope":{"DossierParameter":{"@type":"Dossier","hasPersons":["Applicant","Partner"],"hasHouses":["House"],"hasExternalDocuments":["Ext1","Ext2"],"hasCorrespondenceAddress":"Address","hasLifeInsurances":["ORV"],"maritalStatus":"MARRIED_PRENUPTIAL_AGREEMENT","clientStatus":"PROSPECT","note":"This is a note","labels":[]},"Address":{"@type":"Address","postalCode":"1000AA","houseNumber":"1","addition":"a","street":"Damrak","city":"Amsterdam"},"House":{"@type":"House","hasAddress":"Address","woz":250000},"Obligation1":{"@type":"Obligation","creditType":"5","creditAmount":5000},"Obligation2":{"@type":"Obligation","creditType":"4","creditAmount":500},"Obligation3":{"@type":"Obligation","creditType":"5","creditAmount":2000},"Obligation4":{"@type":"Obligation","creditType":"4","creditAmount":650},"Applicant":{"@type":"Person","isPrimaryContact":true,"lastName":"James","firstName":"D\u00f6avid","initials":"D.","email":"d.james@example.com","dateOfBirth":"1980-01-01","gender":"MALE","privatePhoneNumber":"0201234567","mobilePhoneNumber":"0612345678","income":40000,"incomeAfterAowDate":10000,"smokes":true,"hasObligations":["Obligation1","Obligation2"]},"Partner":{"@type":"Person","isPrimaryContact":false,"lastName":"James","firstName":"Tina","initials":"T.","email":"t.james@example.com","dateOfBirth":"1982-06-02","gender":"FEMALE","mobilePhoneNumber":"0612345687","income":15000,"incomeAfterAowDate":5000,"smokes":true,"hasObligations":["Obligation3","Obligation4"]},"Ext1":{"@type":"ExternalDocument","url":"www.example.com\/picture_david.jpg","description":"A picture of david"},"Ext2":{"@type":"ExternalDocument","url":"http:\/\/facebook.com\/profile\/david","description":"Davids facebook"},"ORV":{"@type":"LifeInsurance","startDate":"2010-10-20","insuranceCompanyId":1,"premium":25,"premiumPeriod":"MONTH","premiumDuration":360,"coverage":250000,"coverageType":"CONSTANT","endDate":"2040-10-20"}}}',
            $scope
        );

        $result = $api->import()->insertDossier($scope);
        self::assertEquals(1, $result);

        $this->assertRequestInContainer(
            Method::POST,
            '/client/v1/import/insert',
            'api_key=key'
        );
    }
}
