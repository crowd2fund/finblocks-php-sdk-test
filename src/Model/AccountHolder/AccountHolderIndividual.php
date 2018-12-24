<?php

namespace FinBlocks\Model\AccountHolder;

/**
 * @author    David Garcia <me@davidgarcia.cat>
 * @copyright FinBlocks
 *
 * @version 1.0.0
 * @since   1.0.0
 */
final class AccountHolderIndividual extends AbstractAccountHolder
{
    const TYPE = 'individual';

    /**
     * AccountHolderBusiness constructor.
     */
    public function __construct()
    {
        parent::__construct();

        $this->setType(self::TYPE);
    }
}
