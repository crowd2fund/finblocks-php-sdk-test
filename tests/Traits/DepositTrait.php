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
trait DepositTrait
{
    public function traitCreateBankWireDeposit(FinBlocks $finBlocks, string $walletId, string $currency = 'GBP', int $amount = 10000): DepositBankWire
    {
        $model = $finBlocks->factories()->deposits()->createBankWire();

        $this->fillGenericFields($model, $walletId, $currency, $amount);

        return $model;
    }

    /**
     * @param FinBlocks $finBlocks
     * @param string    $cardId
     * @param string    $walletId
     * @param string    $currency
     * @param int       $amount
     *
     * @return DepositCard
     */
    public function traitCreateCardDepositModel(FinBlocks $finBlocks, string $cardId, string $walletId, string $currency = 'GBP', int $amount = 10000): DepositCard
    {
        $model = $finBlocks->factories()->deposits()->createCard();

        $this->fillGenericFields($model, $walletId, $currency, $amount);

        $model->setReference($cardId);
        $model->setSecureMode(false);

        return $model;
    }

    public function traitCreateDirectDebitDepositModel(FinBlocks $finBlocks, string $mandateId, string $walletId, string $currency = 'GBP', int $amount = 10000): DepositDirectDebit
    {
        $model = $finBlocks->factories()->deposits()->createDirectDebit();

        $this->fillGenericFields($model, $walletId, $currency, $amount);

        $model->setReference($mandateId);

        return $model;
    }

    private function fillGenericFields(AbstractDeposit $model, string $walletId, string $currency, int $amount)
    {
        $model->setTo($walletId);
        $model->setReturnUrl('https://domain.com/return-url');

        $model->getAmount()->setAmount($amount);
        $model->getAmount()->setCurrency($currency);
    }
}
