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
        $this->assertInternalType('array', $model->getItems());

        $this->assertEquals(0, $model->getTotal());
        $this->assertEquals([], $model->getItems());
    }

    public function testCreateEmptyModelBankAccountsPaginationFromPayload()
    {
        $model = Pagination\BankAccountsPagination::createFromPayload('{
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
                    "type": "gb",
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
                    "type": "iban",
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
                    "type": "ca",
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
                    "type": "us",
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
                    "type": "other",
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

        $this->assertCount(5, $model->getItems());

        $this->assertInstanceOf(Model\BankAccount\BankAccountGb::class, $model->getItems()[0]);
        $this->assertInstanceOf(Model\BankAccount\BankAccountIban::class, $model->getItems()[1]);
        $this->assertInstanceOf(Model\BankAccount\BankAccountCa::class, $model->getItems()[2]);
        $this->assertInstanceOf(Model\BankAccount\BankAccountUs::class, $model->getItems()[3]);
        $this->assertInstanceOf(Model\BankAccount\BankAccountOther::class, $model->getItems()[4]);
    }

    public function testCreateModelBankAccountsPaginationForUnknownTypeFromPayload()
    {
        $this->expectException(FinBlocksException::class);

        Pagination\BankAccountsPagination::createFromPayload('{
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

    public function testCreateModelBankAccountsPaginationForInvalidTypeFromPayload()
    {
        $this->expectException(FinBlocksException::class);

        Pagination\BankAccountsPagination::createFromPayload('{
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
