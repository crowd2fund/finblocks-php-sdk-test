<?php

namespace FinBlocks\Model\Pagination;

use FinBlocks\Model\BankAccount\AbstractBankAccount;

/**
 * @author    David Garcia <me@davidgarcia.cat>
 * @copyright FinBlocks
 *
 * @version 1.0.0
 * @since   1.0.0
 */
class BankAccountsPagination extends AbstractPagination
{
    /**
     * @return AbstractBankAccount[]
     */
    public function getEmbedded(): array
    {
        return $this->_embedded;
    }
}
