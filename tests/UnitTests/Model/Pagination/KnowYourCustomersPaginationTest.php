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
class KnowYourCustomersPaginationTest extends TestCase
{
    public function testCreateEmptyModelKnowYourCustomersPagination()
    {
        $model = Pagination\KnowYourCustomersPagination::create();

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

    public function testCreateEmptyModelKnowYourCustomersPaginationFromPayload()
    {
        $model = Pagination\KnowYourCustomersPagination::createFromPayload('{
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
                    "documentId": "string",
                    "status": "pending",
                    "refusedReason": "string",
                    "label": "string",
                    "tag": "string",
                    "createdAt": "2019-01-03T17:00:59.549Z",
                    "processedAt": "2019-01-03T17:00:59.549Z"
                }
            ]
        }');

        $this->assertInstanceOf(Pagination\Links::class, $model->getLinks());

        $this->assertCount(1, $model->getItems());

        $this->assertInstanceOf(Model\KnowYourCustomer\KnowYourCustomer::class, $model->getItems()[0]);
    }

    public function testCreateArray()
    {
        $this->expectException(FinBlocksException::class);

        $model = Pagination\KnowYourCustomersPagination::create();
        $model->httpCreate();
    }

    public function testUpdateArray()
    {
        $this->expectException(FinBlocksException::class);

        $model = Pagination\KnowYourCustomersPagination::create();
        $model->httpUpdate();
    }

    public function testCreateFilledModelFromWrongJsonPayload()
    {
        $this->expectException(FinBlocksException::class);

        Pagination\KnowYourCustomersPagination::createFromPayload('This is not a JSON payload');
    }
}
