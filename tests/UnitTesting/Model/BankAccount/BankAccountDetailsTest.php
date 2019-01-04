<?php

namespace Finblocks\Tests\UnitTesting\Model\BankAccount;

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

class BankAccountDetailsTest extends TestCase
{
    public function testCreateEmptyModelAndSettersForCa()
    {
        $model = BankAccountCaDetails::create();
        $model->setBankName('bankName');
        $model->setBranchCode('code');
        $model->setInstitutionNumber('num');
        $model->setAccountNumber('accountNumber');

        $this->assertEquals('bankName', $model->getBankName());
        $this->assertEquals('code', $model->getBranchCode());
        $this->assertEquals('num', $model->getInstitutionNumber());
        $this->assertEquals('accountNumber', $model->getAccountNumber());
    }

    public function testCreateFilledModelFromJsonPayloadForCa()
    {
        $model = BankAccountCaDetails::createFromPayload('{
            "branchCode": "code",
            "institutionNumber": "num",
            "accountNumber": "accountNumber",
            "bankName": "bankName"
        }');

        $this->assertEquals('bankName', $model->getBankName());
        $this->assertEquals('code', $model->getBranchCode());
        $this->assertEquals('num', $model->getInstitutionNumber());
        $this->assertEquals('accountNumber', $model->getAccountNumber());
    }

    public function testCreateFilledModelFromWrongJsonPayloadForCa()
    {
        $this->expectException(FinBlocksException::class);

        BankAccountCaDetails::createFromPayload('This is not a JSON payload');
    }

    public function testCreateArrayForCa()
    {
        $model = BankAccountCaDetails::create();

        $array = $model->httpCreate();

        $this->assertCount(4, $array);
        $this->assertArrayHasKey('bankName', $array);
        $this->assertArrayHasKey('branchCode', $array);
        $this->assertArrayHasKey('institutionNumber', $array);
        $this->assertArrayHasKey('accountNumber', $array);
    }

    public function testUpdateArrayForCa()
    {
        $this->expectException(FinBlocksException::class);

        $model = BankAccountCaDetails::create();
        $model->httpUpdate();
    }

    public function testCreateEmptyModelAndSettersForGb()
    {
        $model = BankAccountGbDetails::create();
        $model->setSortCode('123456');
        $model->setAccountNumber('12345678');

        $this->assertEquals('123456', $model->getSortCode());
        $this->assertEquals('12345678', $model->getAccountNumber());
    }

    public function testCreateFilledModelFromJsonPayloadForGb()
    {
        $model = BankAccountGbDetails::createFromPayload('{
            "sortCode": "123456",
            "accountNumber": "12345678"
        }');

        $this->assertEquals('123456', $model->getSortCode());
        $this->assertEquals('12345678', $model->getAccountNumber());
    }

    public function testCreateFilledModelFromWrongJsonPayloadForGb()
    {
        $this->expectException(FinBlocksException::class);

        BankAccountGbDetails::createFromPayload('This is not a JSON payload');
    }

    public function testCreateArrayForGb()
    {
        $model = BankAccountGbDetails::create();

        $array = $model->httpCreate();

        $this->assertCount(2, $array);
        $this->assertArrayHasKey('sortCode', $array);
        $this->assertArrayHasKey('accountNumber', $array);
    }

    public function testUpdateArrayForGb()
    {
        $this->expectException(FinBlocksException::class);

        $model = BankAccountGbDetails::create();
        $model->httpUpdate();
    }

    public function testCreateEmptyModelAndSettersForIban()
    {
        $model = BankAccountIbanDetails::create();
        $model->setBic('12345678');
        $model->setIban('12345678901234567890');

        $this->assertEquals('12345678', $model->getBic());
        $this->assertEquals('12345678901234567890', $model->getIban());
    }

    public function testCreateFilledModelFromJsonPayloadForIban()
    {
        $model = BankAccountIbanDetails::createFromPayload('{
            "bic": "12345678",
            "iban": "12345678901234567890"
        }');

        $this->assertEquals('12345678', $model->getBic());
        $this->assertEquals('12345678901234567890', $model->getIban());
    }

    public function testCreateFilledModelFromWrongJsonPayloadForIban()
    {
        $this->expectException(FinBlocksException::class);

        BankAccountIbanDetails::createFromPayload('This is not a JSON payload');
    }

    public function testCreateArrayForIban()
    {
        $model = BankAccountIbanDetails::create();

        $array = $model->httpCreate();

        $this->assertCount(2, $array);
        $this->assertArrayHasKey('bic', $array);
        $this->assertArrayHasKey('iban', $array);
    }

    public function testUpdateArrayForIban()
    {
        $this->expectException(FinBlocksException::class);

        $model = BankAccountIbanDetails::create();
        $model->httpUpdate();
    }

    public function testCreateEmptyModelAndSettersForOther()
    {
        $model = BankAccountOtherDetails::create();
        $model->setCountry('GBR');
        $model->setBic('12345678');
        $model->setAccountNumber('12345678901234567890');

        $this->assertEquals('GBR', $model->getCountry());
        $this->assertEquals('12345678', $model->getBic());
        $this->assertEquals('12345678901234567890', $model->getAccountNumber());
    }

    public function testCreateFilledModelFromJsonPayloadForOther()
    {
        $model = BankAccountOtherDetails::createFromPayload('{
            "country": "GBR",
            "bic": "12345678",
            "accountNumber": "12345678901234567890"
        }');

        $this->assertEquals('GBR', $model->getCountry());
        $this->assertEquals('12345678', $model->getBic());
        $this->assertEquals('12345678901234567890', $model->getAccountNumber());
    }

    public function testCreateFilledModelFromWrongJsonPayloadForOther()
    {
        $this->expectException(FinBlocksException::class);

        BankAccountOtherDetails::createFromPayload('This is not a JSON payload');
    }

    public function testCreateArrayForOther()
    {
        $model = BankAccountOtherDetails::create();

        $array = $model->httpCreate();

        $this->assertCount(3, $array);
        $this->assertArrayHasKey('country', $array);
        $this->assertArrayHasKey('bic', $array);
        $this->assertArrayHasKey('accountNumber', $array);
    }

    public function testUpdateArrayForOther()
    {
        $this->expectException(FinBlocksException::class);

        $model = BankAccountOtherDetails::create();
        $model->httpUpdate();
    }

    public function testCreateEmptyModelAndSettersForUs()
    {
        $model = BankAccountUsDetails::create();
        $model->setAba('12345678');
        $model->setAccountNumber('12345678901234567890');

        $this->assertEquals('12345678', $model->getAba());
        $this->assertEquals('12345678901234567890', $model->getAccountNumber());
    }

    public function testCreateFilledModelFromJsonPayloadForUs()
    {
        $model = BankAccountUsDetails::createFromPayload('{
            "accountNumber": "12345678901234567890",
            "aba": "12345678"
        }');

        $this->assertEquals('12345678', $model->getAba());
        $this->assertEquals('12345678901234567890', $model->getAccountNumber());
    }

    public function testCreateFilledModelFromWrongJsonPayloadForUs()
    {
        $this->expectException(FinBlocksException::class);

        BankAccountUsDetails::createFromPayload('This is not a JSON payload');
    }

    public function testCreateArrayForUs()
    {
        $model = BankAccountUsDetails::create();

        $array = $model->httpCreate();

        $this->assertCount(2, $array);
        $this->assertArrayHasKey('aba', $array);
        $this->assertArrayHasKey('accountNumber', $array);
    }

    public function testUpdateArrayForUs()
    {
        $this->expectException(FinBlocksException::class);

        $model = BankAccountUsDetails::create();
        $model->httpUpdate();
    }
}
