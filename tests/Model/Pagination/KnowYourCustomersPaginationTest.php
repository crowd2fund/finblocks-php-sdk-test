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
class KnowYourCustomersPaginationTest extends TestCase
{
    public function testCreateEmptyModelKnowYourCustomersPagination()
    {
        $model = Pagination\KnowYourCustomersPagination::create();

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

    public function testCreateEmptyModelKnowYourCustomersPaginationFromPayload()
    {
        $model = Pagination\KnowYourCustomersPagination::createFromPayload('{
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

        $this->assertCount(1, $model->getEmbedded());

        $this->assertInstanceOf(Model\KnowYourCustomer\KnowYourCustomer::class, $model->getEmbedded()[0]);
    }
}
