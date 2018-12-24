<?php

namespace FinBlocks\Model\BankAccount;

use FinBlocks\Model\BankAccount\BankAccountDetails\BankAccountIbanDetails;

/**
 * @author    David Garcia <me@davidgarcia.cat>
 * @copyright FinBlocks
 *
 * @version 1.0.0
 * @since   1.0.0
 */
final class BankAccountIban extends AbstractBankAccount
{
    const TYPE = 'IBAN';

    public function __construct()
    {
        $this->setType(self::TYPE);
        $this->setDetails(new BankAccountIbanDetails());
    }

    /**
     * @return BankAccountIbanDetails
     */
    public function getDetails(): BankAccountIbanDetails
    {
        return $this->details;
    }
}
