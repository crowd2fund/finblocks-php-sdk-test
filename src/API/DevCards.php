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
use FinBlocks\Model\Card\OneUseToken;

/**
 * @author    David Garcia <me@davidgarcia.cat>
 * @copyright FinBlocks
 *
 * @version 1.0.0
 *
 * @since   1.0.0
 */
class DevCards extends AbstractHttpApi
{
    /**
     * Retrieves a One-Use Token card to use it JUST for DEV and TEST purposes.
     * It doesn't work on PROD environments.
     */
    public function oneUseToken(): OneUseToken
    {
        try {
            @trigger_error('This method is just available for DEV and TEST purposes; don\'t use it on PROD server', E_USER_WARNING);

            $httpResponse = $this->httpPost('/oneUseToken', ['cardNumber' => '4976000000003436', 'expiryDate' => '12/20', 'cv2' => 452]);

            return $this->hydrateResponse($httpResponse, OneUseToken::class);
        } catch (\Throwable $throwable) {
            throw new FinBlocksException($throwable->getMessage(), $throwable->getCode(), $throwable);
        }
    }
}
