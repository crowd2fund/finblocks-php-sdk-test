<?php

namespace FinBlocks\Factory;

use FinBlocks\Model\KnowYourCustomer\KnowYourCustomer;

/**
 * @author    David Garcia <me@davidgarcia.cat>
 * @copyright FinBlocks
 *
 * @version 1.0.0
 * @since   1.0.0
 */
class KnowYourCustomersFactory
{
    /**
     * Creates a new Mandate's Model.
     *
     * @return KnowYourCustomer
     */
    public function create(): KnowYourCustomer
    {
        return new KnowYourCustomer();
    }
}
