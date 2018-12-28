<?php

namespace FinBlocks\Model\Pagination;

use FinBlocks\Model\Document\AbstractDocument;

/**
 * @author    David Garcia <me@davidgarcia.cat>
 * @copyright FinBlocks
 *
 * @version 1.0.0
 * @since   1.0.0
 */
class DocumentsPagination extends AbstractPagination
{
    /**
     * @return AbstractDocument[]
     */
    public function getEmbedded(): array
    {
        return $this->_embedded;
    }
}
