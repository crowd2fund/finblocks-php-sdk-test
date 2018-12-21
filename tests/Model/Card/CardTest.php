<?php

namespace FinBlocks\Tests\Model\Card;

use FinBlocks\Exception\FinBlocksException;
use FinBlocks\Model\Card\Card;
use PHPUnit\Framework\TestCase;

/**
 * @author    David Garcia <me@davidgarcia.cat>
 * @copyright FinBlocks
 * @version   1.0.0
 */
class CardTest extends TestCase
{
    public function testSettersForCardModel()
    {
        $model = new Card();
        $model->setAccountHolderId('12345678');
        $model->setLabel('label');
        $model->setTag('tag');

        // There's no getter for the card token, please run testCreateArray() test for token checks
        $model->setToken('tokenised card goes here');

        $this->assertEquals('12345678', $model->getAccountHolderId());
        $this->assertEquals('label', $model->getLabel());
        $this->assertEquals('tag', $model->getTag());
    }

    public function testCreateArray()
    {
        $model = new Card();
        $model->setToken('tokenised');

        $array = $model->httpCreate();

        $this->assertArrayHasKey('accountHolderId', $array);
        $this->assertArrayHasKey('token', $array);
        $this->assertArrayHasKey('label', $array);
        $this->assertArrayHasKey('tag', $array);

        $this->assertEquals('tokenised', $array['token']);
    }

    public function testUpdateArray()
    {
        $this->expectException(FinBlocksException::class);

        $model = new Card();
        $model->httpUpdate();
    }
}
