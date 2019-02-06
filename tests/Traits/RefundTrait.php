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

/**
 * @author    David Garcia <me@davidgarcia.cat>
 * @copyright FinBlocks
 *
 * @version 1.0.0
 *
 * @since   1.0.0
 */
trait RefundTrait
{
    public function traitCreateDepositRefundModel(FinBlocks $finBlocks, string $walletId, int $amount, int $fees = 0, string $currency = 'GBP')
    {
        $model = $finBlocks->factories()->refunds()->create();
        $model->setLabel('Label');
        $model->setTag('Tag');
        $model->getAmount()->setAmount($amount);
        $model->getAmount()->setCurrency($currency);
        $model->getAmount()->setAmount($fees);
        $model->getAmount()->setCurrency($currency);

        return $model;
    }

    public function traitCreateTransferRefundModel(FinBlocks $finBlocks, string $walletId)
    {
        $model = $finBlocks->factories()->refunds()->create();
        $model->setFrom($walletId);
        $model->setLabel('Label');
        $model->setTag('Tag');

        return $model;
    }
}
