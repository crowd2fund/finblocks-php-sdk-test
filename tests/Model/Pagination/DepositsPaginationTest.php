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
class DepositsPaginationTest extends TestCase
{
    public function testCreateEmptyModelDepositsPagination()
    {
        $model = Pagination\DepositsPagination::create();

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

    public function testCreateEmptyModelDocumentsPaginationFromPayload()
    {
        $model = Pagination\DepositsPagination::createFromPayload('{
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
                    "type": "bankWire",
                    "nature": "deposit",
                    "status": "created",
                    "creditedWalletId": "string",
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
                    "debitedFunds": {
                        "currency": "GBP",
                        "amount": 0
                    },
                    "creditedFunds": {
                        "currency": "GBP",
                        "amount": 0
                    },
                    "fees": {
                        "currency": "GBP",
                        "amount": 0
                    },
                    "declaredDebitedFunds": {
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
                    "creditedWalletId": "string",
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
                    "debitedFunds": {
                        "currency": "GBP",
                        "amount": 0
                    },
                    "creditedFunds": {
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
                    "creditedWalletId": "string",
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
                    "debitedFunds": {
                        "currency": "GBP",
                        "amount": 0
                    },
                    "creditedFunds": {
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

        $this->assertCount(3, $model->getEmbedded());

        $this->assertInstanceOf(Model\Deposit\DepositBankWire::class, $model->getEmbedded()[0]);
        $this->assertInstanceOf(Model\Deposit\DepositCard::class, $model->getEmbedded()[1]);
        $this->assertInstanceOf(Model\Deposit\DepositDirectDebit::class, $model->getEmbedded()[2]);
    }

    public function testCreateModelDocumentsPaginationForUnknownTypeFromPayload()
    {
        $this->expectException(FinBlocksException::class);

        Pagination\DepositsPagination::createFromPayload('{
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

    public function testCreateModelDocumentsPaginationForInvalidTypeFromPayload()
    {
        $this->expectException(FinBlocksException::class);

        Pagination\DepositsPagination::createFromPayload('{
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
}
