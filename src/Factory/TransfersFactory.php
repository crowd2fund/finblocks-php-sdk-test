<?php

namespace FinBlocks\Factory;

use FinBlocks\Model\Transfer\Transfer;

/**
 * @author    David Garcia <me@davidgarcia.cat>
 * @copyright FinBlocks
 *
 * @version 1.0.0
 * @since   1.0.0
 */
class TransfersFactory
{
    /**
     * Creates a new Transfer's Model.
     *
     * @return Transfer
     */
    public function create(): Transfer
    {
        return new Transfer();
    }
}
