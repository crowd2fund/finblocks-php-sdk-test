<?php

namespace FinBlocks\Model\Pagination;

/**
 * @author    David Garcia <me@davidgarcia.cat>
 * @copyright FinBlocks
 *
 * @version 1.0.0
 * @since   1.0.0
 */
abstract class AbstractPagination
{
    /**
     * @var int
     */
    private $total = 0;

    /**
     * @var Links
     */
    private $_links;

    /**
     * @var array
     */
    protected $_embedded = [];

    /**
     * AbstractPagination constructor.
     */
    public function __construct()
    {
        $this->_links = new Links();
    }

    /**
     * @return int
     */
    public function getTotal(): int
    {
        return $this->total;
    }

    /**
     * @return Links
     */
    public function getLinks(): Links
    {
        return $this->_links;
    }

    /**
     * @return array
     */
    abstract public function getEmbedded(): array;
}
