<?php

namespace FinBlocks\Model\Withdrawal;

use FinBlocks\Exception\FinBlocksException;
use FinBlocks\Model\BaseModelInterface;
use FinBlocks\Model\Money\Money;

/**
 * @author    David Garcia <me@davidgarcia.cat>
 * @copyright FinBlocks
 *
 * @version 1.0.0
 * @since   1.0.0
 */
class Withdrawal implements BaseModelInterface
{
    const NATURE = 'withdrawal';

    /**
     * @var string
     */
    private $id;

    /**
     * @var string
     */
    private $walletId;

    /**
     * @var string
     */
    private $bankAccountId;

    /**
     * @var string|null
     */
    private $bankWireReference;

    /**
     * @var string|null
     */
    private $label;

    /**
     * @var string|null
     */
    private $tag;

    /**
     * @var string
     */
    private $status;

    /**
     * @var string
     */
    private $nature = self::NATURE;

    /**
     * @var Money
     */
    private $debitedFunds;

    /**
     * @var Money
     */
    private $fees;

    /**
     * @var \DateTime
     */
    private $createdAt;

    /**
     * @var \DateTime|null
     */
    private $executedAt;

    /**
     * Withdrawal constructor.
     */
    public function __construct()
    {
        $this->debitedFunds = new Money();
        $this->fees = new Money();
    }

    /**
     * @return string
     */
    public function getId(): string
    {
        return $this->id;
    }

    /**
     * @param string $walletId
     */
    public function setWalletId(string $walletId)
    {
        $this->walletId = $walletId;
    }

    /**
     * @return string
     */
    public function getWalletId(): string
    {
        return $this->walletId;
    }

    /**
     * @param string $bankAccountId
     */
    public function setBankAccountId(string $bankAccountId)
    {
        $this->bankAccountId = $bankAccountId;
    }

    /**
     * @return string
     */
    public function getBankAccountId(): string
    {
        return $this->bankAccountId;
    }

    /**
     * @param string|null $bankWireReference
     */
    public function setBankWireReference(string $bankWireReference = null)
    {
        $this->bankWireReference = $bankWireReference;
    }

    /**
     * @return string|null
     */
    public function getBankWireReference()
    {
        return $this->bankWireReference;
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
     * @param string|null $tag
     */
    public function setTag(string $tag = null)
    {
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
     * @return string
     */
    public function getStatus(): string
    {
        return $this->status;
    }

    /**
     * @return string
     */
    public function getNature(): string
    {
        return $this->nature;
    }

    /**
     * @return Money
     */
    public function getDebitedFunds(): Money
    {
        return $this->debitedFunds;
    }

    /**
     * @return Money
     */
    public function getFees(): Money
    {
        return $this->fees;
    }

    /**
     * @return \DateTime
     */
    public function getCreatedAt(): \DateTime
    {
        return $this->createdAt;
    }

    /**
     * @return \DateTime|null
     */
    public function getExecutedAt()
    {
        return $this->executedAt;
    }

    /**
     * Converts the Model to an array with all fields and format that we can use for the POST request.
     *
     * @return array
     */
    public function httpCreate(): array
    {
        return [
            'walletId' => $this->walletId,
            'bankAccountId' => $this->bankAccountId,
            'bankWireReference' => $this->bankWireReference,
            'debitedFunds' => $this->debitedFunds->httpCreate(),
            'fees' => $this->fees->httpCreate(),
            'label' => $this->label,
            'tag' => $this->tag,
        ];
    }

    /**
     * Converts the Model to an array with all fields and format that we can use for the PUT request.
     *
     * @return array
     */
    public function httpUpdate(): array
    {
        throw new FinBlocksException('Impossible to update the Withdrawal');
    }
}
