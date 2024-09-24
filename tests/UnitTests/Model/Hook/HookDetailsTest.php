<?php

/*
 * This file is part of FinBlocks PHP SDK.
 *
 * Copyright (C) 2018 FinBlocks Ltd.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Finblocks\Tests\UnitTests\Model\Hook;

use FinBlocks\Exception\FinBlocksException;
use FinBlocks\Model\Hook\HookDetails;
use PHPUnit\Framework\TestCase;

/**
 * @author    David Garcia <me@davidgarcia.cat>
 * @copyright FinBlocks
 *
 * @version 1.0.0
 *
 * @since   1.0.0
 */
class HookDetailsTest extends TestCase
{
    public function testCreateEmptyModelAndSetters()
    {
        $model = HookDetails::create();

        $model->setUrl('url');
        $model->setActive(true);

        $this->assertIsString($model->getUrl());
        $this->assertIsBool($model->isActive());

        $this->assertEquals('url', $model->getUrl());
        $this->assertEquals(true, $model->isActive());

        $model->setUrl('new url');
        $model->setActive(false);

        $this->assertIsString($model->getUrl());
        $this->assertIsBool($model->isActive());

        $this->assertEquals('new url', $model->getUrl());
        $this->assertEquals(false, $model->isActive());
    }

    public function testCreateFilledModelFromJsonPayload()
    {
        $model = HookDetails::createFromPayload('{
            "url": "https://domain.com/callbacks",
            "active": true
        }');

        $this->assertEquals('https://domain.com/callbacks', $model->getUrl());
        $this->assertEquals(true, $model->isActive());
    }

    public function testCreateFilledModelFromWrongJsonPayload()
    {
        $this->expectException(FinBlocksException::class);

        HookDetails::createFromPayload('This is not a JSON payload');
    }

    public function testCreateArray()
    {
        $this->expectException(FinBlocksException::class);

        $model = HookDetails::create();
        $model->httpCreate();
    }

    public function testUpdateArray()
    {
        $model = HookDetails::create();

        $array = $model->httpUpdate();

        $this->assertCount(2, $array);
        $this->assertArrayHasKey('url', $array);
        $this->assertArrayHasKey('active', $array);
    }
}
