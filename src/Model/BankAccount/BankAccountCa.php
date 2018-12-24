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

    public function __construct()
    {
        $this->setType(self::TYPE);
        $this->setDetails(new BankAccountCaDetails());
    }

    /**
     * @return BankAccountCaDetails
     */
    public function getDetails(): BankAccountCaDetails
    {
        return $this->details;
    }
}
