<?php

namespace FinBlocks\Model\Deposit;

/**
 * @author    David Garcia <me@davidgarcia.cat>
 * @copyright FinBlocks
 *
 * @version 1.0.0
 * @since   1.0.0
 */
final class DepositCard extends AbstractDeposit
{
    const TYPE = 'card';

    /**
     * @var string
     */
    private $cardId;

    /**
     * @var bool
     */
    private $secureMode = false;

    /**
     * DepositCard constructor.
     *
     * @param string|null $jsonData
     */
    protected function __construct(string $jsonData = null)
    {
        parent::__construct();
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
     * @param string $cardId
     */
    public function setCardId(string $cardId)
    {
        $this->cardId = $cardId;
    }

    /**
     * @return string
     */
    public function getCardId(): string
    {
        return $this->cardId;
    }

    /**
     * @param bool $secureMode
     */
    public function setSecureMode(bool $secureMode)
    {
        $this->secureMode = $secureMode;
    }

    /**
     * @return bool
     */
    public function isSecureMode(): bool
    {
        return true === $this->secureMode;
    }

    /**
     * {@inheritdoc}
     */
    public function httpCreate(): array
    {
        return array_merge(
            parent::httpCreate(),
            ['cardId' => $this->cardId, 'secureMode' => $this->secureMode]
        );
    }
}
