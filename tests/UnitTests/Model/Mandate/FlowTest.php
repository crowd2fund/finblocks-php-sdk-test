<?php

/*
 * This file is part of FinBlocks PHP SDK.
 *
 * Copyright (C) 2018 FinBlocks Ltd.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace FinBlocks\Tests\UnitTests\Model\Mandate;

use FinBlocks\Exception\FinBlocksException;
use FinBlocks\Model\Mandate\Flow;
use PHPUnit\Framework\TestCase;

/**
 * @author    David Garcia <me@davidgarcia.cat>
 * @copyright FinBlocks
 *
 * @version 1.0.0
 *
 * @since   1.0.0
 */
class FlowTest extends TestCase
{
    public function testCreateEmptyModelAndSetters()
    {
        $model = Flow::create();
        $model->setAccountHolderId('12345678');
        $model->setLabel('label');
        $model->setTag('tag');
        // There's no getter for the return URL, please run testCreateArray() test for token checks
        $model->setReturnUrl('https://www.domain.com/return-url');

        $this->assertEquals('12345678', $model->getAccountHolderId());
        $this->assertEquals('label', $model->getLabel());
        $this->assertEquals('tag', $model->getTag());
    }

    public function testCreateFilledModelFromJsonPayload()
    {
        $model = Flow::createFromPayload('{
            "id": "1111",
            "status": "created",
            "accountHolderId": "2222",
            "mandateId": "3333",
            "label": "Flow\'s Label",
            "tag": "Flow\'s Tag",
            "userUrl": "User\'s URL",
            "createdAt": "2019-01-02T12:04:07.278Z"
        }');

        $this->assertEquals('1111', $model->getId());
        $this->assertEquals('created', $model->getStatus());
        $this->assertEquals('2222', $model->getAccountHolderId());
        $this->assertEquals('3333', $model->getMandateId());
        $this->assertEquals('Flow\'s Label', $model->getLabel());
        $this->assertEquals('Flow\'s Tag', $model->getTag());
        $this->assertEquals('User\'s URL', $model->getUserUrl());

        $this->assertInstanceOf(\DateTime::class, $model->getCreatedAt());

        $this->assertEquals('2019-01-02 12:04:07', $model->getCreatedAt()->format('Y-m-d H:i:s'));
    }

    public function testCreateFilledModelFromWrongJsonPayload()
    {
        $this->expectException(FinBlocksException::class);

        Flow::createFromPayload('This is not a JSON payload');
    }

    public function testCreateArray()
    {
        $model = Flow::create();

        $array = $model->httpCreate();

        $this->assertCount(4, $array);

        $this->assertArrayHasKey('accountHolderId', $array);
        $this->assertArrayHasKey('returnUrl', $array);
        $this->assertArrayHasKey('label', $array);
        $this->assertArrayHasKey('tag', $array);
    }

    public function testUpdateArray()
    {
        $this->expectException(FinBlocksException::class);

        $model = Flow::create();
        $model->httpUpdate();
    }
}
