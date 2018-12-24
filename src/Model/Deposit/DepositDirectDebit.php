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
