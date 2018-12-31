<?php

namespace FinBlocks\Factory;

use FinBlocks\Model\Mandate\Mandate;

/**
 * @author    David Garcia <me@davidgarcia.cat>
 * @copyright FinBlocks
 *
 * @version 1.0.0
 * @since   1.0.0
 */
class MandatesFactory
{
    /**
     * Creates a new Model.
     *
     * @return Mandate
     */
    public function create(): Mandate
    {
        return Mandate::create();
    }
    /**
     * Creates a new Model filling their properties with the JSON payload.
     *
     * @param string $jsonData
     *
     * @return Mandate
     */
    public function createFromPayload(string $jsonData): Mandate
    {
        return Mandate::createFromPayload($jsonData);
    }
}
