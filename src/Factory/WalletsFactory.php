<?php

namespace FinBlocks\Factory;

use FinBlocks\Model\Wallet\Wallet;

/**
 * @author    David Garcia <me@davidgarcia.cat>
 * @copyright FinBlocks
 *
 * @version 1.0.0
 * @since   1.0.0
 */
class WalletsFactory
{
    /**
     * Creates a new Model.
     *
     * @return Wallet
     */
    public function create(): Wallet
    {
        return Wallet::create();
    }
    /**
     * Creates a new Model filling their properties with the JSON payload.
     *
     * @param string $jsonData
     *
     * @return Wallet
     */
    public function createFromPayload(string $jsonData): Wallet
    {
        return Wallet::createFromPayload($jsonData);
    }
}
