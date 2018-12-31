<?php

namespace FinBlocks\Model\BankAccount;

use FinBlocks\Model\BankAccount\BankAccountDetails\BankAccountUsDetails;

/**
 * @author    David Garcia <me@davidgarcia.cat>
 * @copyright FinBlocks
 *
 * @version 1.0.0
 * @since   1.0.0
 */
final class BankAccountUs extends AbstractBankAccount
{
    const TYPE = 'US';

    /**
     * BankAccountUs constructor.
     *
     * @param string|null $jsonData
     */
    private function __construct(string $jsonData = null)
    {
        $this->setType(self::TYPE);
        $this->setDetails(BankAccountUsDetails::create());
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
     * @return BankAccountUsDetails
     */
    public function getDetails(): BankAccountUsDetails
    {
        return $this->details;
    }
}
