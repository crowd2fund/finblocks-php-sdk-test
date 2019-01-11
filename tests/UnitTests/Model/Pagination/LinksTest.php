<?php

/*
 * This file is part of FinBlocks PHP SDK.
 *
 * Copyright (C) 2018 FinBlocks Ltd.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace FinBlocks\Tests\UnitTests\Model\Pagination;

use FinBlocks\Exception\FinBlocksException;
use FinBlocks\Model\Pagination\Links;
use PHPUnit\Framework\TestCase;

/**
 * @author    David Garcia <me@davidgarcia.cat>
 * @copyright FinBlocks
 *
 * @version 1.0.0
 *
 * @since   1.0.0
 */
class LinksTest extends TestCase
{
    public function testCreateEmptyModel()
    {
        $model = Links::create();

        $this->assertEquals('', $model->getSelf());
        $this->assertEquals('', $model->getFirst());
        $this->assertEquals('', $model->getPrev());
        $this->assertEquals('', $model->getNext());
        $this->assertEquals('', $model->getLast());
    }

    public function testCreateEmptyModelFromPayload()
    {
        $model = Links::createFromPayload('{
            "self": "https://api.sandbox.finblocks.net/v1/resource/self",
            "first": "https://api.sandbox.finblocks.net/v1/resource/first",
            "prev": "https://api.sandbox.finblocks.net/v1/resource/previous",
            "next": "https://api.sandbox.finblocks.net/v1/resource/next",
            "last": "https://api.sandbox.finblocks.net/v1/resource/last"
        }');

        $this->assertEquals('https://api.sandbox.finblocks.net/v1/resource/self', $model->getSelf());
        $this->assertEquals('https://api.sandbox.finblocks.net/v1/resource/first', $model->getFirst());
        $this->assertEquals('https://api.sandbox.finblocks.net/v1/resource/previous', $model->getPrev());
        $this->assertEquals('https://api.sandbox.finblocks.net/v1/resource/next', $model->getNext());
        $this->assertEquals('https://api.sandbox.finblocks.net/v1/resource/last', $model->getLast());
    }

    public function testCreateModelFromWrongJsonPayload()
    {
        $this->expectException(FinBlocksException::class);

        Links::createFromPayload('This is not a JSON payload');
    }
}
