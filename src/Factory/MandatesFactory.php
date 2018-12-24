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
     * Creates a new Mandate's Model.
     *
     * @return Mandate
     */
    public function create(): Mandate
    {
        return new Mandate();
    }
}
