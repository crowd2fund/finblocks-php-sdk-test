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

use FinBlocks\Model\Hook\Callback as FinBlocksCallback;
use FinBlocks\Model\Hook\Hook;

/**
 * @author    David Garcia <me@davidgarcia.cat>
 * @copyright FinBlocks
 *
 * @version 1.0.0
 *
 * @since   1.0.0
 */
class HooksFactory
{
    /**
     * Creates a new Hook's Model.
     *
     * @return Hook
     */
    public function create(): Hook
    {
        return Hook::create();
    }

    /**
     * Creates a new Hook's Model filling their properties with the JSON payload.
     *
     * @param string $jsonData
     *
     * @return Hook
     */
    public function createFromPayload(string $jsonData): Hook
    {
        return Hook::createFromPayload($jsonData);
    }

    /**
     * Creates a new Callback's Model filling their properties with the JSON payload.
     *
     * @param string $jsonData
     * @param string $secret
     * @param string $signature
     *
     * @return FinBlocksCallback
     */
    public function createCallbackFromPayload(string $jsonData, string $secret, string $signature): FinBlocksCallback
    {
        return FinBlocksCallback::createFromPayload($jsonData, $secret, $signature);
    }
}
