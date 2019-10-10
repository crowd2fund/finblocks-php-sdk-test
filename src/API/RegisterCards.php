<?php

/*
 * This file is part of FinBlocks PHP SDK.
 *
 * Copyright (C) 2018 FinBlocks Ltd.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace FinBlocks\API;

use FinBlocks\Exception\FinBlocksException;
use FinBlocks\Model\Card\Card;
use FinBlocks\Model\Card\RegisterCard;

/**
 * @author    Liviu Dragulin <liviu@crowd2fund.com>
 * @copyright FinBlocks
 *
 * @version 1.0.0
 *
 * @since   1.0.0
 */
class RegisterCards extends AbstractHttpApi
{
    /**
     * Creates a Card.
     *
     * @param RegisterCard $registerCard
     *
     * @throws FinBlocksException
     *
     * @return Card
     */
    public function create(RegisterCard $registerCard): RegisterCard
    {
        try {
            $httpResponse = $this->httpPost('/cards/register', $registerCard->httpCreate());

            return $this->hydrateResponse($httpResponse, RegisterCard::class);
        } catch (\Throwable $throwable) {
            throw new FinBlocksException($throwable->getMessage(), $throwable->getCode(), $throwable);
        }
    }

    /**
     * @return DevCards
     */
    public function devCards(): DevCards
    {
        @trigger_error('This method is just available for DEV and TEST purposes; don\'t use it on PROD server', E_USER_WARNING);

        return new DevCards($this->httpClient);
    }
}
