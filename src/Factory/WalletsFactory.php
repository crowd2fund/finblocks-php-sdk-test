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
     * Creates a new Wallet's Model.
     *
     * @return Wallet
     */
    public function create(): Wallet
    {
        return new Wallet();
    }
}
