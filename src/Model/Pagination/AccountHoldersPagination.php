<?php

namespace FinBlocks\Model\Pagination;

use FinBlocks\Model\AccountHolder\AbstractAccountHolder;

/**
 * @author    David Garcia <me@davidgarcia.cat>
 * @copyright FinBlocks
 *
 * @version 1.0.0
 * @since   1.0.0
 */
class AccountHoldersPagination extends AbstractPagination
{
    /**
     * @return AbstractAccountHolder[]
     */
    public function getEmbedded(): array
    {
        return $this->_embedded;
    }
}
