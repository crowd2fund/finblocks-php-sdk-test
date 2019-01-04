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
     *
     * @param string|null $jsonData
     * @param string|null $class
     */
    protected function __construct(string $jsonData = null)
    {
        if (!empty($jsonData)) {
            try {
                $arrayData = json_decode($jsonData, true);

                if (JSON_ERROR_NONE !== json_last_error()) {
                    throw new \InvalidArgumentException(json_last_error_msg(), json_last_error());
                }

                foreach ($arrayData as $property => $content) {
                    switch ($property) {
                        case '_links':
                            $this->$property = Links::createFromPayload(json_encode($content));
                            break;
                        case '_embedded':
                            // This field must be ignored, and handled individually for each type of Pagination.
                            break;
                        default:
                            $this->$property = $content;
                    }
                }
            } catch (\Throwable $throwable) {
                throw new FinBlocksException($throwable->getMessage(), $throwable->getCode(), $throwable);
            }
        } else {
            $this->_links = Links::create();
        }
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
