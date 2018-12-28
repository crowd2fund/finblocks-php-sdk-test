<?php

namespace FinBlocks\Model\Pagination;

use FinBlocks\Model\Withdrawal\Withdrawal;

/**
 * @author    David Garcia <me@davidgarcia.cat>
 * @copyright FinBlocks
 *
 * @version 1.0.0
 * @since   1.0.0
 */
class WithdrawalsPagination extends AbstractPagination
{
    /**
     * @return Withdrawal[]
     */
    public function getEmbedded(): array
    {
        return $this->_embedded;
    }
}
