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

use FinBlocks\Model\Card\RegisterCard;

/**
 * @author    Liviu Dragulin <liviu@crowd2fund.com>
 * @copyright FinBlocks
 *
 * @version 1.0.0
 *
 * @since   1.0.0
 */
class RegisterCardsFactory
{
    /**
     * Creates a new Model.
     *
     * @return RegisterCard
     */
    public function create(): RegisterCard
    {
        return RegisterCard::create();
    }

    /**
     * Creates a new Model filling their properties with the JSON payload.
     *
     * @param string $jsonData
     *
     * @return RegisterCard
     */
    public function createFromPayload(string $jsonData): RegisterCard
    {
        return RegisterCard::createFromPayload($jsonData);
    }
}
