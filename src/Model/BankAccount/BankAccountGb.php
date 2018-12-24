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

    public function __construct()
    {
        $this->setType(self::TYPE);
        $this->setDetails(new BankAccountGbDetails());
    }

    /**
     * @return BankAccountGbDetails
     */
    public function getDetails(): BankAccountGbDetails
    {
        return $this->details;
    }
}
