<?php

namespace FinBlocks\Model\BankAccount\BankAccountDetails;

use FinBlocks\Exception\FinBlocksException;
use FinBlocks\Model\BaseModelInterface;
use Webmozart\Assert\Assert;

/**
 * @author    David Garcia <me@davidgarcia.cat>
 * @copyright FinBlocks
 *
 * @version 1.0.0
 * @since   1.0.0
 */
final class BankAccountGbDetails implements BaseModelInterface
{
    /**
     * @var string
     */
    private $sortCode;

    /**
     * @var string
     */
    private $accountNumber;

    /**
     * @param string $sortCode
     */
    public function setSortCode(string $sortCode)
    {
        Assert::stringNotEmpty($sortCode);
        Assert::length($sortCode, 6);

        $this->sortCode = $sortCode;
    }

    /**
     * @return string
     */
    public function getSortCode(): string
    {
        return $this->sortCode;
    }

    /**
     * @param string $accountNumber
     */
    public function setAccountNumber(string $accountNumber)
    {
        Assert::stringNotEmpty($accountNumber);
        Assert::length($accountNumber, 8);

        $this->accountNumber = $accountNumber;
    }

    /**
     * @return string
     */
    public function getAccountNumber(): string
    {
        return $this->accountNumber;
    }

    /**
     * {@inheritdoc}
     */
    public function httpCreate(): array
    {
        return [
            'sortCode' => $this->sortCode,
            'accountNumber' => $this->accountNumber,
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function httpUpdate(): array
    {
        throw new FinBlocksException('Impossible to update the Bank Account details');
    }
}
