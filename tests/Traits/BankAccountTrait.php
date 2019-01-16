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
trait BankAccountTrait
{
    public function traitCreateBankAccountGbModel(FinBlocks $finBlocks, string $accountHolderId, bool $justRequiredFields = false)
    {
        $model = $finBlocks->factories()->bankAccounts()->createGb();
        $model->setAccountHolderId($accountHolderId);
        $model->getDetails()->setSortCode('000000');
        $model->getDetails()->setAccountNumber('00000000');

        if (!$justRequiredFields) {
            $model->setLabel('GB Bank Account Label');
            $model->setTag('GB Bank Account Tag');
        }

        return $model;
    }

    public function traitCreateBankAccountIbanModel(FinBlocks $finBlocks, string $accountHolderId, bool $justRequiredFields = false)
    {
        $model = $finBlocks->factories()->bankAccounts()->createIban();
        $model->setAccountHolderId($accountHolderId);
        $model->getDetails()->setIban('00000000000000000000');

        if (!$justRequiredFields) {
            $model->setLabel('IBAN Bank Account Label');
            $model->setTag('IBAN Bank Account Tag');
            $model->getDetails()->setBic('00000000');
        }

        return $model;
    }

    public function traitCreateBankAccountCaModel(FinBlocks $finBlocks, string $accountHolderId, bool $justRequiredFields = false)
    {
        $model = $finBlocks->factories()->bankAccounts()->createCa();
        $model->setAccountHolderId($accountHolderId);
        $model->getDetails()->setBankName('Bank name');
        $model->getDetails()->setBranchCode('Code');
        $model->getDetails()->setInstitutionNumber('000');
        $model->getDetails()->setAccountNumber('00000000000000000000');

        if (!$justRequiredFields) {
            $model->setLabel('CA Bank Account Label');
            $model->setTag('CA Bank Account Tag');
        }

        return $model;
    }

    public function traitCreateBankAccountUsModel(FinBlocks $finBlocks, string $accountHolderId, bool $justRequiredFields = false)
    {
        $model = $finBlocks->factories()->bankAccounts()->createUs();
        $model->setAccountHolderId($accountHolderId);
        $model->getDetails()->setAba('000000000');
        $model->getDetails()->setAccountNumber('00000000000000000000');

        if (!$justRequiredFields) {
            $model->setLabel('US Bank Account Label');
            $model->setTag('US Bank Account Tag');
        }

        return $model;
    }

    public function traitCreateBankAccountOtherModel(FinBlocks $finBlocks, string $accountHolderId, bool $justRequiredFields = false)
    {
        $model = $finBlocks->factories()->bankAccounts()->createOther();
        $model->setAccountHolderId($accountHolderId);
        $model->getDetails()->setCountry('GBR');
        $model->getDetails()->setBic('00000000');
        $model->getDetails()->setAccountNumber('00000000');

        if (!$justRequiredFields) {
            $model->setLabel('OTHER Bank Account Label');
            $model->setTag('OTHER Bank Account Tag');
        }

        return $model;
    }
}
