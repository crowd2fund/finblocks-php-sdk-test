<?php

namespace FinBlocks\Model\AccountHolder\Company;

use FinBlocks\Model\Address\Address;
use FinBlocks\Model\BaseModelInterface;
use Webmozart\Assert\Assert;

/**
 * @author    David Garcia <me@davidgarcia.cat>
 * @copyright FinBlocks
 *
 * @version 1.0.0
 * @since   1.0.0
 */
final class Company implements BaseModelInterface
{
    const TYPE_BUSINESS = 'business';
    const TYPE_ORGANISATION = 'organisation';
    const TYPE_SOLE_TRADER = 'soletrader';

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
        $this->address = Address::create();
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
        Assert::nullOrStringNotEmpty($number);
        Assert::maxLength($number, 255);

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
        Assert::stringNotEmpty($name);
        Assert::maxLength($name, 255);

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
     * @param string|null $type
     */
    public function setType(string $type = null)
    {
        Assert::stringNotEmpty($type);
        Assert::nullOrOneOf($type, [self::TYPE_BUSINESS, self::TYPE_ORGANISATION, self::TYPE_SOLE_TRADER]);

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
            'number' => $this-> number,
            'name' => $this->name,
            'email' => $this->email,
            'type' => $this->type,
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
