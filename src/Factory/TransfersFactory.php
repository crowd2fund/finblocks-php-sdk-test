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
     * Creates a new Model.
     *
     * @return Transfer
     */
    public function create(): Transfer
    {
        return Transfer::create();
    }
    /**
     * Creates a new Model filling their properties with the JSON payload.
     *
     * @param string $jsonData
     *
     * @return Transfer
     */
    public function createFromPayload(string $jsonData): Transfer
    {
        return Transfer::createFromPayload($jsonData);
    }
}
