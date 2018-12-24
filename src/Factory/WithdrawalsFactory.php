<?php

namespace FinBlocks\Factory;

use FinBlocks\Model\Withdrawal\Withdrawal;

/**
 * @author    David Garcia <me@davidgarcia.cat>
 * @copyright FinBlocks
 *
 * @version 1.0.0
 * @since   1.0.0
 */
class WithdrawalsFactory
{
    /**
     * Creates a new Withdrawal's Model.
     *
     * @return Withdrawal
     */
    public function create(): Withdrawal
    {
        return new Withdrawal();
    }
}
