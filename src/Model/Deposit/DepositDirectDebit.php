<?php

namespace FinBlocks\Model\Deposit;

/**
 * @author    David Garcia <me@davidgarcia.cat>
 * @copyright FinBlocks
 *
 * @version 1.0.0
 * @since   1.0.0
 */
final class DepositDirectDebit extends AbstractDeposit
{
    const TYPE = 'directDebit';

    /**
     * @var string
     */
    private $mandateId;

    /**
     * DepositDirectDebit constructor.
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
     * @param string $mandateId
     */
    public function setMandateId(string $mandateId)
    {
        $this->mandateId = $mandateId;
    }

    /**
     * @return string
     */
    public function getMandateId(): string
    {
        return $this->mandateId;
    }

    /**
     * {@inheritdoc}
     */
    public function httpCreate(): array
    {
        return array_merge(
            parent::httpCreate(),
            ['mandateId' => $this->mandateId]
        );
    }
}
