<?php

namespace FinBlocks\Model\Pagination;

use FinBlocks\Model\Deposit\AbstractDeposit;
use FinBlocks\Model\Refund\Refund;
use FinBlocks\Model\Transfer\Transfer;
use FinBlocks\Model\Withdrawal\Withdrawal;

/**
 * @author    David Garcia <me@davidgarcia.cat>
 * @copyright FinBlocks
 *
 * @version 1.0.0
 * @since   1.0.0
 */
class TransactionsPagination extends AbstractPagination
{
    /**
     * @return AbstractDeposit[]|Refund[]|Transfer[]|Withdrawal[]
     */
    public function getEmbedded(): array
    {
        return $this->_embedded;
    }
}
