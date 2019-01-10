<?php

/*
 * This file is part of FinBlocks PHP SDK.
 *
 * Copyright (C) 2018 FinBlocks Ltd.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace FinBlocks\Factory;

use FinBlocks\Model\KnowYourCustomer\KnowYourCustomer;

/**
 * @author    David Garcia <me@davidgarcia.cat>
 * @copyright FinBlocks
 *
 * @version 1.0.0
 *
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
