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
use FinBlocks\Model\Mandate\Flow;
use Webmozart\Assert\Assert;

/**
 * @author    David Garcia <me@davidgarcia.cat>
 * @copyright FinBlocks
 *
 * @version 1.0.0
 *
 * @since   1.0.0
 */
class Flows extends AbstractHttpApi
{
    /**
     * Creates a Flow to set-up a new Mandate through the GoCardless system.
     *
     * @param Flow $flow
     *
     * @throws FinBlocksException
     *
     * @return Flow
     */
    public function create(Flow $flow): Flow
    {
        try {
            $httpResponse = $this->httpPost('/flows', $flow->httpCreate());

            return $this->hydrateResponse($httpResponse, Flow::class);
        } catch (\Throwable $throwable) {
            throw new FinBlocksException($throwable->getMessage(), $throwable->getCode(), $throwable);
        }
    }

    /**
     * Retrieves a Flow.
     *
     * @param string $flowId
     *
     * @throws FinBlocksException
     *
     * @return Flow
     */
    public function show(string $flowId): Flow
    {
        try {
            Assert::stringNotEmpty($flowId, '`flowId` argument must be a not empty string');

            $httpResponse = $this->httpGet(sprintf('/flows/%s', $flowId));

            return $this->hydrateResponse($httpResponse, Flow::class);
        } catch (\Throwable $throwable) {
            throw new FinBlocksException($throwable->getMessage(), $throwable->getCode(), $throwable);
        }
    }
}
