<?php

namespace Finblocks\Tests\UnitTesting\Model\Pagination;

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
class DocumentsPaginationTest extends TestCase
{
    public function testCreateEmptyModelDocumentsPagination()
    {
        $model = Pagination\DocumentsPagination::create();

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
        $model = Pagination\DocumentsPagination::createFromPayload('{
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
                    "accountHolderId": "string",
                    "label": "string",
                    "tag": "string",
                    "type": "idCard",
                    "createdAt": "2019-01-04T10:03:31.635Z"
                },
                {
                    "id": "string",
                    "accountHolderId": "string",
                    "label": "string",
                    "tag": "string",
                    "type": "passport",
                    "createdAt": "2019-01-04T10:03:31.635Z"
                }
            ]
        }');

        $this->assertInstanceOf(Pagination\Links::class, $model->getLinks());

        $this->assertCount(2, $model->getEmbedded());

        $this->assertInstanceOf(Model\Document\DocumentIdCard::class, $model->getEmbedded()[0]);
        $this->assertInstanceOf(Model\Document\DocumentPassport::class, $model->getEmbedded()[1]);
    }

    public function testCreateModelDocumentsPaginationForUnknownTypeFromPayload()
    {
        $this->expectException(FinBlocksException::class);

        Pagination\DocumentsPagination::createFromPayload('{
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

        Pagination\DocumentsPagination::createFromPayload('{
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
