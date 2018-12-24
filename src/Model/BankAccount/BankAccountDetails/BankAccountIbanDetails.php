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
final class BankAccountIbanDetails implements BaseModelInterface
{
    /**
     * @var string
     */
    private $bic;

    /**
     * @var string
     */
    private $iban;

    /**
     * @param string $bic
     */
    public function setBic(string $bic)
    {
        Assert::stringNotEmpty($bic);

        if (!empty($bic)) {
            Assert::lengthBetween($bic, 8, 11);
        }

        $this->bic = $bic;
    }

    /**
     * @return string
     */
    public function getBic(): string
    {
        return $this->bic;
    }

    /**
     * @param string $iban
     */
    public function setIban(string $iban)
    {
        Assert::stringNotEmpty($iban);
        Assert::maxLength($iban, 34);

        $this->iban = $iban;
    }

    /**
     * @return string
     */
    public function getIban(): string
    {
        return $this->iban;
    }

    /**
     * {@inheritdoc}
     */
    public function httpCreate(): array
    {
        return [
            'bic' => $this->bic,
            'iban' => $this->iban,
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
