<?php

namespace FinBlocks\Model\Pagination;

use FinBlocks\Model\Wallet\Wallet;

/**
 * @author    David Garcia <me@davidgarcia.cat>
 * @copyright FinBlocks
 *
 * @version 1.0.0
 * @since   1.0.0
 */
class WalletsPagination extends AbstractPagination
{
    /**
     * @return Wallet[]
     */
    public function getEmbedded(): array
    {
        return $this->_embedded;
    }
}
