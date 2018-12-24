<?php

namespace FinBlocks\Tests;

use FinBlocks\Factory\ModelsFactories;
use FinBlocks\FinBlocks;
use PHPUnit\Framework\TestCase;

/**
 * @author    David Garcia <me@davidgarcia.cat>
 * @copyright FinBlocks
 *
 * @version 1.0.0
 * @since   1.0.0
 */
class FinBlocksTest extends TestCase
{
    /**
     * @var FinBlocks
     */
    private $finblocks;

    protected function setUp()
    {
        $this->finblocks = new FinBlocks();
    }

    public function testFactories()
    {
        $this->assertInstanceOf(ModelsFactories::class, $this->finblocks->factories());
    }
}
