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
    protected function __construct(string $jsonData = null)
    {
        parent::__construct();

        $this->setType(self::TYPE);
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
}
