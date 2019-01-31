<?php

/*
 * This file is part of FinBlocks PHP SDK.
 *
 * Copyright (C) 2018 FinBlocks Ltd.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace FinBlocks\Tests\UnitTests\Model\Card;

use FinBlocks\Exception\FinBlocksException;
use FinBlocks\Model\Card\Card;
use FinBlocks\Model\Card\OneUseToken;
use PHPUnit\Framework\TestCase;

/**
 * @author    David Garcia <me@davidgarcia.cat>
 * @copyright FinBlocks
 *
 * @version 1.0.0
 *
 * @since   1.0.0
 */
class OneUseTokenTest extends TestCase
{
    public function testCreateModel()
    {
        $this->expectException(FinBlocksException::class);

        OneUseToken::create();
    }

    public function testCreateFilledModelFromJsonPayload()
    {
        $model = OneUseToken::createFromPayload('{
            "oneUseToken": "token-for-tokenised-card-here",
            "cardLastfour": "3436",
            "endDate": "12/20",
            "cardScheme": "Visa",
            "cardFunding": "Debit"
        }');

        $this->assertInstanceOf(OneUseToken::class, $model);
        $this->assertInstanceOf(\DateTime::class, $model->getEndDate());

        $this->assertEquals('token-for-tokenised-card-here', $model->getOneUseToken());
        $this->assertEquals('3436', $model->getCardLastfour());
        $this->assertEquals('12/20', $model->getEndDate()->format('m/y'));
        $this->assertEquals('Visa', $model->getCardScheme());
        $this->assertEquals('Debit', $model->getCardFunding());
    }

    public function testCreateFilledModelFromWrongJsonPayload()
    {
        $this->expectException(FinBlocksException::class);

        OneUseToken::createFromPayload('This is not a JSON payload');
    }

    public function testCreateArray()
    {
        $this->expectException(FinBlocksException::class);

        $model = OneUseToken::createFromPayload('{}');
        $model->httpCreate();
    }

    public function testUpdateArray()
    {
        $this->expectException(FinBlocksException::class);

        $model = OneUseToken::createFromPayload('{}');
        $model->httpUpdate();
    }
}
