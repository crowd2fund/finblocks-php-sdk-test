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
     * Creates a new Model.
     *
     * @return KnowYourCustomer
     */
    public function create(): KnowYourCustomer
    {
        return KnowYourCustomer::create();
    }
    /**
     * Creates a new Model filling their properties with the JSON payload.
     *
     * @param string $jsonData
     *
     * @return KnowYourCustomer
     */
    public function createFromPayload(string $jsonData): KnowYourCustomer
    {
        return KnowYourCustomer::createFromPayload($jsonData);
    }
}
