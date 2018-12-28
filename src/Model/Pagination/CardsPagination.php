<?php

namespace FinBlocks\Model\Pagination;

use FinBlocks\Model\Card\Card;

/**
 * @author    David Garcia <me@davidgarcia.cat>
 * @copyright FinBlocks
 *
 * @version 1.0.0
 * @since   1.0.0
 */
class CardsPagination extends AbstractPagination
{
    /**
     * @return Card[]
     */
    public function getEmbedded(): array
    {
        return $this->_embedded;
    }
}
