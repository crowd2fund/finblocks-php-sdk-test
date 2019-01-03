<?php

namespace FinBlocks\Model\BankAccount;

use FinBlocks\Exception\FinBlocksException;
use FinBlocks\Model\BankAccount\BankAccountDetails\BankAccountOtherDetails;

/**
 * @author    David Garcia <me@davidgarcia.cat>
 * @copyright FinBlocks
 *
 * @version 1.0.0
 * @since   1.0.0
 */
final class BankAccountOther extends AbstractBankAccount
{
    const TYPE = 'OTHER';

    /**
     * BankAccountOther constructor.
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
                    switch ($property) {
                        case 'createdAt':
                            $this->$property = !empty($content) ? new \DateTime($content) : $content;
                            break;
                        case 'details':
                            $this->$property = BankAccountOtherDetails::createFromPayload(json_encode($content));
                            break;
                        default:
                            $this->$property = $content;
                    }
                }
            } catch (\Throwable $throwable) {
                throw new FinBlocksException($throwable->getMessage(), $throwable->getCode(), $throwable);
            }
        } else {
            $this->setType(self::TYPE);
            $this->setDetails(BankAccountOtherDetails::create());
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
     * @return BankAccountOtherDetails
     */
    public function getDetails(): BankAccountOtherDetails
    {
        return $this->details;
    }
}
