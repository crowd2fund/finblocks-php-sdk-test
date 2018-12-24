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

    public function __construct()
    {
        $this->setType(self::TYPE);
        $this->setDetails(new BankAccountUsDetails());
    }

    /**
     * @return BankAccountUsDetails
     */
    public function getDetails(): BankAccountUsDetails
    {
        return $this->details;
    }
}
