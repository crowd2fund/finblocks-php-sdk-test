<?php

namespace FinBlocks\Model\Pagination;

use FinBlocks\Model\Deposit\AbstractDeposit;
use FinBlocks\Model\Refund\Refund;
use FinBlocks\Model\Transfer\Transfer;
use FinBlocks\Model\Withdrawal\Withdrawal;

/**
 * @author    David Garcia <me@davidgarcia.cat>
 * @copyright FinBlocks
 *
 * @version 1.0.0
 * @since   1.0.0
 */
final class TransactionsPagination extends AbstractPagination
{
    /**
     * @param string|null $jsonData
     */
    protected function __construct(string $jsonData = null)
    {
        parent::__construct($jsonData);
    }

    /**
     * {@inheritdoc}
     */
    public static function create()
    {
        return new self();
    }

    /**
     * {@inheritdoc}
     */
    public static function createFromPayload(string $jsonData)
    {
        return new self($jsonData);
    }

    /**
     * @return AbstractDeposit[]|Refund[]|Transfer[]|Withdrawal[]
     */
    public function getEmbedded(): array
    {
        return $this->_embedded;
    }
}
