<?php

namespace FinBlocks\Model\BankAccount;

use FinBlocks\Model\BankAccount\BankAccountDetails\BankAccountGbDetails;

/**
 * @author    David Garcia <me@davidgarcia.cat>
 * @copyright FinBlocks
 *
 * @version 1.0.0
 * @since   1.0.0
 */
final class BankAccountGb extends AbstractBankAccount
{
    const TYPE = 'GB';

    /**
     * BankAccountGb constructor.
     *
     * @param string|null $jsonData
     */
    private function __construct(string $jsonData = null)
    {
        $this->setType(self::TYPE);
        $this->setDetails(BankAccountGbDetails::create());
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
     * @return BankAccountGbDetails
     */
    public function getDetails(): BankAccountGbDetails
    {
        return $this->details;
    }
}
