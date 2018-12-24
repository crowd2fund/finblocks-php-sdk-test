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
    public function __construct()
    {
        parent::__construct();

        $this->setType(self::TYPE);

        $this->company = new Company();
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
