<?php

namespace Finblocks\Tests\UnitTests\Model\Pagination;

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
class BankAccountsPaginationTest extends TestCase
{
    public function testCreateEmptyModelBankAccountsPagination()
    {
        $model = Pagination\BankAccountsPagination::create();

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

    public function testCreateEmptyModelBankAccountsPaginationFromPayload()
    {
        $model = Pagination\BankAccountsPagination::createFromPayload('{
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
                    "type": "GB",
                    "accountHolderId": "string",
                    "label": "string",
                    "tag": "string",
                    "active": true,
                    "createdAt": "2019-01-04T10:35:37.252Z",
                    "details": {
                        "sortCode": "string",
                        "accountNumber": "string"
                    }
                },
                {
                    "id": "string",
                    "type": "IBAN",
                    "accountHolderId": "string",
                    "label": "string",
                    "tag": "string",
                    "active": true,
                    "createdAt": "2019-01-04T10:35:37.252Z",
                    "details": {
                        "bic": "string",
                        "iban": "string"
                    }
                },
                {
                    "id": "string",
                    "type": "CA",
                    "accountHolderId": "string",
                    "label": "string",
                    "tag": "string",
                    "active": true,
                    "createdAt": "2019-01-04T10:35:37.252Z",
                    "details": {
                        "branchCode": "string",
                        "institutionNumber": "string",
                        "accountNumber": "string",
                        "bankName": "string"
                    }
                },
                {
                    "id": "string",
                    "type": "US",
                    "accountHolderId": "string",
                    "label": "string",
                    "tag": "string",
                    "active": true,
                    "createdAt": "2019-01-04T10:35:37.252Z",
                    "details": {
                        "accountNumber": "string",
                        "aba": "string"
                    }
                },
                {
                    "id": "string",
                    "type": "OTHER",
                    "accountHolderId": "string",
                    "label": "string",
                    "tag": "string",
                    "active": true,
                    "createdAt": "2019-01-04T10:35:37.252Z",
                    "details": {
                        "country": "string",
                        "bic": "string",
                        "accountNumber": "string"
                    }
                }
            ]
        }');

        $this->assertInstanceOf(Pagination\Links::class, $model->getLinks());

        $this->assertCount(5, $model->getEmbedded());

        $this->assertInstanceOf(Model\BankAccount\BankAccountGb::class, $model->getEmbedded()[0]);
        $this->assertInstanceOf(Model\BankAccount\BankAccountIban::class, $model->getEmbedded()[1]);
        $this->assertInstanceOf(Model\BankAccount\BankAccountCa::class, $model->getEmbedded()[2]);
        $this->assertInstanceOf(Model\BankAccount\BankAccountUs::class, $model->getEmbedded()[3]);
        $this->assertInstanceOf(Model\BankAccount\BankAccountOther::class, $model->getEmbedded()[4]);
    }

    public function testCreateModelBankAccountsPaginationForUnknownTypeFromPayload()
    {
        $this->expectException(FinBlocksException::class);

        Pagination\BankAccountsPagination::createFromPayload('{
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

    public function testCreateModelBankAccountsPaginationForInvalidTypeFromPayload()
    {
        $this->expectException(FinBlocksException::class);

        Pagination\BankAccountsPagination::createFromPayload('{
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

        $model = Pagination\BankAccountsPagination::create();
        $model->httpCreate();
    }

    public function testUpdateArray()
    {
        $this->expectException(FinBlocksException::class);

        $model = Pagination\BankAccountsPagination::create();
        $model->httpUpdate();
    }

    public function testCreateFilledModelFromWrongJsonPayload()
    {
        $this->expectException(FinBlocksException::class);

        Pagination\BankAccountsPagination::createFromPayload('This is not a JSON payload');
    }
}
