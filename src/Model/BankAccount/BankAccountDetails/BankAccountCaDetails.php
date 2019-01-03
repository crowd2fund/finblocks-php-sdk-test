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
final class BankAccountCaDetails implements BaseModelInterface
{
    /**
     * @var string
     */
    private $bankName;

    /**
     * @var string
     */
    private $branchCode;

    /**
     * @var string
     */
    private $institutionNumber;

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
     * @param string $bankName
     */
    public function setBankName(string $bankName)
    {
        Assert::stringNotEmpty($bankName);
        Assert::maxLength($bankName, 50);

        $this->bankName = $bankName;
    }

    /**
     * @return string
     */
    public function getBankName(): string
    {
        return $this->bankName;
    }

    /**
     * @param string $branchCode
     */
    public function setBranchCode(string $branchCode)
    {
        Assert::stringNotEmpty($branchCode);
        Assert::maxLength($branchCode, 5);

        $this->branchCode = $branchCode;
    }

    /**
     * @return string
     */
    public function getBranchCode(): string
    {
        return $this->branchCode;
    }

    /**
     * @param string $institutionNumber
     */
    public function setInstitutionNumber(string $institutionNumber)
    {
        Assert::stringNotEmpty($institutionNumber);
        Assert::lengthBetween($institutionNumber, 3, 4);

        $this->institutionNumber = $institutionNumber;
    }

    /**
     * @return string
     */
    public function getInstitutionNumber(): string
    {
        return $this->institutionNumber;
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
            'bankName' => $this->bankName,
            'branchCode' => $this->branchCode,
            'institutionNumber' => $this->institutionNumber,
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
