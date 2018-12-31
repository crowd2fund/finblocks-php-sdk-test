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
     * Creates a new Model.
     *
     * @return Refund
     */
    public function create(): Refund
    {
        return Refund::create();
    }
    /**
     * Creates a new Model filling their properties with the JSON payload.
     *
     * @param string $jsonData
     *
     * @return Refund
     */
    public function createFromPayload(string $jsonData): Refund
    {
        return Refund::createFromPayload($jsonData);
    }
}
