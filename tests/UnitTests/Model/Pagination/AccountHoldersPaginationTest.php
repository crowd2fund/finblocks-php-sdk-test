<?php

/*
 * This file is part of FinBlocks PHP SDK.
 *
 * Copyright (C) 2018 FinBlocks Ltd.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Finblocks\Tests\UnitTests\Model\Pagination;

use FinBlocks\Exception\FinBlocksException;
use FinBlocks\Model;
use FinBlocks\Model\Pagination;
use PHPUnit\Framework\TestCase;

/**
 * @author    David Garcia <me@davidgarcia.cat>
 * @copyright FinBlocks
 *
 * @version 1.0.0
 *
 * @since   1.0.0
 */
class AccountHoldersPaginationTest extends TestCase
{
    public function testCreateEmptyModelAccountHoldersPagination()
    {
        $model = Pagination\AccountHoldersPagination::create();

        $this->assertInstanceOf(Pagination\Links::class, $model->getLinks());

        $this->assertIsString($model->getLinks()->getSelf());
        $this->assertIsString($model->getLinks()->getFirst());
        $this->assertIsString($model->getLinks()->getPrev());
        $this->assertIsString($model->getLinks()->getNext());
        $this->assertIsString($model->getLinks()->getLast());

        $this->assertIsInt($model->getTotal());
        $this->assertIsArray($model->getItems());

        $this->assertEquals(0, $model->getTotal());
        $this->assertEquals([], $model->getItems());
    }

    public function testCreateEmptyModelAccountHoldersPaginationFromPayload()
    {
        $model = Pagination\AccountHoldersPagination::createFromPayload('{
            "total": 0,
            "links": {
                "self": "string",
                "first": "string",
                "prev": "string",
                "next": "string",
                "last": "string"
            },
            "items": [
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

        $this->assertCount(2, $model->getItems());

        $this->assertInstanceOf(Model\AccountHolder\AccountHolderIndividual::class, $model->getItems()[0]);
        $this->assertInstanceOf(Model\AccountHolder\AccountHolderBusiness::class, $model->getItems()[1]);
    }

    public function testCreateModelAccountHoldersPaginationForUnknownTypeFromPayload()
    {
        $this->expectException(FinBlocksException::class);

        Pagination\AccountHoldersPagination::createFromPayload('{
            "total": 0,
            "links": {
                "self": "string",
                "first": "string",
                "prev": "string",
                "next": "string",
                "last": "string"
            },
            "items": [
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
            "links": {
                "self": "string",
                "first": "string",
                "prev": "string",
                "next": "string",
                "last": "string"
            },
            "items": [
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
