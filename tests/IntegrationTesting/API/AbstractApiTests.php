<?php

namespace FinBlocks\Tests\IntegrationTesting\API;

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
     * @var FinBlocks|MockObject
     */
    protected $finBlocksMock;

    /**
     * {@inheritdoc}
     */
    protected function setUp()
    {
        $this->finBlocks = new FinBlocks('', '', '', true);

        $finBlocksMock = $this->getMockBuilder(FinBlocks::class);
        $finBlocksMock->setConstructorArgs(['key', 'cert', 'ca', true]);
        $finBlocksMock->setMethods(['api', 'factories']);

        $this->finBlocksMock = $finBlocksMock->getMock();
    }
}
