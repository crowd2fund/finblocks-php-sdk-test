<?php

/*
 * This file is part of FinBlocks PHP SDK.
 *
 * Copyright (C) 2018 FinBlocks Ltd.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace FinBlocks\Model\Pagination;

use FinBlocks\Exception\FinBlocksException;
use FinBlocks\Model\Deposit\AbstractDeposit;
use FinBlocks\Model\Deposit\DepositBankWire;
use FinBlocks\Model\Deposit\DepositCard;
use FinBlocks\Model\Deposit\DepositDirectDebit;
use FinBlocks\Model\Transfer\Transfer;
use FinBlocks\Model\Withdrawal\Withdrawal;

/**
 * @author    David Garcia <me@davidgarcia.cat>
 * @copyright FinBlocks
 *
 * @version 1.0.0
 *
 * @since   1.0.0
 */
class TransactionPagination extends AbstractPagination
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
        throw new FinBlocksException('Impossible to create a paginated response of transactions');
    }

    /**
     * {@inheritdoc}
     */
    public static function createFromPayload(string $jsonData)
    {
        $model = new self($jsonData);

        $array = json_decode($jsonData, true);

        foreach ($array['items'] as $arrayModel) {
            switch ($arrayModel['nature']) {
                case Transfer::NATURE:
                    $itemModel = Transfer::createFromPayload(json_encode($arrayModel));
                    break;
                case AbstractDeposit::NATURE:
                    switch  ($arrayModel['type']) {
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
                            throw new FinBlocksException(sprintf(
                                'Impossible to hydrate the response: unexpected `%s` type for `%s` nature returned',
                                $arrayModel['type'],
                                $arrayModel['nature']
                            ));
                    }
                    break;
                case Withdrawal::NATURE:
                    $itemModel = Withdrawal::createFromPayload(json_encode($arrayModel));
                    break;
                default:
                    throw new FinBlocksException(sprintf(
                        'Impossible to hydrate the response: unexpected `%s` nature returned',
                        $arrayModel['nature']
                    ));
            }

            array_push($model->items, $itemModel);
        }

        return $model;
    }

    /**
     * @return Transfer[]
     */
    public function getItems(): array
    {
        return $this->items;
    }
}
