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
class DocumentsPaginationTest extends TestCase
{
    public function testCreateEmptyModelDocumentsPagination()
    {
        $model = Pagination\DocumentsPagination::create();

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
        $model = Pagination\DocumentsPagination::createFromPayload('{
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
                    "label": "string",
                    "tag": "string",
                    "type": "driving_licence",
                    "createdAt": "2019-01-04T10:03:31.635Z"
                },
                {
                    "id": "string",
                    "label": "string",
                    "tag": "string",
                    "type": "national_identity_card",
                    "createdAt": "2019-01-04T10:03:31.635Z"
                },
                {
                    "id": "string",
                    "label": "string",
                    "tag": "string",
                    "type": "passport",
                    "createdAt": "2019-01-04T10:03:31.635Z"
                }
            ]
        }');

        $this->assertInstanceOf(Pagination\Links::class, $model->getLinks());

        $this->assertCount(3, $model->getItems());

        $this->assertInstanceOf(Model\Document\DocumentDrivingLicense::class, $model->getItems()[0]);
        $this->assertInstanceOf(Model\Document\DocumentIdCard::class, $model->getItems()[1]);
        $this->assertInstanceOf(Model\Document\DocumentPassport::class, $model->getItems()[2]);
    }

    public function testCreateModelDocumentsPaginationForUnknownTypeFromPayload()
    {
        $this->expectException(FinBlocksException::class);

        Pagination\DocumentsPagination::createFromPayload('{
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

        Pagination\DocumentsPagination::createFromPayload('{
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

        $model = Pagination\DocumentsPagination::create();
        $model->httpCreate();
    }

    public function testUpdateArray()
    {
        $this->expectException(FinBlocksException::class);

        $model = Pagination\DocumentsPagination::create();
        $model->httpUpdate();
    }

    public function testCreateFilledModelFromWrongJsonPayload()
    {
        $this->expectException(FinBlocksException::class);

        Pagination\DocumentsPagination::createFromPayload('This is not a JSON payload');
    }
}
