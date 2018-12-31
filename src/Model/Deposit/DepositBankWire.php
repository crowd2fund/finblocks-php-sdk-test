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

    /**
     * DepositBankWire constructor.
     *
     * @param string|null $jsonData
     */
    protected function __construct(string $jsonData = null)
    {
        parent::__construct();

        $this->declaredDebitedFunds = Money::create();
        $this->declaredFees = Money::create();
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
