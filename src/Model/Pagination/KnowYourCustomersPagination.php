<?php

namespace FinBlocks\Model\Pagination;

use FinBlocks\Model\KnowYourCustomer\KnowYourCustomer;

/**
 * @author    David Garcia <me@davidgarcia.cat>
 * @copyright FinBlocks
 *
 * @version 1.0.0
 * @since   1.0.0
 */
class KnowYourCustomersPagination extends AbstractPagination
{
    /**
     * @return KnowYourCustomer[]
     */
    public function getEmbedded(): array
    {
        return $this->_embedded;
    }
}
