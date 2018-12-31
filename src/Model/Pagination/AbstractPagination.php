<?php

namespace FinBlocks\Model\Pagination;

use FinBlocks\Exception\FinBlocksException;
use FinBlocks\Model\BaseModelInterface;

/**
 * @author    David Garcia <me@davidgarcia.cat>
 * @copyright FinBlocks
 *
 * @version 1.0.0
 * @since   1.0.0
 */
abstract class AbstractPagination implements BaseModelInterface
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
    protected function __construct(string $jsonData = null)
    {
        $this->_links = Links::create();
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

    public function httpCreate(): array
    {
        throw new FinBlocksException('Impossible to create the returned pagination');
    }

    public function httpUpdate(): array
    {
        throw new FinBlocksException('Impossible to update the returned pagination');
    }
}
