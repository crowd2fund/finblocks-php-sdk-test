<?php

namespace FinBlocks\Model\Pagination;

use FinBlocks\Model\Refund\Refund;

/**
 * @author    David Garcia <me@davidgarcia.cat>
 * @copyright FinBlocks
 *
 * @version 1.0.0
 * @since   1.0.0
 */
class RefundsPagination extends AbstractPagination
{
    /**
     * @return Refund[]
     */
    public function getEmbedded(): array
    {
        return $this->_embedded;
    }
}
