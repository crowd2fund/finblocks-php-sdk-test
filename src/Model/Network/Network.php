<?php

namespace FinBlocks\Model\Network;

use FinBlocks\Exception\FinBlocksException;
use FinBlocks\Model\Address\Address;
use FinBlocks\Model\BaseModelInterface;

/**
 * @author    David Garcia <me@davidgarcia.cat>
 * @copyright FinBlocks
 *
 * @version 1.0.0
 * @since   1.0.0
 */
class Network implements BaseModelInterface
{
    /**
     * @var string
     */
    private $id;

    /**
     * @var string
     */
    private $name;

    /**
     * @var string
     */
    private $legalName;

    /**
     * @var string
     */
    private $type;

    /**
     * @var string[]
     */
    private $techEmails = [];

    /**
     * @var string[]
     */
    private $adminEmails = [];

    /**
     * @var string[]
     */
    private $billingEmails = [];

    /**
     * @var string[]
     */
    private $fraudEmails = [];

    /**
     * @var Address
     */
    private $address;

    /**
     * @var string
     */
    private $phoneNumber;

    /**
     * @var string|null
     */
    private $taxNumber;

    /**
     * @var string
     */
    private $businessType;

    /**
     * @var string
     */
    private $businessIndustry;

    /**
     * @var string
     */
    private $url;

    /**
     * @var string|null
     */
    private $label;

    /**
     * @var string
     */
    private $reference;

    /**
     * @var string|null
     */
    private $primaryThemeColour;

    /**
     * @var string|null
     */
    private $primaryButtonColour;

    /**
     * @var string|null
     */
    private $logo;

    /**
     * Network constructor.
     *
     * @param string|null $jsonData
     */
    private function __construct(string $jsonData = null)
    {
        try {
            if (!empty($jsonData)) {
                $arrayData = json_decode($jsonData, true);

                if (JSON_ERROR_NONE !== json_last_error()) {
                    throw new \InvalidArgumentException(json_last_error_msg(), json_last_error());
                }

                $this->address = Address::create();

                foreach ($arrayData as $property => $content) {
                    switch ($property) {
                        case 'address':
                            $this->$property = Address::createFromPayload(json_encode($content));
                            break;
                        default:
                            $this->$property = $content;
                    }
                }
            } else {
                throw new \InvalidArgumentException('JSON payload not provided');
            }
        } catch (\Throwable $throwable) {
            throw new FinBlocksException($throwable->getMessage(), $throwable->getCode(), $throwable);
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
     * @return string
     */
    public function getId(): string
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @return string
     */
    public function getLegalName(): string
    {
        return $this->legalName;
    }

    /**
     * @return string
     */
    public function getType(): string
    {
        return $this->type;
    }

    /**
     * @param string[] $techEmails
     */
    public function setTechEmails(array $techEmails)
    {
        $this->techEmails = $techEmails;
    }

    /**
     * @return string[]
     */
    public function getTechEmails(): array
    {
        return $this->techEmails;
    }

    /**
     * @param string[] $adminEmails
     */
    public function setAdminEmails(array $adminEmails)
    {
        $this->adminEmails = $adminEmails;
    }

    /**
     * @return string[]
     */
    public function getAdminEmails(): array
    {
        return $this->adminEmails;
    }

    /**
     * @param string[] $billingEmails
     */
    public function setBillingEmails(array $billingEmails)
    {
        $this->billingEmails = $billingEmails;
    }

    /**
     * @return string[]
     */
    public function getBillingEmails(): array
    {
        return $this->billingEmails;
    }

    /**
     * @param string[] $fraudEmails
     */
    public function setFraudEmails(array $fraudEmails)
    {
        $this->fraudEmails = $fraudEmails;
    }

    /**
     * @return string[]
     */
    public function getFraudEmails(): array
    {
        return $this->fraudEmails;
    }

    /**
     * @return Address
     */
    public function getAddress(): Address
    {
        return $this->address;
    }

    /**
     * @param string $phoneNumber
     */
    public function setPhoneNumber(string $phoneNumber)
    {
        $this->phoneNumber = $phoneNumber;
    }

    /**
     * @return string
     */
    public function getPhoneNumber(): string
    {
        return $this->phoneNumber;
    }

    /**
     * @return string|null
     */
    public function getTaxNumber()
    {
        return $this->taxNumber;
    }

    /**
     * @return string
     */
    public function getBusinessType(): string
    {
        return $this->businessType;
    }

    /**
     * @return string
     */
    public function getBusinessIndustry(): string
    {
        return $this->businessIndustry;
    }

    /**
     * @param string $url
     */
    public function setUrl(string $url)
    {
        $this->url = $url;
    }

    /**
     * @return string
     */
    public function getUrl(): string
    {
        return $this->url;
    }

    /**
     * @param string|null $label
     */
    public function setLabel(string $label = null)
    {
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
     * @return string
     */
    public function getReference(): string
    {
        return $this->reference;
    }

    /**
     * @param string|null $primaryThemeColour
     */
    public function setPrimaryThemeColour(string $primaryThemeColour = null)
    {
        $this->primaryThemeColour = $primaryThemeColour;
    }

    /**
     * @return string|null
     */
    public function getPrimaryThemeColour()
    {
        return $this->primaryThemeColour;
    }

    /**
     * @param string|null $primaryButtonColour
     */
    public function setPrimaryButtonColour(string $primaryButtonColour = null)
    {
        $this->primaryButtonColour = $primaryButtonColour;
    }

    /**
     * @return string|null
     */
    public function getPrimaryButtonColour()
    {
        return $this->primaryButtonColour;
    }

    /**
     * @param string $logo
     */
    public function setLogo(string $logo = null)
    {
        $this->logo = $logo;
    }

    /**
     * @return string|null
     */
    public function getLogo()
    {
        return $this->logo;
    }

    /**
     * Converts the Model to an array with all fields and format that we can use for the POST request.
     *
     * @return array
     */
    public function httpCreate(): array
    {
        throw new FinBlocksException('Impossible to create the Network');
    }

    /**
     * Converts the Model to an array with all fields and format that we can use for the PUT request.
     *
     * @return array
     */
    public function httpUpdate(): array
    {
        return [
            'techEmails' => $this->techEmails,
            'adminEmails' => $this->adminEmails,
            'billingEmails' => $this->billingEmails,
            'fraudEmails' => $this->fraudEmails,
            'address' => $this->address->httpUpdate(),
            'phoneNumber' => $this->phoneNumber,
            'url' => $this->url,
            'label' => $this->label,
            'primaryThemeColour' => $this->primaryThemeColour,
            'primaryButtonColour' => $this->primaryButtonColour,
            'logo' => $this->logo,
        ];
    }
}
