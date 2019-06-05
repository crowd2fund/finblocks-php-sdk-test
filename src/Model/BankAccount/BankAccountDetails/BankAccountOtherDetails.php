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
use FinBlocks\Validator\CountryCodeValidator;
use Webmozart\Assert\Assert;

/**
 * @author    David Garcia <me@davidgarcia.cat>
 * @copyright FinBlocks
 *
 * @version 1.0.0
 *
 * @since   1.0.0
 */
final class BankAccountOtherDetails implements BaseModelInterface
{
    /**
     * @var string
     */
    private $country;

    /**
     * @var string
     */
    private $bic;

    /**
     * @var string
     */
    private $accountNumber;

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
     * @param string $country
     */
    public function setCountry(string $country)
    {
        Assert::stringNotEmpty($country, 'Bank Account OTHER Country must be a non-empty string');
        CountryCodeValidator::validate($country, 'Bank Account OTHER Country must be a valid ISO 3166-1 alpha-3 country code');

        $this->country = $country;
    }

    /**
     * @return string
     */
    public function getCountry(): string
    {
        return $this->country;
    }

    /**
     * @param string $bic
     */
    public function setBic(string $bic)
    {
        Assert::stringNotEmpty($bic, 'Bank Account OTHER BIC must be a non-empty string');
        Assert::oneOf(strlen($bic), [8, 11], 'Bank Account OTHER BIC length must be 8 or 11 characters');

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
     * @param string $accountNumber
     */
    public function setAccountNumber(string $accountNumber)
    {
        Assert::stringNotEmpty($accountNumber, 'Bank Account OTHER Account Number must be a non-empty string');
        Assert::maxLength($accountNumber, 20, 'Bank Account OTHER Account Number length must be 20 characters');

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
            'country'       => $this->country,
            'bic'           => $this->bic,
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
