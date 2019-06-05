<?php

/*
 * This file is part of FinBlocks PHP SDK.
 *
 * Copyright (C) 2018 FinBlocks Ltd.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace FinBlocks\Model\BankAccount\BankAccountDetails;

use FinBlocks\Exception\FinBlocksException;
use FinBlocks\Model\BaseModelInterface;
use Webmozart\Assert\Assert;

/**
 * @author    David Garcia <me@davidgarcia.cat>
 * @copyright FinBlocks
 *
 * @version 1.0.0
 *
 * @since   1.0.0
 */
final class BankAccountIbanDetails implements BaseModelInterface
{
    /**
     * @var string|null
     */
    private $bic;

    /**
     * @var string
     */
    private $iban;

    protected function __construct(string $jsonData = null)
    {
        if (!empty($jsonData)) {
            try {
                $arrayData = json_decode($jsonData, true);

                if (JSON_ERROR_NONE !== json_last_error()) {
                    throw new \InvalidArgumentException(json_last_error_msg(), json_last_error());
                }

                foreach ($arrayData as $property => $content) {
                    $this->$property = $content;
                }
            } catch (\Throwable $throwable) {
                throw new FinBlocksException($throwable->getMessage(), $throwable->getCode(), $throwable);
            }
        }
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
     * @param string|null $bic
     */
    public function setBic(string $bic = null)
    {
        Assert::nullOrStringNotEmpty($bic, 'Bank Account IBAN BIC must be null or a non-empty string');
        Assert::nullOrOneOf(strlen($bic), [8, 11], 'Bank Account IBAN BIC length must be 8 or 11 characters');

        $this->bic = $bic;
    }

    /**
     * @return string
     */
    public function getBic()
    {
        return $this->bic;
    }

    /**
     * @param string $iban
     */
    public function setIban(string $iban)
    {
        Assert::stringNotEmpty($iban, 'Bank Account IBAN must be a non-empty string');
        Assert::maxLength($iban, 34, 'Bank Account IBAN cannot be longer than 34 characters');

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
            'bic'  => $this->bic,
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
