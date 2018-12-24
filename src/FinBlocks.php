<?php

namespace FinBlocks;

use FinBlocks\Factory\ModelsFactories;

/**
 * @author    David Garcia <me@davidgarcia.cat>
 * @copyright FinBlocks
 *
 * @version 1.0.0
 * @since   1.0.0
 */
class FinBlocks
{
    /**
     * Models Factories.
     *
     * @return ModelsFactories
     */
    public function factories(): ModelsFactories
    {
        return new ModelsFactories();
    }
}
