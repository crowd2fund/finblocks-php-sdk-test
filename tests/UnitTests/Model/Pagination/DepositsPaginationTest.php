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
class DepositsPaginationTest extends TestCase
{
    public function testCreateEmptyModelDepositsPagination()
    {
        $model = Pagination\DepositsPagination::create();

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

    public function testCreateEmptyModelDocumentsPaginationFromPayload()
    {
        $model = Pagination\DepositsPagination::createFromPayload('{
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
                    "type": "bankWire",
                    "nature": "deposit",
                    "status": "created",
                    "to": "string",
                    "createdAt": "2019-01-04T10:24:16.101Z",
                    "executedAt": "2019-01-04T10:24:16.101Z",
                    "billingAddress": {
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
                    "debitedAmount": {
                        "currency": "GBP",
                        "amount": 0
                    },
                    "creditedAmount": {
                        "currency": "GBP",
                        "amount": 0
                    },
                    "fees": {
                        "currency": "GBP",
                        "amount": 0
                    },
                    "declaredDebitedAmount": {
                        "currency": "GBP",
                        "amount": 0
                    },
                    "declaredFees": {
                        "currency": "GBP",
                        "amount": 0
                    },
                    "wireReference": "string"
                },
                {
                    "id": "string",
                    "type": "card",
                    "nature": "deposit",
                    "status": "created",
                    "to": "string",
                    "createdAt": "2019-01-04T10:24:16.101Z",
                    "executedAt": "2019-01-04T10:24:16.101Z",
                    "billingAddress": {
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
                    "debitedAmount": {
                        "currency": "GBP",
                        "amount": 0
                    },
                    "creditedAmount": {
                        "currency": "GBP",
                        "amount": 0
                    },
                    "fees": {
                        "currency": "GBP",
                        "amount": 0
                    },
                    "cardId": "string",
                    "secureMode": false
                },
                {
                    "id": "string",
                    "type": "directDebit",
                    "nature": "deposit",
                    "status": "created",
                    "to": "string",
                    "createdAt": "2019-01-04T10:24:16.101Z",
                    "executedAt": "2019-01-04T10:24:16.101Z",
                    "billingAddress": {
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
                    "debitedAmount": {
                        "currency": "GBP",
                        "amount": 0
                    },
                    "creditedAmount": {
                        "currency": "GBP",
                        "amount": 0
                    },
                    "fees": {
                        "currency": "GBP",
                        "amount": 0
                    },
                    "mandateId": "string"
                }
            ]
        }');

        $this->assertInstanceOf(Pagination\Links::class, $model->getLinks());

        $this->assertCount(3, $model->getItems());

        $this->assertInstanceOf(Model\Deposit\DepositBankWire::class, $model->getItems()[0]);
        $this->assertInstanceOf(Model\Deposit\DepositCard::class, $model->getItems()[1]);
        $this->assertInstanceOf(Model\Deposit\DepositDirectDebit::class, $model->getItems()[2]);
    }

    public function testCreateModelDocumentsPaginationForUnknownTypeFromPayload()
    {
        $this->expectException(FinBlocksException::class);

        Pagination\DepositsPagination::createFromPayload('{
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

    public function testCreateModelDocumentsPaginationForInvalidTypeFromPayload()
    {
        $this->expectException(FinBlocksException::class);

        Pagination\DepositsPagination::createFromPayload('{
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

        $model = Pagination\DepositsPagination::create();
        $model->httpCreate();
    }

    public function testUpdateArray()
    {
        $this->expectException(FinBlocksException::class);

        $model = Pagination\DepositsPagination::create();
        $model->httpUpdate();
    }

    public function testCreateFilledModelFromWrongJsonPayload()
    {
        $this->expectException(FinBlocksException::class);

        Pagination\DepositsPagination::createFromPayload('This is not a JSON payload');
    }
}
