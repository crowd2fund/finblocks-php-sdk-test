<?php

namespace FinBlocks\Model\Deposit;

use FinBlocks\Model\Money\Money;

/**
 * @author    David Garcia <me@davidgarcia.cat>
 * @copyright FinBlocks
 *
 * @version 1.0.0
 * @since   1.0.0
 */
final class DepositBankWire extends AbstractDeposit
{
    const TYPE = 'bankWire';

    public function __construct()
    {
        parent::__construct();

        $this->declaredDebitedFunds = new Money();
        $this->declaredFees = new Money();
    }

    /**
     * @var Money
     */
    private $declaredDebitedFunds;

    /**
     * @var Money
     */
    private $declaredFees;

    /**
     * @var string
     */
    private $wireReference;

    /**
     * @return Money
     */
    public function getDeclaredDebitedFunds(): Money
    {
        return $this->declaredDebitedFunds;
    }

    /**
     * @return Money
     */
    public function getDeclaredFees(): Money
    {
        return $this->declaredFees;
    }

    /**
     * @return string
     */
    public function getWireReference(): string
    {
        return $this->wireReference;
    }
}
