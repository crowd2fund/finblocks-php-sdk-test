<?php

namespace FinBlocks\Model\AccountHolder;

use FinBlocks\Model\AccountHolder\Company\Company;

/**
 * @author    David Garcia <me@davidgarcia.cat>
 * @copyright FinBlocks
 *
 * @version 1.0.0
 * @since   1.0.0
 */
final class AccountHolderBusiness extends AbstractAccountHolder
{
    const TYPE = 'business';

    /**
     * @var Company
     */
    private $company;

    /**
     * AccountHolderBusiness constructor.
     */
    protected function __construct(string $jsonData = null)
    {
        parent::__construct();

        $this->setType(self::TYPE);

        $this->company = Company::create();
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
     * @return Company
     */
    public function getCompany(): Company
    {
        return $this->company;
    }

    /**
     * {@inheritdoc}
     */
    public function httpCreate(): array
    {
        return array_merge(parent::httpCreate(), ['company' => $this->company->httpCreate()]);
    }
}
