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
final class BankAccountUsDetails implements BaseModelInterface
{
    /**
     * @var string
     */
    private $aba;

    /**
     * @var string
     */
    private $accountNumber;

    /**
     * BankAccountUsDetails constructor.
     *
     * @param string|null $jsonData
     */
    private function __construct(string $jsonData = null)
    {
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
     * @param string $aba
     */
    public function setAba(string $aba)
    {
        Assert::stringNotEmpty($aba);
        Assert::maxLength($aba, 9);

        $this->aba = $aba;
    }

    /**
     * @return string
     */
    public function getAba(): string
    {
        return $this->aba;
    }

    /**
     * @param string $accountNumber
     */
    public function setAccountNumber(string $accountNumber)
    {
        Assert::stringNotEmpty($accountNumber);
        Assert::maxLength($accountNumber, 20);

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
            'aba' => $this->aba,
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
