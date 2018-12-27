<?php

namespace FinBlocks;

use FinBlocks\Client\HttpClient;
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
     * @var HttpClient
     */
    private $httpClient;

    /**
     * FinBlocks constructor.
     *
     * @param string $key     Path to the SSL Certificate Key file
     * @param string $cert    Path to the SSL Certificate file
     * @param string $info    Path to the CA Certificate file
     * @param bool   $sandbox Use SANDBOX environment
     */
    public function __construct(string $key, string $cert, string $info, bool $sandbox = false)
    {
        $this->httpClient = new HttpClient($key, $cert, $info, $sandbox);
    }

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
