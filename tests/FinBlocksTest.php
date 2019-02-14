<?php

/*
 * This file is part of FinBlocks PHP SDK.
 *
 * Copyright (C) 2018 FinBlocks Ltd.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace FinBlocks\Tests;

use FinBlocks\API\ApiEndpoints;
use FinBlocks\Factory\ModelsFactories;
use FinBlocks\FinBlocks;
use PHPUnit\Framework\TestCase;

/**
 * @author    David Garcia <me@davidgarcia.cat>
 * @copyright FinBlocks
 *
 * @version 1.0.0
 *
 * @since   1.0.0
 */
class FinBlocksTest extends TestCase
{
    /**
     * @var FinBlocks
     */
    private $finBlocks;

    /**
     * {@inheritdoc}
     */
    protected function setUp()
    {
        $this->finBlocks = new FinBlocks('', '', '', true);
    }

    public function testApiEndpoints()
    {
        $this->assertInstanceOf(ApiEndpoints::class, $this->finBlocks->api());
    }

    public function testFactories()
    {
        $this->assertInstanceOf(ModelsFactories::class, $this->finBlocks->factories());
    }
}
