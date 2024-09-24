<?php

/*
 * This file is part of FinBlocks PHP SDK.
 *
 * Copyright (C) 2018 FinBlocks Ltd.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace FinBlocks\Model\AccountHolder\Company;

use FinBlocks\Exception\FinBlocksException;
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
final class Company implements BaseModelInterface
{
    const string TYPE_BUSINESS = 'business';
    const string TYPE_ORGANISATION = 'organisation';
    const string TYPE_SOLE_TRADER = 'soletrader';

    /**
     * @var string|null
     */
    private $number;

    /**
     * @var string
     */
    private $name;

    /**
     * @var string
     */
    private $email;

    /**
     * @var string|null
     */
    private $type;

    /**
     * @var Address
     */
    private $address;

    /**
     * Company constructor.
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
                    switch ($property) {
                        case 'address':
                            $this->$property = Address::createFromPayload(json_encode($content));
                            break;
                        default:
                            $this->$property = $content;
                    }
                }
            } catch (\Throwable $throwable) {
                throw new FinBlocksException($throwable->getMessage(), $throwable->getCode(), $throwable);
            }
        } else {
            $this->address = Address::create();
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
     * @param string|null $number
     */
    public function setNumber(string $number = null)
    {
        Assert::nullOrStringNotEmpty($number, 'Company Number must be null or a non-empty string');
        Assert::nullOrMaxLength($number, 255, 'Company Number cannot be longer than 255 characters');

        $this->number = $number;
    }

    /**
     * @return string|null
     */
    public function getNumber()
    {
        return $this->number;
    }

    /**
     * @param string $name
     */
    public function setName(string $name)
    {
        Assert::stringNotEmpty($name, 'Company Name must be a non-empty string');
        Assert::maxLength($name, 255, 'Company Name cannot be longer than 255 characters');

        $this->name = $name;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $email
     */
    public function setEmail(string $email)
    {
        Assert::stringNotEmpty($email, 'Company Email must be a non-empty string');
        Assert::maxLength($email, 255, 'Company Email cannot be longer than 255 characters');

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
     * @param string|null $type
     */
    public function setType(string $type = null)
    {
        $allowedTypes = [self::TYPE_BUSINESS, self::TYPE_ORGANISATION, self::TYPE_SOLE_TRADER];

        Assert::stringNotEmpty($type, 'Company Type must be a non-empty string');
        Assert::oneOf($type, $allowedTypes, sprintf('Company Type mut be one of: %s', implode(', ', $allowedTypes)));

        $this->type = $type;
    }

    /**
     * @return string|null
     */
    public function getType()
    {
        return $this->type;
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
            'number'  => $this->number,
            'name'    => $this->name,
            'email'   => $this->email,
            'type'    => $this->type,
            'address' => $this->address->httpCreate(),
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
