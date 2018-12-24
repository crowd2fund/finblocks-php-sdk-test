<?php

namespace FinBlocks\Tests\Client;

use FinBlocks\Client\HttpResponse;
use PHPUnit\Framework\TestCase;

/**
 * @author    David Garcia <me@davidgarcia.cat>
 * @copyright FinBlocks
 *
 * @version 1.0.0
 * @since   1.0.0
 */
class HttpResponseTest extends TestCase
{
    public function testHttpResponse()
    {
        $httpResponse = new HttpResponse(200, '{"property":"value"}');

        $this->assertEquals(200, $httpResponse->getStatusCode());
        $this->assertEquals('{"property":"value"}', $httpResponse->getBody());
    }
}
