<?php

namespace FinBlocks\API;

/**
 * @author    David Garcia <me@davidgarcia.cat>
 * @copyright FinBlocks
 *
 * @version 1.0.0
 * @since   1.0.0
 */
class ApiEndpoints extends AbstractHttpApi
{
    /**
     * API Endpoints for Account Holders management.
     *
     * @return AccountHolders
     */
    public function accountHolders(): AccountHolders
    {
        return new AccountHolders($this->httpClient);
    }

    /**
     * API Endpoints for Wallets management.
     *
     * @return Wallets
     */
    public function wallets(): Wallets
    {
        return new Wallets($this->httpClient);
    }
}
