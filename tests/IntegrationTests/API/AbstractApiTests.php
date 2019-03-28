<?php

/*
 * This file is part of FinBlocks PHP SDK.
 *
 * Copyright (C) 2018 FinBlocks Ltd.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace FinBlocks\Tests\IntegrationTests\API;

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
abstract class AbstractApiTests extends TestCase
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
        $key = sprintf('%s/../../Resources/certs/key.pem', __DIR__);
        $cert = sprintf('%s/../../Resources/certs/cert.pem', __DIR__);
        $ca = sprintf('%s/../../Resources/certs/ca-crt.pem', __DIR__);
        $logs = sprintf('%s/../../../var/log/finblocks.log', __DIR__);

        $this->finBlocks = new FinBlocks($key, $cert, $ca, true, 'https://api.test.fb.mph.im', $logs);
    }
}
