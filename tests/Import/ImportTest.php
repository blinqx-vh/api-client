<?php
declare(strict_types = 1);

namespace Dnhb\ApiClient\Tests\Import;

use DateTime;
use Dnhb\ApiClient\Data\ClientStatus;
use Dnhb\ApiClient\Data\Gender;
use Dnhb\ApiClient\Data\MaritalStatus;
use Dnhb\ApiClient\Import\Manager\ImportParameterManager;
use Dnhb\ApiClient\Import\Parameter\AddressParameter;
use Dnhb\ApiClient\Import\Parameter\DossierParameter;
use Dnhb\ApiClient\Import\Scope;
use Dnhb\ApiClient\Request\Method;
use Dnhb\ApiClient\Tests\TestCase\ApiClientTestCase;

/**
 * Class ImportTest
 *
 * @package Dnhb\ApiClient\Tests\Import
 */
final class ImportTest extends ApiClientTestCase
{
    /**
     *
     */
    private static function assertEqualParameter(string $expected, Scope $scope)
    {
        $importParameterManager = new ImportParameterManager();
        $importParameterManager->addScope($scope);

        self::assertEquals(
            $expected,
            json_encode($importParameterManager->toJsonableObject())
        );
    }

    /** Most basic request possible */
    public function testRequest()
    {
        $api = $this->getApi('{"data":{"id":1}}');

        $scope = new Scope('Scope');

        $dossier = new DossierParameter('DossierParameter', $scope);
        $dossier->createPerson('ApplicantParameter')
            ->setIsPrimaryContact(true)
            ->setLastName('LastName');

        self::assertEqualParameter(
            '{"Scope":{"DossierParameter":{"@type":"Dossier","hasPersons":["ApplicantParameter"],"clientStatus":"PROSPECT"},"ApplicantParameter":{"@type":"Person","isPrimaryContact":true,"lastName":"LastName"}}}',
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

    /**
     *
     */
    public function testFullDossier()
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
            ->setMobilePhoneNumber('0612345678');

        $dossier->createPerson('Partner')
            ->setIsPrimaryContact(false)
            ->setGender(new Gender(Gender::FEMALE))
            ->setInitials('T.')
            ->setFirstName('Tina')
            ->setLastName('James')
            ->setDateOfBirth(new DateTime('1982-06-02'))
            ->setEmail('t.james@example.com')
            ->setMobilePhoneNumber('0612345687');

        $dossier->createExternalDocument('Ext1')
            ->setUrl('www.example.com/picture_david.jpg')
            ->setDescription('A picture of david');

        $dossier->createExternalDocument('Ext2')
            ->setUrl('http://facebook.com/profile/david')
            ->setDescription('Davids facebook');

        self::assertEqualParameter(
            '{"Scope":{"DossierParameter":{"@type":"Dossier","hasPersons":["Applicant","Partner"],"hasHouses":["House"],"hasExternalDocuments":["Ext1","Ext2"],"hasCorrespondenceAddress":"Address","maritalStatus":"MARRIED_PRENUPTIAL_AGREEMENT","clientStatus":"PROSPECT","note":"This is a note"},"Address":{"@type":"Address","postalCode":"1000AA","houseNumber":"1","addition":"a","street":"Damrak","city":"Amsterdam"},"House":{"@type":"House","hasAddress":"Address","woz":250000},"Applicant":{"@type":"Person","isPrimaryContact":true,"lastName":"James","firstName":"D\u00f6avid","initials":"D.","email":"d.james@example.com","dateOfBirth":"1980-01-01","gender":"MALE","privatePhoneNumber":"0201234567","mobilePhoneNumber":"0612345678"},"Partner":{"@type":"Person","isPrimaryContact":false,"lastName":"James","firstName":"Tina","initials":"T.","email":"t.james@example.com","dateOfBirth":"1982-06-02","gender":"FEMALE","mobilePhoneNumber":"0612345687"},"Ext1":{"@type":"ExternalDocument","url":"www.example.com\/picture_david.jpg","description":"A picture of david"},"Ext2":{"@type":"ExternalDocument","url":"http:\/\/facebook.com\/profile\/david","description":"Davids facebook"}}}',
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