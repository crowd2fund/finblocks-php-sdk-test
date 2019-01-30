<?php

/*
 * This file is part of FinBlocks PHP SDK.
 *
 * Copyright (C) 2018 FinBlocks Ltd.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Finblocks\Tests\UnitTests\Model\Card;

use FinBlocks\Exception\FinBlocksException;
use FinBlocks\Model\Card\Card;
use PHPUnit\Framework\TestCase;

/**
 * @author    David Garcia <me@davidgarcia.cat>
 * @copyright FinBlocks
 *
 * @version 1.0.0
 *
 * @since   1.0.0
 */
class CardTest extends TestCase
{
    public function testCreateEmptyModelAndSetters()
    {
        $model = Card::create();
        $model->setAccountHolderId('12345678');
        $model->setLabel('label');
        $model->setTag('tag');

        // There's no getter for the card token, please run testCreateArray() test for token checks
        $model->setToken('tokenised card goes here');

        $this->assertEquals('12345678', $model->getAccountHolderId());
        $this->assertEquals('label', $model->getLabel());
        $this->assertEquals('tag', $model->getTag());
    }

    public function testCreateFilledModelFromJsonPayload()
    {
        $model = Card::createFromPayload('{
            "id": "1111",
            "accountHolderId": "2222",
            "issuer": "Visa",
            "lastFour": "7890",
            "funding": "Debit",
            "endDate": "1220",
            "label":"Card\'s Label",
            "tag":"Card\'s Tag",
            "country": "GBR",
            "bank": "Bank Name",
            "active": true,
            "createdAt": "2019-01-02T13:02:18.341Z"
        }');

        $this->assertEquals('1111', $model->getId());
        $this->assertEquals('2222', $model->getAccountHolderId());
        $this->assertEquals(strtoupper('VISA'), strtoupper($model->getIssuer()));
        $this->assertEquals('7890', $model->getLastFour());
        $this->assertEquals('Debit', $model->getFunding());
        $this->assertEquals('Card\'s Label', $model->getLabel());
        $this->assertEquals('Card\'s Tag', $model->getTag());
        $this->assertEquals('GBR', $model->getCountry());
        $this->assertEquals('Bank Name', $model->getBank());
        $this->assertEquals(true, $model->isActive());

        $this->assertInstanceOf(\DateTime::class, $model->getCreatedAt());
        $this->assertInstanceOf(\DateTime::class, $model->getEndDate());

        $this->assertEquals('2019-01-02 13:02:18', $model->getCreatedAt()->format('Y-m-d H:i:s'));
        $this->assertEquals('2020-12-31 23:59:59', $model->getEndDate()->format('Y-m-d H:i:s'));
    }

    public function testCreateFilledModelFromWrongJsonPayload()
    {
        $this->expectException(FinBlocksException::class);

        Card::createFromPayload('This is not a JSON payload');
    }

    public function testCreateArray()
    {
        $model = Card::create();
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

        $model = Card::create();
        $model->httpUpdate();
    }
}
