<?php

namespace FinBlocks\Model\BankAccount;

use FinBlocks\Model\BankAccount\BankAccountDetails\BankAccountCaDetails;

/**
 * @author    David Garcia <me@davidgarcia.cat>
 * @copyright FinBlocks
 *
 * @version 1.0.0
 * @since   1.0.0
 */
final class BankAccountCa extends AbstractBankAccount
{
    const TYPE = 'CA';

    /**
     * BankAccountCa constructor.
     *
     * @param string|null $jsonData
     */
    private function __construct(string $jsonData = null)
    {
        $this->setType(self::TYPE);
        $this->setDetails(BankAccountCaDetails::create());
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
     * @return BankAccountCaDetails
     */
    public function getDetails(): BankAccountCaDetails
    {
        return $this->details;
    }
}
