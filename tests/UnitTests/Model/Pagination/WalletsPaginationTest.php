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
class WalletsPaginationTest extends TestCase
{
    public function testCreateEmptyModelWalletsPagination()
    {
        $model = Pagination\WalletsPagination::create();

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

    public function testCreateModelWalletsPaginationFromPayload()
    {
        $model = Pagination\WalletsPagination::createFromPayload('{
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
                    "accountHolderId": "string",
                    "currency": "GBP",
                    "label": "string",
                    "tag": "string",
                    "balance": {
                        "currency": "GBP",
                        "amount": 0
                    },
                    "createdAt": "2019-01-03T16:51:16.471Z"
                }
            ]
        }');

        $this->assertInstanceOf(Pagination\Links::class, $model->getLinks());

        $this->assertCount(1, $model->getItems());

        $this->assertInstanceOf(Model\Wallet\Wallet::class, $model->getItems()[0]);
    }

    public function testCreateArray()
    {
        $this->expectException(FinBlocksException::class);

        $model = Pagination\WalletsPagination::create();
        $model->httpCreate();
    }

    public function testUpdateArray()
    {
        $this->expectException(FinBlocksException::class);

        $model = Pagination\WalletsPagination::create();
        $model->httpUpdate();
    }

    public function testCreateFilledModelFromWrongJsonPayload()
    {
        $this->expectException(FinBlocksException::class);

        Pagination\WalletsPagination::createFromPayload('This is not a JSON payload');
    }
}
