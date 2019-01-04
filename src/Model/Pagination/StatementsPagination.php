<?php

namespace FinBlocks\Model\Pagination;

use FinBlocks\Exception\FinBlocksException;
use FinBlocks\Model\Deposit\AbstractDeposit;
use FinBlocks\Model\Deposit\DepositBankWire;
use FinBlocks\Model\Deposit\DepositCard;
use FinBlocks\Model\Deposit\DepositDirectDebit;
use FinBlocks\Model\Refund\Refund;
use FinBlocks\Model\Transfer\Transfer;
use FinBlocks\Model\Withdrawal\Withdrawal;

/**
 * @author    David Garcia <me@davidgarcia.cat>
 * @copyright FinBlocks
 *
 * @version 1.0.0
 * @since   1.0.0
 */
final class StatementsPagination extends AbstractPagination
{
    /**
     * @param string|null $jsonData
     */
    protected function __construct(string $jsonData = null)
    {
        parent::__construct($jsonData);
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
        try {
            $model = new self($jsonData);

            $array = json_decode($jsonData, true);

            foreach ($array['_embedded'] as $arrayModel) {
                if (!array_key_exists('nature', $arrayModel)) {
                    throw new \RuntimeException('Unable to retrieve the nature of this transaction');
                }

                switch ($arrayModel['nature']) {
                    case AbstractDeposit::NATURE:
                        if (!array_key_exists('type', $arrayModel)) {
                            throw new \RuntimeException('Unable to retrieve the type of deposit');
                        }

                        switch ($arrayModel['type']) {
                            case DepositBankWire::TYPE:
                                $itemModel = DepositBankWire::createFromPayload(json_encode($arrayModel));
                                break;
                            case DepositCard::TYPE:
                                $itemModel = DepositCard::createFromPayload(json_encode($arrayModel));
                                break;
                            case DepositDirectDebit::TYPE:
                                $itemModel = DepositDirectDebit::createFromPayload(json_encode($arrayModel));
                                break;
                            default:
                                throw new \RuntimeException('Invalid deposit\'s type');
                        }
                        break;
                    case Refund::NATURE:
                        $itemModel = Refund::createFromPayload(json_encode($arrayModel));
                        break;
                    case Transfer::NATURE:
                        $itemModel = Transfer::createFromPayload(json_encode($arrayModel));
                        break;
                    case Withdrawal::NATURE:
                        $itemModel = Withdrawal::createFromPayload(json_encode($arrayModel));
                        break;
                    default:
                        throw new \RuntimeException('Invalid transaction\'s nature');
                }

                array_push($model->_embedded, $itemModel);
            }

            return $model;
        } catch (\Throwable $throwable) {
            throw new FinBlocksException($throwable->getMessage(), $throwable->getCode(), $throwable);
        }
    }

    /**
     * @return AbstractDeposit[]|Refund[]|Transfer[]|Withdrawal[]
     */
    public function getEmbedded(): array
    {
        return $this->_embedded;
    }
}
