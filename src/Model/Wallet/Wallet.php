<?php

namespace FinBlocks\Model\Wallet;

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
class Wallet implements BaseModelInterface
{
    /**
     * @var string
     */
    private $id;

    /**
     * @var string
     */
    private $accountHolderId;

    /**
     * @var string
     */
    private $currency;

    /**
     * @var string|null
     */
    private $label;

    /**
     * @var string|null
     */
    private $tag;

    /**
     * @var Money
     */
    private $balance;

    /**
     * @var \DateTime
     */
    private $createdAt;

    /**
     * Wallet constructor.
     */
    public function __construct()
    {
        $this->balance = new Money();
    }

    /**
     * @return string
     */
    public function getId(): string
    {
        return $this->id;
    }

    /**
     * @param string $accountHolderId
     */
    public function setAccountHolderId(string $accountHolderId)
    {
        $this->accountHolderId = $accountHolderId;
    }

    /**
     * @return string
     */
    public function getAccountHolderId(): string
    {
        return $this->accountHolderId;
    }

    /**
     * @param string $currency
     */
    public function setCurrency(string $currency)
    {
        $this->currency = $currency;
    }

    /**
     * @return string
     */
    public function getCurrency(): string
    {
        return $this->currency;
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
     * @return Money
     */
    public function getBalance(): Money
    {
        return $this->balance;
    }

    /**
     * @return \DateTime
     */
    public function getCreatedAt(): \DateTime
    {
        return $this->createdAt;
    }

    /**
     * {@inheritdoc}
     */
    public function httpCreate(): array
    {
        return [
            'accountHolderId' => $this->accountHolderId,
            'currency' => $this->currency,
            'label' => $this->label,
            'tag' => $this->tag,
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function httpUpdate(): array
    {
        throw new FinBlocksException('Impossible to update the Wallet');
    }
}
