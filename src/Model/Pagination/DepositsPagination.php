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

/**
 * @author    David Garcia <me@davidgarcia.cat>
 * @copyright FinBlocks
 *
 * @version 1.0.0
 *
 * @since   1.0.0
 */
final class DepositsPagination extends AbstractPagination
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

            foreach ($array['items'] as $arrayModel) {
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

                array_push($model->items, $itemModel);
            }

            return $model;
        } catch (\Throwable $throwable) {
            throw new FinBlocksException($throwable->getMessage(), $throwable->getCode(), $throwable);
        }
    }

    /**
     * @return AbstractDeposit[]
     */
    public function getItems(): array
    {
        return $this->items;
    }
}
