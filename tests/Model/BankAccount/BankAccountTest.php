<?php

namespace FinBlocks\Tests\Model\BankAccount;

use FinBlocks\Exception\FinBlocksException;
use FinBlocks\Model\BankAccount\BankAccountCa;
use FinBlocks\Model\BankAccount\BankAccountGb;
use FinBlocks\Model\BankAccount\BankAccountIban;
use FinBlocks\Model\BankAccount\BankAccountOther;
use FinBlocks\Model\BankAccount\BankAccountUs;
use PHPUnit\Framework\TestCase;

class BankAccountTest extends TestCase
{
    public function testModelSettersForCa()
    {
        $model = new BankAccountCa();
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

    public function testCreateArrayForCa()
    {
        $model = new BankAccountCa();

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

        $model = new BankAccountCa();
        $model->httpUpdate();
    }

    public function testModelSettersForGb()
    {
        $model = new BankAccountGb();
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

    public function testCreateArrayForGb()
    {
        $model = new BankAccountGb();

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

        $model = new BankAccountGb();
        $model->httpUpdate();
    }

    public function testModelSettersForIban()
    {
        $model = new BankAccountIban();
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

    public function testCreateArrayForIban()
    {
        $model = new BankAccountIban();

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

        $model = new BankAccountIban();
        $model->httpUpdate();
    }

    public function testModelSettersForOther()
    {
        $model = new BankAccountOther();
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

    public function testCreateArrayForOther()
    {
        $model = new BankAccountOther();

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

        $model = new BankAccountOther();
        $model->httpUpdate();
    }

    public function testModelSettersForUs()
    {
        $model = new BankAccountUs();
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

    public function testCreateArrayForUs()
    {
        $model = new BankAccountUs();

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

        $model = new BankAccountUs();
        $model->httpUpdate();
    }
}
