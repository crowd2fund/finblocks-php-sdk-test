<?php

/*
 * This file is part of FinBlocks PHP SDK.
 *
 * Copyright (C) 2018 FinBlocks Ltd.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace FinBlocks\Factory;

use FinBlocks\Model\Mandate\Flow;

/**
 * @author    David Garcia <me@davidgarcia.cat>
 * @copyright FinBlocks
 *
 * @version 1.0.0
 *
 * @since   1.0.0
 */
class FlowsFactory
{
    /**
     * Creates a new Model.
     *
     * @return Flow
     */
    public function create(): Flow
    {
        return Flow::create();
    }

    /**
     * Creates a new Model filling their properties with the JSON payload.
     *
     * @param string $jsonData
     *
     * @return Flow
     */
    public function createFromPayload(string $jsonData): Flow
    {
        return Flow::createFromPayload($jsonData);
    }
}
