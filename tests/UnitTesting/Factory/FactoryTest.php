<?php

namespace Finblocks\Tests\UnitTesting\Factory;

use FinBlocks\Factory;
use FinBlocks\FinBlocks;
use FinBlocks\Model;
use PHPUnit\Framework\TestCase;

/**
 * @author    David Garcia <me@davidgarcia.cat>
 * @copyright FinBlocks
 *
 * @version 1.0.0
 * @since   1.0.0
 */
class FactoryTest extends TestCase
{
    /**
     * @var FinBlocks
     */
    private $finblocks;

    /**
     * {@inheritdoc}
     */
    protected function setUp()
    {
        $this->finblocks = new FinBlocks('', '', '', true);
    }

    public function testAccountHoldersFactory()
    {
        $this->assertInstanceOf(Factory\AccountHoldersFactory::class, $this->finblocks->factories()->accountHolders());
        $this->assertInstanceOf(Model\AccountHolder\AccountHolderIndividual::class, $this->finblocks->factories()->accountHolders()->createIndividual());
        $this->assertInstanceOf(Model\AccountHolder\AccountHolderIndividual::class, $this->finblocks->factories()->accountHolders()->createIndividualFromPayload(''));
        $this->assertInstanceOf(Model\AccountHolder\AccountHolderBusiness::class, $this->finblocks->factories()->accountHolders()->createBusiness());
        $this->assertInstanceOf(Model\AccountHolder\AccountHolderBusiness::class, $this->finblocks->factories()->accountHolders()->createBusinessFromPayload(''));
    }

    public function testBankAccountsFactory()
    {
        $this->assertInstanceOf(Factory\BankAccountsFactory::class, $this->finblocks->factories()->bankAccounts());
        $this->assertInstanceOf(Model\BankAccount\BankAccountCa::class, $this->finblocks->factories()->bankAccounts()->createCa());
        $this->assertInstanceOf(Model\BankAccount\BankAccountCa::class, $this->finblocks->factories()->bankAccounts()->createCaFromPayload(''));
        $this->assertInstanceOf(Model\BankAccount\BankAccountGb::class, $this->finblocks->factories()->bankAccounts()->createGb());
        $this->assertInstanceOf(Model\BankAccount\BankAccountGb::class, $this->finblocks->factories()->bankAccounts()->createGbFromPayload(''));
        $this->assertInstanceOf(Model\BankAccount\BankAccountIban::class, $this->finblocks->factories()->bankAccounts()->createIban());
        $this->assertInstanceOf(Model\BankAccount\BankAccountIban::class, $this->finblocks->factories()->bankAccounts()->createIbanFromPayload(''));
        $this->assertInstanceOf(Model\BankAccount\BankAccountOther::class, $this->finblocks->factories()->bankAccounts()->createOther());
        $this->assertInstanceOf(Model\BankAccount\BankAccountOther::class, $this->finblocks->factories()->bankAccounts()->createOtherFromPayload(''));
        $this->assertInstanceOf(Model\BankAccount\BankAccountUs::class, $this->finblocks->factories()->bankAccounts()->createUs());
        $this->assertInstanceOf(Model\BankAccount\BankAccountUs::class, $this->finblocks->factories()->bankAccounts()->createUsFromPayload(''));
    }

    public function testCardsFactory()
    {
        $this->assertInstanceOf(Factory\CardsFactory::class, $this->finblocks->factories()->cards());
        $this->assertInstanceOf(Model\Card\Card::class, $this->finblocks->factories()->cards()->create());
        $this->assertInstanceOf(Model\Card\Card::class, $this->finblocks->factories()->cards()->createFromPayload(''));
    }

    public function testDepositsFactory()
    {
        $this->assertInstanceOf(Factory\DepositsFactory::class, $this->finblocks->factories()->deposits());
        $this->assertInstanceOf(Model\Deposit\DepositBankWire::class, $this->finblocks->factories()->deposits()->createBankWire());
        $this->assertInstanceOf(Model\Deposit\DepositBankWire::class, $this->finblocks->factories()->deposits()->createBankWireFromPayload(''));
        $this->assertInstanceOf(Model\Deposit\DepositCard::class, $this->finblocks->factories()->deposits()->createCard());
        $this->assertInstanceOf(Model\Deposit\DepositCard::class, $this->finblocks->factories()->deposits()->createCardFromPayload(''));
        $this->assertInstanceOf(Model\Deposit\DepositDirectDebit::class, $this->finblocks->factories()->deposits()->createDirectDebit());
        $this->assertInstanceOf(Model\Deposit\DepositDirectDebit::class, $this->finblocks->factories()->deposits()->createDirectDebitFromPayload(''));
    }

    public function testDocumentsFactory()
    {
        $this->assertInstanceOf(Factory\DocumentsFactory::class, $this->finblocks->factories()->documents());
        $this->assertInstanceOf(Model\Document\DocumentIdCard::class, $this->finblocks->factories()->documents()->createIdCard());
        $this->assertInstanceOf(Model\Document\DocumentIdCard::class, $this->finblocks->factories()->documents()->createIdCardFromPayload(''));
        $this->assertInstanceOf(Model\Document\DocumentPassport::class, $this->finblocks->factories()->documents()->createPassportFromPayload(''));
        $this->assertInstanceOf(Model\Document\DocumentPassport::class, $this->finblocks->factories()->documents()->createPassport());
    }

    public function testHooksFactory()
    {
        $this->assertInstanceOf(Factory\HooksFactory::class, $this->finblocks->factories()->hooks());
        $this->assertInstanceOf(Model\Hook\Hook::class, $this->finblocks->factories()->hooks()->create());
        $this->assertInstanceOf(Model\Hook\Hook::class, $this->finblocks->factories()->hooks()->createFromPayload(''));
        $this->assertInstanceOf(Model\Hook\Callback::class, $this->finblocks->factories()->hooks()->createCallbackFromPayload('{"eventId":"12345"}'));
    }

    public function testKnowYourCustomersFactory()
    {
        $this->assertInstanceOf(Factory\KnowYourCustomersFactory::class, $this->finblocks->factories()->kyc());
        $this->assertInstanceOf(Model\KnowYourCustomer\KnowYourCustomer::class, $this->finblocks->factories()->kyc()->create());
        $this->assertInstanceOf(Model\KnowYourCustomer\KnowYourCustomer::class, $this->finblocks->factories()->kyc()->createFromPayload(''));
    }

    public function testMandatesFactory()
    {
        $this->assertInstanceOf(Factory\MandatesFactory::class, $this->finblocks->factories()->mandates());
        $this->assertInstanceOf(Model\Mandate\Mandate::class, $this->finblocks->factories()->mandates()->create());
        $this->assertInstanceOf(Model\Mandate\Mandate::class, $this->finblocks->factories()->mandates()->createFromPayload(''));
    }

    public function testRefundsFactory()
    {
        $this->assertInstanceOf(Factory\RefundsFactory::class, $this->finblocks->factories()->refunds());
        $this->assertInstanceOf(Model\Refund\Refund::class, $this->finblocks->factories()->refunds()->create());
        $this->assertInstanceOf(Model\Refund\Refund::class, $this->finblocks->factories()->refunds()->createFromPayload(''));
    }

    public function testTransfersFactory()
    {
        $this->assertInstanceOf(Factory\TransfersFactory::class, $this->finblocks->factories()->transfers());
        $this->assertInstanceOf(Model\Transfer\Transfer::class, $this->finblocks->factories()->transfers()->create());
        $this->assertInstanceOf(Model\Transfer\Transfer::class, $this->finblocks->factories()->transfers()->createFromPayload(''));
    }

    public function testWalletsFactory()
    {
        $this->assertInstanceOf(Factory\WalletsFactory::class, $this->finblocks->factories()->wallets());
        $this->assertInstanceOf(Model\Wallet\Wallet::class, $this->finblocks->factories()->wallets()->create());
        $this->assertInstanceOf(Model\Wallet\Wallet::class, $this->finblocks->factories()->wallets()->createFromPayload(''));
    }

    public function testWithdrawalsFactory()
    {
        $this->assertInstanceOf(Factory\WithdrawalsFactory::class, $this->finblocks->factories()->withdrawals());
        $this->assertInstanceOf(Model\Withdrawal\Withdrawal::class, $this->finblocks->factories()->withdrawals()->create());
        $this->assertInstanceOf(Model\Withdrawal\Withdrawal::class, $this->finblocks->factories()->withdrawals()->createFromPayload(''));
    }
}
