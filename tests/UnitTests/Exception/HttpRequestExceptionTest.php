<?php

/*
 * This file is part of FinBlocks PHP SDK.
 *
 * Copyright (C) 2018 FinBlocks Ltd.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace FinBlocks\Tests\UnitTests\Exception;

use FinBlocks\Exception\HttpRequestException;
use PHPUnit\Framework\TestCase;

/**
 * @author    David Garcia <me@davidgarcia.cat>
 * @copyright FinBlocks
 *
 * @version 1.0.0
 *
 * @since   1.0.0
 */
class HttpRequestExceptionTest extends TestCase
{
    public function testHttpRequestException()
    {
        $httpException = new HttpRequestException('message', 123);

        $this->assertInstanceOf(HttpRequestException::class, $httpException);
        $this->assertEquals('message', $httpException->getMessage());
        $this->assertEquals(123, $httpException->getCode());
    }
}
