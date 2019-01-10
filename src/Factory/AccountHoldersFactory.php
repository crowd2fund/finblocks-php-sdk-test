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

use FinBlocks\Model\AccountHolder\AccountHolderBusiness;
use FinBlocks\Model\AccountHolder\AccountHolderIndividual;

/**
 * @author    David Garcia <me@davidgarcia.cat>
 * @copyright FinBlocks
 *
 * @version 1.0.0
 *
 * @since   1.0.0
 */
class AccountHoldersFactory
{
    /**
     * Creates a new Model.
     *
     * @return AccountHolderIndividual
     */
    public function createIndividual(): AccountHolderIndividual
    {
        return AccountHolderIndividual::create();
    }

    /**
     * Creates a new Model filling their properties with the JSON payload.
     *
     * @param string $jsonData
     *
     * @return AccountHolderIndividual
     */
    public function createIndividualFromPayload(string $jsonData): AccountHolderIndividual
    {
        return AccountHolderIndividual::createFromPayload($jsonData);
    }

    /**
     * Creates a new Model.
     *
     * @return AccountHolderBusiness
     */
    public function createBusiness(): AccountHolderBusiness
    {
        return AccountHolderBusiness::create();
    }

    /**
     * Creates a new Model filling their properties with the JSON payload.
     *
     * @param string $jsonData
     *
     * @return AccountHolderBusiness
     */
    public function createBusinessFromPayload(string $jsonData): AccountHolderBusiness
    {
        return AccountHolderBusiness::createFromPayload($jsonData);
    }
}
