<?php

namespace FinBlocks\Factory;

/**
 * @author    David Garcia <me@davidgarcia.cat>
 * @copyright FinBlocks
 *
 * @version 1.0.0
 * @since   1.0.0
 */
class ModelsFactories
{
    /**
     * Account Holder's Factory.
     *
     * @return AccountHoldersFactory
     */
    public function accountHolders(): AccountHoldersFactory
    {
        return new AccountHoldersFactory();
    }

    /**
     * Bank Account's Factory.
     *
     * @return BankAccountsFactory
     */
    public function bankAccounts(): BankAccountsFactory
    {
        return new BankAccountsFactory();
    }

    /**
     * Card's Factory.
     *
     * @return CardsFactory
     */
    public function cards(): CardsFactory
    {
        return new CardsFactory();
    }

    /**
     * Deposit's Factory.
     *
     * @return DepositsFactory
     */
    public function deposits(): DepositsFactory
    {
        return new DepositsFactory();
    }

    /**
     * Document's Factory.
     *
     * @return DocumentsFactory
     */
    public function documents(): DocumentsFactory
    {
        return new DocumentsFactory();
    }

    /**
     * Hook's Factory.
     *
     * @return HooksFactory
     */
    public function hooks(): HooksFactory
    {
        return new HooksFactory();
    }

    /**
     * KYC's Factory.
     *
     * @return KnowYourCustomersFactory
     */
    public function kyc(): KnowYourCustomersFactory
    {
        return new KnowYourCustomersFactory();
    }

    /**
     * Mandate's Factory.
     *
     * @return MandatesFactory
     */
    public function mandates(): MandatesFactory
    {
        return new MandatesFactory();
    }

    /**
     * Refund's Factory.
     *
     * @return RefundsFactory
     */
    public function refunds(): RefundsFactory
    {
        return new RefundsFactory();
    }

    /**
     * Transfer's Factory.
     *
     * @return TransfersFactory
     */
    public function transfers(): TransfersFactory
    {
        return new TransfersFactory();
    }

    /**
     * Wallet's Factory.
     *
     * @return WalletsFactory
     */
    public function wallets(): WalletsFactory
    {
        return new WalletsFactory();
    }

    /**
     * Withdrawals' Factory.
     *
     * @return WithdrawalsFactory
     */
    public function withdrawals(): WithdrawalsFactory
    {
        return new WithdrawalsFactory();
    }
}
