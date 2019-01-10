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
use FinBlocks\Model\Hook\Callback;
use PHPUnit\Framework\TestCase;

/**
 * @author    David Garcia <me@davidgarcia.cat>
 * @copyright FinBlocks
 *
 * @version 1.0.0
 *
 * @since   1.0.0
 */
class CallbackTest extends TestCase
{
    public function testCreateFilledModelFromJsonPayload()
    {
        $model = Callback::createFromPayload('{
            "eventId": "12345",
            "eventName": "depositSucceeded",
            "resourceId": "67890",
            "data": {
                "property": "content"
            }
        }');

        $this->assertEquals('12345', $model->getEventId());
        $this->assertEquals('depositSucceeded', $model->getEventName());
        $this->assertEquals('67890', $model->getResourceId());

        $this->assertInternalType('array', $model->getData());
        $this->assertArrayHasKey('property', $model->getData());
        $this->assertEquals('content', $model->getData()['property']);
    }

    public function testCreateFilledModelWithInvalidProperties()
    {
        $this->expectException(FinBlocksException::class);

        Callback::createFromPayload('{
            "invalidProperty": "invalidContent"
        }');
    }

    public function testCreateFilledModelFromEmptyJsonPayload()
    {
        $this->expectException(FinBlocksException::class);

        Callback::createFromPayload('');
    }

    public function testCreateFilledModelFromWrongJsonPayload()
    {
        $this->expectException(FinBlocksException::class);

        Callback::createFromPayload('This is not a JSON payload');
    }
}
