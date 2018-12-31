<?php

namespace FinBlocks\Model\Refund;

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
class Refund implements BaseModelInterface
{
    const NATURE = 'refund';

    /**
     * @var string
     */
    private $id;

    /**
     * @var string
     */
    private $status;

    /**
     * @var string
     */
    private $nature = self::NATURE;

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
    private $debitedWalletId;

    /**
     * @var string
     */
    private $creditedWalletId;

    /**
     * @var Money
     */
    private $debitedFunds;

    /**
     * @var Money
     */
    private $creditedFunds;

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
     * Refund constructor.
     *
     * @param string|null $jsonData
     */
    private function __construct(string $jsonData = null)
    {
        $this->debitedFunds = Money::create();
        $this->creditedFunds = Money::create();
        $this->fees = Money::create();
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
     * @param string $debitedWalletId
     */
    public function setDebitedWalletId(string $debitedWalletId)
    {
        $this->debitedWalletId = $debitedWalletId;
    }

    /**
     * @return string
     */
    public function getDebitedWalletId(): string
    {
        return $this->debitedWalletId;
    }

    /**
     * @param string $creditedWalletId
     */
    public function setCreditedWalletId(string $creditedWalletId)
    {
        $this->creditedWalletId = $creditedWalletId;
    }

    /**
     * @return string
     */
    public function getCreditedWalletId(): string
    {
        return $this->creditedWalletId;
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
    public function getCreditedFunds(): Money
    {
        return $this->creditedFunds;
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
            'debitedWalletId' => $this->debitedWalletId,
            'creditedWalletId' => $this->creditedWalletId,
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
        throw new FinBlocksException('Impossible to update the Refund');
    }
}
