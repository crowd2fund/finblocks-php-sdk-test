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
use FinBlocks\Model\BankAccount\AbstractBankAccount;
use FinBlocks\Model\BankAccount\BankAccountCa;
use FinBlocks\Model\BankAccount\BankAccountGb;
use FinBlocks\Model\BankAccount\BankAccountIban;
use FinBlocks\Model\BankAccount\BankAccountOther;
use FinBlocks\Model\BankAccount\BankAccountUs;

/**
 * @author    David Garcia <me@davidgarcia.cat>
 * @copyright FinBlocks
 *
 * @version 1.0.0
 *
 * @since   1.0.0
 */
final class BankAccountsPagination extends AbstractPagination
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
                if (!array_key_exists('type', $arrayModel)) {
                    throw new \RuntimeException('Unable to retrieve the type of bank account');
                }

                switch ($arrayModel['type']) {
                    case BankAccountGb::TYPE:
                        $itemModel = BankAccountGb::createFromPayload(json_encode($arrayModel));
                        break;
                    case BankAccountIban::TYPE:
                        $itemModel = BankAccountIban::createFromPayload(json_encode($arrayModel));
                        break;
                    case BankAccountCa::TYPE:
                        $itemModel = BankAccountCa::createFromPayload(json_encode($arrayModel));
                        break;
                    case BankAccountUs::TYPE:
                        $itemModel = BankAccountUs::createFromPayload(json_encode($arrayModel));
                        break;
                    case BankAccountOther::TYPE:
                        $itemModel = BankAccountOther::createFromPayload(json_encode($arrayModel));
                        break;
                    default:
                        throw new \RuntimeException('Invalid bank account\'s type');
                }

                array_push($model->_embedded, $itemModel);
            }

            return $model;
        } catch (\Throwable $throwable) {
            throw new FinBlocksException($throwable->getMessage(), $throwable->getCode(), $throwable);
        }
    }

    /**
     * @return AbstractBankAccount[]
     */
    public function getEmbedded(): array
    {
        return $this->_embedded;
    }
}
