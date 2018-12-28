<?php

namespace FinBlocks\Model\Pagination;

use FinBlocks\Model\Transfer\Transfer;

/**
 * @author    David Garcia <me@davidgarcia.cat>
 * @copyright FinBlocks
 *
 * @version 1.0.0
 * @since   1.0.0
 */
class TransfersPagination extends AbstractPagination
{
    /**
     * @return Transfer[]
     */
    public function getEmbedded(): array
    {
        return $this->_embedded;
    }
}
