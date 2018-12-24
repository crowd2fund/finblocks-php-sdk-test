<?php

namespace FinBlocks\Factory;

use FinBlocks\Model\Refund\Refund;

/**
 * @author    David Garcia <me@davidgarcia.cat>
 * @copyright FinBlocks
 *
 * @version 1.0.0
 * @since   1.0.0
 */
class RefundsFactory
{
    /**
     * Creates a new Refund's Model.
     *
     * @return Refund
     */
    public function create(): Refund
    {
        return new Refund();
    }
}
