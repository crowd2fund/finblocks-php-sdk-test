<?php

namespace FinBlocks\Tests\Model\Hook;

use FinBlocks\Exception\FinBlocksException;
use FinBlocks\Model\Hook\Callback;
use PHPUnit\Framework\TestCase;

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
