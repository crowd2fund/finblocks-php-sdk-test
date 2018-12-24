<?php

namespace FinBlocks\Factory;

use FinBlocks\Model\AccountHolder\AccountHolderBusiness;
use FinBlocks\Model\AccountHolder\AccountHolderIndividual;

/**
 * @author    David Garcia <me@davidgarcia.cat>
 * @copyright FinBlocks
 *
 * @version 1.0.0
 * @since   1.0.0
 */
class AccountHoldersFactory
{
    /**
     * Creates a new Individual's Account Holder Model.
     *
     * @return AccountHolderIndividual
     */
    public function createIndividual(): AccountHolderIndividual
    {
        return new AccountHolderIndividual();
    }

    /**
     * Creates a new Business's Account Holder  Model.
     *
     * @return AccountHolderBusiness
     */
    public function createBusiness(): AccountHolderBusiness
    {
        return new AccountHolderBusiness();
    }
}
