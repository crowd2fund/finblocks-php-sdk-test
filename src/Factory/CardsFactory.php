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
     * Creates a new Card's Model.
     *
     * @return Card
     */
    public function create(): Card
    {
        return new Card();
    }
}
