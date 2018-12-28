<?php

namespace FinBlocks\Model\Pagination;

use FinBlocks\Model\Deposit\AbstractDeposit;

/**
 * @author    David Garcia <me@davidgarcia.cat>
 * @copyright FinBlocks
 *
 * @version 1.0.0
 * @since   1.0.0
 */
class DepositsPagination extends AbstractPagination
{
    /**
     * @return AbstractDeposit[]
     */
    public function getEmbedded(): array
    {
        return $this->_embedded;
    }
}
