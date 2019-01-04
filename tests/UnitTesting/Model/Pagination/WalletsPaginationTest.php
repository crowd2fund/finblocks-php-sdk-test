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
        $this->assertInternalType('array', $model->getEmbedded());

        $this->assertEquals(0, $model->getTotal());
        $this->assertEquals([], $model->getEmbedded());
    }

    public function testCreateModelWalletsPaginationFromPayload()
    {
        $model = Pagination\WalletsPagination::createFromPayload('{
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

        $this->assertCount(1, $model->getEmbedded());

        $this->assertInstanceOf(Model\Wallet\Wallet::class, $model->getEmbedded()[0]);
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
