<?php

namespace FinBlocks\Factory;

use FinBlocks\Model\Hook\Callback;
use FinBlocks\Model\Hook\Hook;

/**
 * @author    David Garcia <me@davidgarcia.cat>
 * @copyright FinBlocks
 *
 * @version 1.0.0
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
     *
     * @return Callback
     */
    public function createCallbackFromPayload(string $jsonData): Callback
    {
        return Callback::createFromPayload($jsonData);
    }
}
