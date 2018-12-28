<?php

namespace FinBlocks\Model\Pagination;

use FinBlocks\Model\Mandate\Mandate;

/**
 * @author    David Garcia <me@davidgarcia.cat>
 * @copyright FinBlocks
 *
 * @version 1.0.0
 * @since   1.0.0
 */
class MandatesPagination extends AbstractPagination
{
    /**
     * @return Mandate[]
     */
    public function getEmbedded(): array
    {
        return $this->_embedded;
    }
}
