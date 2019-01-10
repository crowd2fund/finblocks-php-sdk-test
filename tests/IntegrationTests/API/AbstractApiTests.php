<?php

namespace FinBlocks\Tests\IntegrationTests\API;

use FinBlocks\FinBlocks;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;

class AbstractApiTests extends TestCase
{
    /**
     * @var FinBlocks
     */
    protected $finBlocks;

    /**
     * {@inheritdoc}
     */
    protected function setUp()
    {
        $this->finBlocks = new FinBlocks('', '', '', true);
    }
}
