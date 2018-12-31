<?php

namespace FinBlocks\Factory;

use FinBlocks\Model\Card\Card;

/**
 * @author    David Garcia <me@davidgarcia.cat>
 * @copyright FinBlocks
 *
 * @version 1.0.0
 * @since   1.0.0
 */
class CardsFactory
{
    /**
     * Creates a new Model.
     *
     * @return Card
     */
    public function create(): Card
    {
        return Card::create();
    }
    /**
     * Creates a new Model filling their properties with the JSON payload.
     *
     * @param string $jsonData
     *
     * @return Card
     */
    public function createFromPayload(string $jsonData): Card
    {
        return Card::createFromPayload($jsonData);
    }
}
