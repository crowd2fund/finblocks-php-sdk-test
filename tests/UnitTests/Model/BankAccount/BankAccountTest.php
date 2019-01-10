<?php

/*
 * This file is part of FinBlocks PHP SDK.
 *
 * Copyright (C) 2018 FinBlocks Ltd.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Finblocks\Tests\UnitTests\Model\BankAccount;

use FinBlocks\Exception\FinBlocksException;
use FinBlocks\Model\BankAccount\BankAccountCa;
use FinBlocks\Model\BankAccount\BankAccountDetails\BankAccountCaDetails;
use FinBlocks\Model\BankAccount\BankAccountDetails\BankAccountGbDetails;
use FinBlocks\Model\BankAccount\BankAccountDetails\BankAccountIbanDetails;
use FinBlocks\Model\BankAccount\BankAccountDetails\BankAccountOtherDetails;
use FinBlocks\Model\BankAccount\BankAccountDetails\BankAccountUsDetails;
use FinBlocks\Model\BankAccount\BankAccountGb;
use FinBlocks\Model\BankAccount\BankAccountIban;
use FinBlocks\Model\BankAccount\BankAccountOther;
use FinBlocks\Model\BankAccount\BankAccountUs;
use PHPUnit\Framework\TestCase;

/**
 * @author    David Garcia <me@davidgarcia.cat>
 * @copyright FinBlocks
 *
 * @version 1.0.0
 *
 * @since   1.0.0
 */
class BankAccountTest extends TestCase
{
    public function testCreateEmptyModelAndSettersForCa()
    {
        $model = BankAccountCa::create();
        $model->setAccountHolderId('12345678');
        $model->setLabel('label');
        $model->setTag('tag');
        $model->getDetails()->setBankName('bankName');
        $model->getDetails()->setBranchCode('code');
        $model->getDetails()->setInstitutionNumber('num');
        $model->getDetails()->setAccountNumber('accountNumber');

        $this->assertEquals('12345678', $model->getAccountHolderId());
        $this->assertEquals('label', $model->getLabel());
        $this->assertEquals('tag', $model->getTag());
        $this->assertEquals('bankName', $model->getDetails()->getBankName());
        $this->assertEquals('code', $model->getDetails()->getBranchCode());
        $this->assertEquals('num', $model->getDetails()->getInstitutionNumber());
        $this->assertEquals('accountNumber', $model->getDetails()->getAccountNumber());
    }

    public function testCreateFilledModelFromJsonPayloadForCa()
    {
        $model = BankAccountCa::createFromPayload('{
            "id": "1111",
            "type": "CA",
            "accountHolderId": "2222",
            "label": "CA Bank Account\'s Label",
            "tag": "CA Bank Account\'s Tag",
            "active": true,
            "createdAt": "2019-01-03T13:25:50.757Z",
            "details": {
                "branchCode": "code",
                "institutionNumber": "num",
                "accountNumber": "accountNumber",
                "bankName": "bankName"
            }
        }');

        $this->assertEquals('1111', $model->getId());
        $this->assertEquals('2222', $model->getAccountHolderId());
        $this->assertEquals('CA', $model->getType());
        $this->assertEquals('CA Bank Account\'s Label', $model->getLabel());
        $this->assertEquals('CA Bank Account\'s Tag', $model->getTag());
        $this->assertEquals(true, $model->isActive());

        $this->assertInstanceOf(\DateTime::class, $model->getCreatedAt());

        $this->assertEquals('2019-01-03 13:25:50', $model->getCreatedAt()->format('Y-m-d H:i:s'));

        $this->assertInstanceOf(BankAccountCaDetails::class, $model->getDetails());

        $this->assertEquals('bankName', $model->getDetails()->getBankName());
        $this->assertEquals('code', $model->getDetails()->getBranchCode());
        $this->assertEquals('num', $model->getDetails()->getInstitutionNumber());
        $this->assertEquals('accountNumber', $model->getDetails()->getAccountNumber());
    }

    public function testCreateFilledModelFromWrongJsonPayloadForCa()
    {
        $this->expectException(FinBlocksException::class);

        BankAccountCa::createFromPayload('This is not a JSON payload');
    }

    public function testCreateArrayForCa()
    {
        $model = BankAccountCa::create();

        $array = $model->httpCreate();

        $this->assertCount(4, $array);
        $this->assertArrayHasKey('accountHolderId', $array);
        $this->assertArrayHasKey('label', $array);
        $this->assertArrayHasKey('tag', $array);
        $this->assertArrayHasKey('details', $array);

        $this->assertCount(4, $array['details']);
        $this->assertArrayHasKey('bankName', $array['details']);
        $this->assertArrayHasKey('branchCode', $array['details']);
        $this->assertArrayHasKey('institutionNumber', $array['details']);
        $this->assertArrayHasKey('accountNumber', $array['details']);
    }

    public function testUpdateArrayForCa()
    {
        $this->expectException(FinBlocksException::class);

        $model = BankAccountCa::create();
        $model->httpUpdate();
    }

    public function testCreateEmptyModelAndSettersForGb()
    {
        $model = BankAccountGb::create();
        $model->setAccountHolderId('12345678');
        $model->setLabel('label');
        $model->setTag('tag');
        $model->getDetails()->setSortCode('123456');
        $model->getDetails()->setAccountNumber('12345678');

        $this->assertEquals('12345678', $model->getAccountHolderId());
        $this->assertEquals('label', $model->getLabel());
        $this->assertEquals('tag', $model->getTag());
        $this->assertEquals('123456', $model->getDetails()->getSortCode());
        $this->assertEquals('12345678', $model->getDetails()->getAccountNumber());
    }

    public function testCreateFilledModelFromJsonPayloadForGb()
    {
        $model = BankAccountGb::createFromPayload('{
            "id": "1111",
            "type": "GB",
            "accountHolderId": "2222",
            "label": "GB Bank Account\'s Label",
            "tag": "GB Bank Account\'s Tag",
            "active": true,
            "createdAt": "2019-01-03T13:25:50.757Z",
            "details": {
                "sortCode": "123456",
                "accountNumber": "12345678"
            }
        }');

        $this->assertEquals('1111', $model->getId());
        $this->assertEquals('2222', $model->getAccountHolderId());
        $this->assertEquals('GB', $model->getType());
        $this->assertEquals('GB Bank Account\'s Label', $model->getLabel());
        $this->assertEquals('GB Bank Account\'s Tag', $model->getTag());
        $this->assertEquals(true, $model->isActive());

        $this->assertInstanceOf(\DateTime::class, $model->getCreatedAt());

        $this->assertEquals('2019-01-03 13:25:50', $model->getCreatedAt()->format('Y-m-d H:i:s'));

        $this->assertInstanceOf(BankAccountGbDetails::class, $model->getDetails());

        $this->assertEquals('123456', $model->getDetails()->getSortCode());
        $this->assertEquals('12345678', $model->getDetails()->getAccountNumber());
    }

    public function testCreateFilledModelFromWrongJsonPayloadForGb()
    {
        $this->expectException(FinBlocksException::class);

        BankAccountGb::createFromPayload('This is not a JSON payload');
    }

    public function testCreateArrayForGb()
    {
        $model = BankAccountGb::create();

        $array = $model->httpCreate();

        $this->assertCount(4, $array);
        $this->assertArrayHasKey('accountHolderId', $array);
        $this->assertArrayHasKey('label', $array);
        $this->assertArrayHasKey('tag', $array);
        $this->assertArrayHasKey('details', $array);

        $this->assertCount(2, $array['details']);
        $this->assertArrayHasKey('sortCode', $array['details']);
        $this->assertArrayHasKey('accountNumber', $array['details']);
    }

    public function testUpdateArrayForGb()
    {
        $this->expectException(FinBlocksException::class);

        $model = BankAccountGb::create();
        $model->httpUpdate();
    }

    public function testCreateEmptyModelAndSettersForIban()
    {
        $model = BankAccountIban::create();
        $model->setAccountHolderId('12345678');
        $model->setLabel('label');
        $model->setTag('tag');
        $model->getDetails()->setBic('12345678');
        $model->getDetails()->setIban('12345678901234567890');

        $this->assertEquals('12345678', $model->getAccountHolderId());
        $this->assertEquals('label', $model->getLabel());
        $this->assertEquals('tag', $model->getTag());
        $this->assertEquals('12345678', $model->getDetails()->getBic());
        $this->assertEquals('12345678901234567890', $model->getDetails()->getIban());
    }

    public function testCreateFilledModelFromJsonPayloadForIban()
    {
        $model = BankAccountIban::createFromPayload('{
            "id": "1111",
            "type": "IBAN",
            "accountHolderId": "2222",
            "label": "IBAN Bank Account\'s Label",
            "tag": "IBAN Bank Account\'s Tag",
            "active": true,
            "createdAt": "2019-01-03T13:25:50.757Z",
            "details": {
                "bic": "12345678",
                "iban": "12345678901234567890"
            }
        }');

        $this->assertEquals('1111', $model->getId());
        $this->assertEquals('2222', $model->getAccountHolderId());
        $this->assertEquals('IBAN', $model->getType());
        $this->assertEquals('IBAN Bank Account\'s Label', $model->getLabel());
        $this->assertEquals('IBAN Bank Account\'s Tag', $model->getTag());
        $this->assertEquals(true, $model->isActive());

        $this->assertInstanceOf(\DateTime::class, $model->getCreatedAt());

        $this->assertEquals('2019-01-03 13:25:50', $model->getCreatedAt()->format('Y-m-d H:i:s'));

        $this->assertInstanceOf(BankAccountIbanDetails::class, $model->getDetails());

        $this->assertEquals('12345678', $model->getDetails()->getBic());
        $this->assertEquals('12345678901234567890', $model->getDetails()->getIban());
    }

    public function testCreateFilledModelFromWrongJsonPayloadForIban()
    {
        $this->expectException(FinBlocksException::class);

        BankAccountIban::createFromPayload('This is not a JSON payload');
    }

    public function testCreateArrayForIban()
    {
        $model = BankAccountIban::create();

        $array = $model->httpCreate();

        $this->assertCount(4, $array);
        $this->assertArrayHasKey('accountHolderId', $array);
        $this->assertArrayHasKey('label', $array);
        $this->assertArrayHasKey('tag', $array);
        $this->assertArrayHasKey('details', $array);

        $this->assertCount(2, $array['details']);
        $this->assertArrayHasKey('bic', $array['details']);
        $this->assertArrayHasKey('iban', $array['details']);
    }

    public function testUpdateArrayForIban()
    {
        $this->expectException(FinBlocksException::class);

        $model = BankAccountIban::create();
        $model->httpUpdate();
    }

    public function testCreateEmptyModelAndSettersForOther()
    {
        $model = BankAccountOther::create();
        $model->setAccountHolderId('12345678');
        $model->setLabel('label');
        $model->setTag('tag');
        $model->getDetails()->setCountry('GBR');
        $model->getDetails()->setBic('12345678');
        $model->getDetails()->setAccountNumber('12345678901234567890');

        $this->assertEquals('12345678', $model->getAccountHolderId());
        $this->assertEquals('label', $model->getLabel());
        $this->assertEquals('tag', $model->getTag());
        $this->assertEquals('GBR', $model->getDetails()->getCountry());
        $this->assertEquals('12345678', $model->getDetails()->getBic());
        $this->assertEquals('12345678901234567890', $model->getDetails()->getAccountNumber());
    }

    public function testCreateFilledModelFromJsonPayloadForOther()
    {
        $model = BankAccountOther::createFromPayload('{
            "id": "1111",
            "type": "OTHER",
            "accountHolderId": "2222",
            "label": "OTHER Bank Account\'s Label",
            "tag": "OTHER Bank Account\'s Tag",
            "active": true,
            "createdAt": "2019-01-03T13:25:50.757Z",
            "details": {
                "country": "GBR",
                "bic": "12345678",
                "accountNumber": "12345678901234567890"
            }
        }');

        $this->assertEquals('1111', $model->getId());
        $this->assertEquals('2222', $model->getAccountHolderId());
        $this->assertEquals('OTHER', $model->getType());
        $this->assertEquals('OTHER Bank Account\'s Label', $model->getLabel());
        $this->assertEquals('OTHER Bank Account\'s Tag', $model->getTag());
        $this->assertEquals(true, $model->isActive());

        $this->assertInstanceOf(\DateTime::class, $model->getCreatedAt());

        $this->assertEquals('2019-01-03 13:25:50', $model->getCreatedAt()->format('Y-m-d H:i:s'));

        $this->assertInstanceOf(BankAccountOtherDetails::class, $model->getDetails());

        $this->assertEquals('GBR', $model->getDetails()->getCountry());
        $this->assertEquals('12345678', $model->getDetails()->getBic());
        $this->assertEquals('12345678901234567890', $model->getDetails()->getAccountNumber());
    }

    public function testCreateFilledModelFromWrongJsonPayloadForOther()
    {
        $this->expectException(FinBlocksException::class);

        BankAccountOther::createFromPayload('This is not a JSON payload');
    }

    public function testCreateArrayForOther()
    {
        $model = BankAccountOther::create();

        $array = $model->httpCreate();

        $this->assertCount(4, $array);
        $this->assertArrayHasKey('accountHolderId', $array);
        $this->assertArrayHasKey('label', $array);
        $this->assertArrayHasKey('tag', $array);
        $this->assertArrayHasKey('details', $array);

        $this->assertCount(3, $array['details']);
        $this->assertArrayHasKey('country', $array['details']);
        $this->assertArrayHasKey('bic', $array['details']);
        $this->assertArrayHasKey('accountNumber', $array['details']);
    }

    public function testUpdateArrayForOther()
    {
        $this->expectException(FinBlocksException::class);

        $model = BankAccountOther::create();
        $model->httpUpdate();
    }

    public function testCreateEmptyModelAndSettersForUs()
    {
        $model = BankAccountUs::create();
        $model->setAccountHolderId('12345678');
        $model->setLabel('label');
        $model->setTag('tag');
        $model->getDetails()->setAba('12345678');
        $model->getDetails()->setAccountNumber('12345678901234567890');

        $this->assertEquals('12345678', $model->getAccountHolderId());
        $this->assertEquals('label', $model->getLabel());
        $this->assertEquals('tag', $model->getTag());
        $this->assertEquals('12345678', $model->getDetails()->getAba());
        $this->assertEquals('12345678901234567890', $model->getDetails()->getAccountNumber());
    }

    public function testCreateFilledModelFromJsonPayloadForUs()
    {
        $model = BankAccountUs::createFromPayload('{
            "id": "1111",
            "type": "US",
            "accountHolderId": "2222",
            "label": "US Bank Account\'s Label",
            "tag": "US Bank Account\'s Tag",
            "active": true,
            "createdAt": "2019-01-03T13:25:50.757Z",
            "details": {
                "aba": "12345678",
                "accountNumber": "12345678901234567890"
            }
        }');

        $this->assertEquals('1111', $model->getId());
        $this->assertEquals('2222', $model->getAccountHolderId());
        $this->assertEquals('US', $model->getType());
        $this->assertEquals('US Bank Account\'s Label', $model->getLabel());
        $this->assertEquals('US Bank Account\'s Tag', $model->getTag());
        $this->assertEquals(true, $model->isActive());

        $this->assertInstanceOf(\DateTime::class, $model->getCreatedAt());

        $this->assertEquals('2019-01-03 13:25:50', $model->getCreatedAt()->format('Y-m-d H:i:s'));

        $this->assertInstanceOf(BankAccountUsDetails::class, $model->getDetails());

        $this->assertEquals('12345678', $model->getDetails()->getAba());
        $this->assertEquals('12345678901234567890', $model->getDetails()->getAccountNumber());
    }

    public function testCreateFilledModelFromWrongJsonPayloadForUs()
    {
        $this->expectException(FinBlocksException::class);

        BankAccountUs::createFromPayload('This is not a JSON payload');
    }

    public function testCreateArrayForUs()
    {
        $model = BankAccountUs::create();

        $array = $model->httpCreate();

        $this->assertCount(4, $array);
        $this->assertArrayHasKey('accountHolderId', $array);
        $this->assertArrayHasKey('label', $array);
        $this->assertArrayHasKey('tag', $array);
        $this->assertArrayHasKey('details', $array);

        $this->assertCount(2, $array['details']);
        $this->assertArrayHasKey('aba', $array['details']);
        $this->assertArrayHasKey('accountNumber', $array['details']);
    }

    public function testUpdateArrayForUs()
    {
        $this->expectException(FinBlocksException::class);

        $model = BankAccountUs::create();
        $model->httpUpdate();
    }
}
