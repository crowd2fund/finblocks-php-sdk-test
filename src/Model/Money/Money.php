<?php

namespace FinBlocks\Model\Money;

use FinBlocks\Exception\FinBlocksException;
use FinBlocks\Model\BaseModelInterface;

/**
 * @author    David Garcia <me@davidgarcia.cat>
 * @copyright FinBlocks
 *
 * @version 1.0.0
 * @since   1.0.0
 */
class Money implements BaseModelInterface
{
    /**
     * @var string
     */
    private $currency;

    /**
     * @var int
     */
    private $amount;

    /**
     * Money constructor.
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
     * @param int $amount
     */
    public function setAmount(int $amount)
    {
        $this->amount = $amount;
    }

    /**
     * @return int
     */
    public function getAmount(): int
    {
        return $this->amount;
    }

    /**
     * {@inheritdoc}
     */
    public function httpCreate(): array
    {
        return [
            'currency' => $this->currency,
            'amount' => $this->amount,
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
