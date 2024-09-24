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
class StatementsPaginationTest extends TestCase
{
    public function testCreateEmptyModelStatementsPagination()
    {
        $model = Pagination\StatementsPagination::create();

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

    public function testCreateEmptyModelStatementsPaginationFromPayload()
    {
        $model = Pagination\StatementsPagination::createFromPayload('{
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
                    "createdAt": "2019-01-03T17:15:57.518Z",
                    "executedAt": "2019-01-03T17:15:57.518Z",
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
                    "createdAt": "2019-01-03T17:15:57.518Z",
                    "executedAt": "2019-01-03T17:15:57.518Z",
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
                    "createdAt": "2019-01-03T17:15:57.518Z",
                    "executedAt": "2019-01-03T17:15:57.518Z",
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
                },
                {
                    "id": "string",
                    "status": "string",
                    "nature": "refund",
                    "label": "string",
                    "tag": "string",
                    "from": "string",
                    "to": "string",
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
                    "createdAt": "2019-01-03T17:15:57.518Z",
                    "executedAt": "2019-01-03T17:15:57.518Z"
                },
                {
                    "id": "string",
                    "status": "string",
                    "nature": "transfer",
                    "label": "string",
                    "tag": "string",
                    "from": "string",
                    "to": "string",
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
                    "createdAt": "2019-01-03T17:15:57.518Z",
                    "executedAt": "2019-01-03T17:15:57.518Z"
                },
                {
                    "id": "string",
                    "label": "string",
                    "tag": "string",
                    "status": "created",
                    "nature": "withdrawal",
                    "walletId": "string",
                    "bankAccountId": "string",
                    "bankWireReference": "string",
                    "debitedAmount": {
                        "currency": "GBP",
                        "amount": 0
                    },
                    "fees": {
                        "currency": "GBP",
                        "amount": 0
                    },
                    "createdAt": "2019-01-03T17:15:57.518Z",
                    "executedAt": "2019-01-03T17:15:57.518Z"
                }
            ]
        }');

        $this->assertInstanceOf(Pagination\Links::class, $model->getLinks());

        $this->assertCount(6, $model->getItems());

        $this->assertInstanceOf(Model\Deposit\DepositBankWire::class, $model->getItems()[0]);
        $this->assertInstanceOf(Model\Deposit\DepositCard::class, $model->getItems()[1]);
        $this->assertInstanceOf(Model\Deposit\DepositDirectDebit::class, $model->getItems()[2]);
        $this->assertInstanceOf(Model\Refund\Refund::class, $model->getItems()[3]);
        $this->assertInstanceOf(Model\Transfer\Transfer::class, $model->getItems()[4]);
        $this->assertInstanceOf(Model\Withdrawal\Withdrawal::class, $model->getItems()[5]);
    }

    public function testCreateModelStatementsPaginationForUnknownNatureFromPayload()
    {
        $this->expectException(FinBlocksException::class);

        Pagination\StatementsPagination::createFromPayload('{
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

    public function testCreateModelStatementsPaginationForInvalidNatureFromPayload()
    {
        $this->expectException(FinBlocksException::class);

        Pagination\StatementsPagination::createFromPayload('{
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
                    "nature": "unknown"
                }
            ]
        }');
    }

    public function testCreateModelStatementsPaginationForUnknownDepositTypeFromPayload()
    {
        $this->expectException(FinBlocksException::class);

        Pagination\StatementsPagination::createFromPayload('{
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
                    "nature": "deposit"
                }
            ]
        }');
    }

    public function testCreateModelStatementsPaginationForInvalidDepositFromPayload()
    {
        $this->expectException(FinBlocksException::class);

        Pagination\StatementsPagination::createFromPayload('{
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
                    "type": "unknown",
                    "nature": "deposit"
                }
            ]
        }');
    }

    public function testCreateArray()
    {
        $this->expectException(FinBlocksException::class);

        $model = Pagination\StatementsPagination::create();
        $model->httpCreate();
    }

    public function testUpdateArray()
    {
        $this->expectException(FinBlocksException::class);

        $model = Pagination\StatementsPagination::create();
        $model->httpUpdate();
    }

    public function testCreateFilledModelFromWrongJsonPayload()
    {
        $this->expectException(FinBlocksException::class);

        Pagination\StatementsPagination::createFromPayload('This is not a JSON payload');
    }
}
