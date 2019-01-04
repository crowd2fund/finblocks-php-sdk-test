<?php

namespace FinBlocks\Tests\Model\Pagination;

use FinBlocks\Exception\FinBlocksException;
use FinBlocks\Model\Pagination;
use FinBlocks\Model;
use PHPUnit\Framework\TestCase;

/**
 * @author    David Garcia <me@davidgarcia.cat>
 * @copyright FinBlocks
 *
 * @version 1.0.0
 * @since   1.0.0
 */
class AccountHoldersPaginationTest extends TestCase
{
    public function testCreateEmptyModelAccountHoldersPagination()
    {
        $model = Pagination\AccountHoldersPagination::create();

        $this->assertInstanceOf(Pagination\Links::class, $model->getLinks());

        $this->assertInternalType('string', $model->getLinks()->getSelf());
        $this->assertInternalType('string', $model->getLinks()->getFirst());
        $this->assertInternalType('string', $model->getLinks()->getPrev());
        $this->assertInternalType('string', $model->getLinks()->getNext());
        $this->assertInternalType('string', $model->getLinks()->getLast());

        $this->assertInternalType('integer', $model->getTotal());
        $this->assertInternalType('array', $model->getEmbedded());

        $this->assertEquals(0, $model->getTotal());
        $this->assertEquals([], $model->getEmbedded());
    }

    public function testCreateEmptyModelAccountHoldersPaginationFromPayload()
    {
        $model = Pagination\AccountHoldersPagination::createFromPayload('{
            "total": 0,
            "_links": {
                "self": "string",
                "first": "string",
                "prev": "string",
                "next": "string",
                "last": "string"
            },
            "_embedded": [
                {
                    "id": "string",
                    "type": "individual",
                    "email": "string",
                    "label": "string",
                    "tag": "string",
                    "givenName": "string",
                    "middleName": "string",
                    "familyName": "string",
                    "dateOfBirth": "2019-01-04T12:10:07.926Z",
                    "nationality": "string",
                    "occupation": "string",
                    "incomeRange": 1,
                    "kyc": "restricted",
                    "address": {
                        "flatNumber": "string",
                        "buildingNumber": "string",
                        "buildingName": "string",
                        "street": "string",
                        "subStreet": "string",
                        "town": "string",
                        "state": "string",
                        "postcode": "string",
                        "country": "string"
                    }
                },
                {
                    "id": "string",
                    "type": "business",
                    "email": "string",
                    "label": "string",
                    "tag": "string",
                    "givenName": "string",
                    "middleName": "string",
                    "familyName": "string",
                    "dateOfBirth": "2019-01-04T12:10:07.926Z",
                    "nationality": "string",
                    "occupation": "string",
                    "incomeRange": 1,
                    "kyc": "restricted",
                    "address": {
                        "flatNumber": "string",
                        "buildingNumber": "string",
                        "buildingName": "string",
                        "street": "string",
                        "subStreet": "string",
                        "town": "string",
                        "state": "string",
                        "postcode": "string",
                        "country": "string"
                    },
                    "company": {
                        "number": "string",
                        "name": "string",
                        "email": "string",
                        "type": "business",
                        "address": {
                            "flatNumber": "string",
                            "buildingNumber": "string",
                            "buildingName": "string",
                            "street": "string",
                            "subStreet": "string",
                            "town": "string",
                            "state": "string",
                            "postcode": "string",
                            "country": "string"
                        }
                    }
                }
            ]
        }');

        $this->assertInstanceOf(Pagination\Links::class, $model->getLinks());

        $this->assertCount(2, $model->getEmbedded());

        $this->assertInstanceOf(Model\AccountHolder\AccountHolderIndividual::class, $model->getEmbedded()[0]);
        $this->assertInstanceOf(Model\AccountHolder\AccountHolderBusiness::class, $model->getEmbedded()[1]);
    }

    public function testCreateModelAccountHoldersPaginationForUnknownTypeFromPayload()
    {
        $this->expectException(FinBlocksException::class);

        Pagination\AccountHoldersPagination::createFromPayload('{
            "total": 0,
            "_links": {
                "self": "string",
                "first": "string",
                "prev": "string",
                "next": "string",
                "last": "string"
            },
            "_embedded": [
                {
                    "id": "string"
                }
            ]
        }');
    }

    public function testCreateModelAccountHoldersPaginationForInvalidTypeFromPayload()
    {
        $this->expectException(FinBlocksException::class);

        Pagination\AccountHoldersPagination::createFromPayload('{
            "total": 0,
            "_links": {
                "self": "string",
                "first": "string",
                "prev": "string",
                "next": "string",
                "last": "string"
            },
            "_embedded": [
                {
                    "id": "string",
                    "type": "unknown"
                }
            ]
        }');
    }

    public function testCreateArray()
    {
        $this->expectException(FinBlocksException::class);

        $model = Pagination\AccountHoldersPagination::create();
        $model->httpCreate();
    }

    public function testUpdateArray()
    {
        $this->expectException(FinBlocksException::class);

        $model = Pagination\AccountHoldersPagination::create();
        $model->httpUpdate();
    }

    public function testCreateFilledModelFromWrongJsonPayload()
    {
        $this->expectException(FinBlocksException::class);

        Pagination\AccountHoldersPagination::createFromPayload('This is not a JSON payload');
    }
}
