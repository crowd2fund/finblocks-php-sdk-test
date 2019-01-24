<?php

/*
 * This file is part of FinBlocks PHP SDK.
 *
 * Copyright (C) 2018 FinBlocks Ltd.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace FinBlocks\Tests\Traits;

use FinBlocks\FinBlocks;
use FinBlocks\Model\Withdrawal\Withdrawal;

/**
 * @author    David Garcia <me@davidgarcia.cat>
 * @copyright FinBlocks
 *
 * @version 1.0.0
 *
 * @since   1.0.0
 */
trait WithdrawalTrait
{
    public function traitCreateWithdrawalModel(FinBlocks $finBlocks, string $bankAccountId, string $walletId, string $currency = 'GBP', bool $justMandatory = false): Withdrawal
    {
        $model = $finBlocks->factories()->withdrawals()->create();
        $model->setBankAccountId($bankAccountId);
        $model->setWalletId($walletId);
        $model->getAmount()->setCurrency($currency);
        $model->getAmount()->setAmount(10000);
        $model->getFees()->setCurrency($currency);
        $model->getFees()->setAmount(0);

        if (!$justMandatory) {
            $model->setLabel('Withdrawal Label');
            $model->setTag('Withdrawal Tag');
            $model->setBankWireReference('reference');
        }

        return $model;
    }
}
