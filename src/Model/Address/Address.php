<?php

namespace FinBlocks\Model\Address;

use FinBlocks\Model\BaseModelInterface;
use Webmozart\Assert\Assert;

/**
 * @author    David Garcia <me@davidgarcia.cat>
 * @copyright FinBlocks
 *
 * @version 1.0.0
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
     * @param string|null $flatNumber
     */
    public function setFlatNumber(string $flatNumber = null)
    {
        Assert::nullOrStringNotEmpty($flatNumber);
        Assert::maxLength($flatNumber, 10);

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
        Assert::nullOrStringNotEmpty($buildingNumber);
        Assert::maxLength($buildingNumber, 10);

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
    public function setBuildingName(string $buildingName)
    {
        Assert::nullOrStringNotEmpty($buildingName);
        Assert::maxLength($buildingName, 255);

        $this->buildingName = $buildingName;
    }

    /**
     * @return string|null
     */
    public function getBuildingName(): string
    {
        return $this->buildingName;
    }

    /**
     * @param string $street
     */
    public function setStreet(string $street)
    {
        Assert::stringNotEmpty($street);
        Assert::maxLength($street, 255);

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
    public function setSubStreet(string $subStreet)
    {
        Assert::nullOrStringNotEmpty($subStreet);
        Assert::maxLength($subStreet, 255);

        $this->subStreet = $subStreet;
    }

    /**
     * @return string|null
     */
    public function getSubStreet(): string
    {
        return $this->subStreet;
    }

    /**
     * @param string $town
     */
    public function setTown(string $town)
    {
        Assert::stringNotEmpty($town);
        Assert::maxLength($town, 255);

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
    public function setState(string $state)
    {
        Assert::nullOrStringNotEmpty($state);
        Assert::maxLength($state, 255);

        $this->state = $state;
    }

    /**
     * @return string|null
     */
    public function getState(): string
    {
        return $this->state;
    }

    /**
     * @param string $postcode
     */
    public function setPostcode(string $postcode)
    {
        Assert::stringNotEmpty($postcode);
        Assert::maxLength($postcode, 255);

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
        Assert::nullOrStringNotEmpty($country);
        Assert::length($country, 3);

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
            'flatNumber' => $this->flatNumber,
            'buildingNumber' => $this->buildingNumber,
            'buildingName' => $this->buildingName,
            'street' => $this->street,
            'subStreet' => $this->subStreet,
            'town' => $this->town,
            'state' => $this->state,
            'postcode' => $this->postcode,
            'country' => $this->country,
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
