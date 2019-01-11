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
use FinBlocks\Model\Wallet\Wallet;

/**
 * @author    David Garcia <me@davidgarcia.cat>
 * @copyright FinBlocks
 *
 * @version 1.0.0
 *
 * @since   1.0.0
 */
trait WalletTrait
{
    public function traitCreateWalletModel(FinBlocks $finBlocks, string $accountHolderId, bool $justMandatory = false): Wallet
    {
        $model = $finBlocks->factories()->wallets()->create();

        $model->setAccountHolderId($accountHolderId);
        $model->setCurrency('GBP');

        if (!$justMandatory) {
            $model->setLabel('Label for Wallet');
            $model->setTag('Tag for Wallet');
        }

        return $model;
    }
}
