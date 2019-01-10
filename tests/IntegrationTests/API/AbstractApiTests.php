<?php

namespace FinBlocks\Tests\IntegrationTests\API;

use FinBlocks\FinBlocks;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;

/**
 * @author    David Garcia <me@davidgarcia.cat>
 * @copyright FinBlocks
 *
 * @version 1.0.0
 * @since   1.0.0
 */
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
