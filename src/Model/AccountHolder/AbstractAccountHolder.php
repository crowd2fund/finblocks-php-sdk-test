<?php

/*
 * This file is part of FinBlocks PHP SDK.
 *
 * Copyright (C) 2018 FinBlocks Ltd.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace FinBlocks\Model\AccountHolder;

use FinBlocks\Model\Address\Address;
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
abstract class AbstractAccountHolder implements BaseModelInterface
{
    /**
     * @var string
     */
    protected $id;

    /**
     * @var string
     */
    protected $type;

    /**
     * @var string
     */
    protected $email;

    /**
     * @var string|null
     */
    protected $label;

    /**
     * @var string|null
     */
    protected $tag;

    /**
     * @var string
     */
    protected $givenName;

    /**
     * @var string|null
     */
    protected $middleName;

    /**
     * @var string
     */
    protected $familyName;

    /**
     * @var \DateTime
     */
    protected $dateOfBirth;

    /**
     * @var string
     */
    protected $nationality;

    /**
     * @var string|null
     */
    protected $occupation;

    /**
     * @var int|null
     */
    protected $incomeRange;

    /**
     * @var string
     */
    protected $kyc;

    /**
     * @var Address
     */
    protected $address;

    protected function __construct()
    {
        $this->address = Address::create();
        $this->dateOfBirth = new \DateTime();
    }

    /**
     * @return string
     */
    public function getId(): string
    {
        return $this->id;
    }

    /**
     * @param string $type
     */
    protected function setType(string $type)
    {
        Assert::oneOf($type, [AccountHolderBusiness::TYPE, AccountHolderIndividual::TYPE]);

        $this->type = $type;
    }

    /**
     * @return string
     */
    public function getType(): string
    {
        return $this->type;
    }

    /**
     * @param string $email
     */
    public function setEmail(string $email)
    {
        Assert::stringNotEmpty($email);
        Assert::maxLength($email, 255);

        $this->email = $email;
    }

    /**
     * @return string
     */
    public function getEmail(): string
    {
        return $this->email;
    }

    /**
     * @param string|null $label
     */
    public function setLabel(string $label = null)
    {
        Assert::nullOrStringNotEmpty($label);
        Assert::maxLength($label, 255);

        $this->label = $label;
    }

    /**
     * @return string|null
     */
    public function getLabel()
    {
        return $this->label;
    }

    /**
     * @param string|null $tag
     */
    public function setTag(string $tag = null)
    {
        Assert::nullOrStringNotEmpty($tag);
        Assert::maxLength($tag, 255);

        $this->tag = $tag;
    }

    /**
     * @return string|null
     */
    public function getTag()
    {
        return $this->tag;
    }

    /**
     * @param string $givenName
     */
    public function setGivenName(string $givenName)
    {
        Assert::stringNotEmpty($givenName);
        Assert::maxLength($givenName, 255);

        $this->givenName = $givenName;
    }

    /**
     * @return string
     */
    public function getGivenName(): string
    {
        return $this->givenName;
    }

    /**
     * @param string|null $middleName
     */
    public function setMiddleName(string $middleName = null)
    {
        Assert::nullOrStringNotEmpty($middleName);
        Assert::maxLength($middleName, 255);

        $this->middleName = $middleName;
    }

    /**
     * @return string|null
     */
    public function getMiddleName()
    {
        return $this->middleName;
    }

    /**
     * @param string $familyName
     */
    public function setFamilyName(string $familyName)
    {
        Assert::stringNotEmpty($familyName);
        Assert::maxLength($familyName, 255);

        $this->familyName = $familyName;
    }

    /**
     * @return string
     */
    public function getFamilyName(): string
    {
        return $this->familyName;
    }

    /**
     * @param \DateTime $dateOfBirth
     */
    public function setDateOfBirth(\DateTime $dateOfBirth)
    {
        $this->dateOfBirth = $dateOfBirth;
    }

    /**
     * @return \DateTime
     */
    public function getDateOfBirth(): \DateTime
    {
        return $this->dateOfBirth;
    }

    /**
     * @param string $nationality
     */
    public function setNationality(string $nationality)
    {
        Assert::stringNotEmpty($nationality);
        Assert::length($nationality, 3);

        $this->nationality = $nationality;
    }

    /**
     * @return string
     */
    public function getNationality(): string
    {
        return $this->nationality;
    }

    /**
     * @param string|null $occupation
     */
    public function setOccupation(string $occupation = null)
    {
        Assert::nullOrStringNotEmpty($occupation);
        Assert::maxLength($occupation, 255);

        $this->occupation = $occupation;
    }

    /**
     * @return string|null
     */
    public function getOccupation()
    {
        return $this->occupation;
    }

    /**
     * @param int|null $incomeRange
     */
    public function setIncomeRange(int $incomeRange = null)
    {
        Assert::nullOrInteger($incomeRange);
        Assert::nullOrOneOf($incomeRange, [1, 2, 3, 4, 5, 6]);

        $this->incomeRange = $incomeRange;
    }

    /**
     * @return int|null
     */
    public function getIncomeRange()
    {
        return $this->incomeRange;
    }

    /**
     * @return string
     */
    public function getKyc(): string
    {
        return $this->kyc;
    }

    /**
     * @return Address
     */
    public function getAddress(): Address
    {
        return $this->address;
    }

    /**
     * {@inheritdoc}
     */
    public function httpCreate(): array
    {
        return [
            'email'       => $this->email,
            'label'       => $this->label,
            'tag'         => $this->tag,
            'givenName'   => $this->givenName,
            'middleName'  => $this->middleName,
            'familyName'  => $this->familyName,
            'dateOfBirth' => $this->dateOfBirth->format('Y-m-d'),
            'nationality' => $this->nationality,
            'occupation'  => $this->occupation,
            'incomeRange' => $this->incomeRange,
            'address'     => $this->address->httpCreate(),
            'kyc'         => true,
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
