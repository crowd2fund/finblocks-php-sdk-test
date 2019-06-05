<?php

/*
 * This file is part of FinBlocks PHP SDK.
 *
 * Copyright (C) 2018 FinBlocks Ltd.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace FinBlocks\Model\Address;

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
final class Address implements BaseModelInterface
{
    /**
     * @var string|null
     */
    private $flatNumber;

    /**
     * @var string|null
     */
    private $buildingNumber;

    /**
     * @var string|null
     */
    private $buildingName;

    /**
     * @var string
     */
    private $street;

    /**
     * @var string|null
     */
    private $subStreet;

    /**
     * @var string
     */
    private $town;

    /**
     * @var string|null
     */
    private $state;

    /**
     * @var string
     */
    private $postcode;

    /**
     * @var string
     */
    private $country;

    /**
     * Address constructor.
     *
     * @param string|null $jsonData
     */
    private function __construct(string $jsonData = null)
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
     * @param string|null $flatNumber
     */
    public function setFlatNumber(string $flatNumber = null)
    {
        Assert::nullOrStringNotEmpty($flatNumber, 'Address Flat Number must be null or a non-empty string');
        Assert::nullOrMaxLength($flatNumber, 10, 'Address Flat Number cannot be longer than 10 characters');

        $this->flatNumber = $flatNumber;
    }

    /**
     * @return string|null
     */
    public function getFlatNumber()
    {
        return $this->flatNumber;
    }

    /**
     * @param string|null $buildingNumber
     */
    public function setBuildingNumber(string $buildingNumber = null)
    {
        Assert::nullOrStringNotEmpty($buildingNumber, 'Address Building Number must be null or a non-empty string');
        Assert::nullOrMaxLength($buildingNumber, 10, 'Address Building Number cannot be longer than 10 characters');

        $this->buildingNumber = $buildingNumber;
    }

    /**
     * @return string|null
     */
    public function getBuildingNumber()
    {
        return $this->buildingNumber;
    }

    /**
     * @param string|null $buildingName
     */
    public function setBuildingName(string $buildingName = null)
    {
        Assert::nullOrStringNotEmpty($buildingName, 'Address Building Name must be null or a non-empty string');
        Assert::nullOrMaxLength($buildingName, 255, 'Address Building Name cannot be longer than 255 characters');

        $this->buildingName = $buildingName;
    }

    /**
     * @return string|null
     */
    public function getBuildingName()
    {
        return $this->buildingName;
    }

    /**
     * @param string $street
     */
    public function setStreet(string $street)
    {
        Assert::stringNotEmpty($street, 'Address Street must be a non-empty string');
        Assert::maxLength($street, 255, 'Address Street cannot be longer than 255 characters');

        $this->street = $street;
    }

    /**
     * @return string
     */
    public function getStreet(): string
    {
        return $this->street;
    }

    /**
     * @param string|null $subStreet
     */
    public function setSubStreet(string $subStreet = null)
    {
        Assert::nullOrStringNotEmpty($subStreet, 'Address Sub-Street must be null or a non-empty string');
        Assert::nullOrMaxLength($subStreet, 255, 'Address Sub-Street cannot be longer than 255 characters');

        $this->subStreet = $subStreet;
    }

    /**
     * @return string|null
     */
    public function getSubStreet()
    {
        return $this->subStreet;
    }

    /**
     * @param string $town
     */
    public function setTown(string $town)
    {
        Assert::stringNotEmpty($town, 'Address Town must be a non-empty string');
        Assert::maxLength($town, 255, 'Address Town cannot be longer than 255 characters');

        $this->town = $town;
    }

    /**
     * @return string
     */
    public function getTown(): string
    {
        return $this->town;
    }

    /**
     * @param string|null $state
     */
    public function setState(string $state = null)
    {
        Assert::nullOrStringNotEmpty($state, 'Address State must be null or a non-empty string');
        Assert::nullOrMaxLength($state, 255, 'Address State cannot be longer than 255 characters');

        $this->state = $state;
    }

    /**
     * @return string|null
     */
    public function getState()
    {
        return $this->state;
    }

    /**
     * @param string $postcode
     */
    public function setPostcode(string $postcode)
    {
        Assert::stringNotEmpty($postcode, 'Address Postcode must be a non-empty string');
        Assert::maxLength($postcode, 255, 'Address Postcode cannot be longer than 255 characters');

        $this->postcode = $postcode;
    }

    /**
     * @return string
     */
    public function getPostcode(): string
    {
        return $this->postcode;
    }

    /**
     * @param string $country
     */
    public function setCountry(string $country)
    {
        Assert::nullOrStringNotEmpty($country, 'Address Country must be null or a non-empty string');
        CountryCodeValidator::nullOrValidate($country, 'Address Country must be a valid ISO 3166-1 alpha-3 country code');

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
     * {@inheritdoc}
     */
    public function httpCreate(): array
    {
        return [
            'flatNumber'     => $this->flatNumber,
            'buildingNumber' => $this->buildingNumber,
            'buildingName'   => $this->buildingName,
            'street'         => $this->street,
            'subStreet'      => $this->subStreet,
            'town'           => $this->town,
            'state'          => $this->state,
            'postcode'       => $this->postcode,
            'country'        => $this->country,
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function httpUpdate(): array
    {
        return $this->httpCreate();
    }
}
