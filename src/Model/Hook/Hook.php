<?php

namespace FinBlocks\Model\Hook;

use FinBlocks\Exception\FinBlocksException;
use FinBlocks\Model\BaseModelInterface;

/**
 * @author    David Garcia <me@davidgarcia.cat>
 * @copyright FinBlocks
 *
 * @version 1.0.0
 * @since   1.0.0
 */
class Hook implements BaseModelInterface
{
    /**
     * @var HookDetails
     */
    private $depositCreated;

    /**
     * @var HookDetails
     */
    private $depositSucceeded;

    /**
     * @var HookDetails
     */
    private $depositFailed;

    /**
     * @var HookDetails
     */
    private $depositRefundCreated;

    /**
     * @var HookDetails
     */
    private $depositRefundSucceeded;

    /**
     * @var HookDetails
     */
    private $depositRefundFailed;

    /**
     * @var HookDetails
     */
    private $kycCreated;

    /**
     * @var HookDetails
     */
    private $kycSucceeded;

    /**
     * @var HookDetails
     */
    private $kycFailed;

    /**
     * @var HookDetails
     */
    private $mandateCreated;

    /**
     * @var HookDetails
     */
    private $mandateSucceeded;

    /**
     * @var HookDetails
     */
    private $mandateFailed;

    /**
     * @var HookDetails
     */
    private $transferCreated;

    /**
     * @var HookDetails
     */
    private $transferSucceeded;

    /**
     * @var HookDetails
     */
    private $transferFailed;

    /**
     * @var HookDetails
     */
    private $transferRefundCreated;

    /**
     * @var HookDetails
     */
    private $transferRefundSucceeded;

    /**
     * @var HookDetails
     */
    private $transferRefundFailed;

    /**
     * @var HookDetails
     */
    private $withdrawalCreated;

    /**
     * @var HookDetails
     */
    private $withdrawalSucceeded;

    /**
     * @var HookDetails
     */
    private $withdrawalFailed;

    /**
     * @var HookDetails
     */
    private $withdrawalRefundCreated;

    /**
     * @var HookDetails
     */
    private $withdrawalRefundSucceeded;

    /**
     * @var HookDetails
     */
    private $withdrawalRefundFailed;

    /**
     * Hook constructor.
     */
    public function __construct()
    {
        $this->depositCreated = new HookDetails();
        $this->depositSucceeded = new HookDetails();
        $this->depositFailed = new HookDetails();
        $this->depositRefundCreated = new HookDetails();
        $this->depositRefundSucceeded = new HookDetails();
        $this->depositRefundFailed = new HookDetails();
        $this->kycCreated = new HookDetails();
        $this->kycSucceeded = new HookDetails();
        $this->kycFailed = new HookDetails();
        $this->mandateCreated = new HookDetails();
        $this->mandateSucceeded = new HookDetails();
        $this->mandateFailed = new HookDetails();
        $this->transferCreated = new HookDetails();
        $this->transferSucceeded = new HookDetails();
        $this->transferFailed = new HookDetails();
        $this->transferRefundCreated = new HookDetails();
        $this->transferRefundSucceeded = new HookDetails();
        $this->transferRefundFailed = new HookDetails();
        $this->withdrawalCreated = new HookDetails();
        $this->withdrawalSucceeded = new HookDetails();
        $this->withdrawalFailed = new HookDetails();
        $this->withdrawalRefundCreated = new HookDetails();
        $this->withdrawalRefundSucceeded = new HookDetails();
        $this->withdrawalRefundFailed = new HookDetails();
    }

    /**
     * @return HookDetails
     */
    public function getDepositCreated(): HookDetails
    {
        return $this->depositCreated;
    }

    /**
     * @return HookDetails
     */
    public function getDepositSucceeded(): HookDetails
    {
        return $this->depositSucceeded;
    }

    /**
     * @return HookDetails
     */
    public function getDepositFailed(): HookDetails
    {
        return $this->depositFailed;
    }

    /**
     * @return HookDetails
     */
    public function getDepositRefundCreated(): HookDetails
    {
        return $this->depositRefundCreated;
    }

    /**
     * @return HookDetails
     */
    public function getDepositRefundSucceeded(): HookDetails
    {
        return $this->depositRefundSucceeded;
    }

    /**
     * @return HookDetails
     */
    public function getDepositRefundFailed(): HookDetails
    {
        return $this->depositRefundFailed;
    }

    /**
     * @return HookDetails
     */
    public function getKycCreated(): HookDetails
    {
        return $this->kycCreated;
    }

    /**
     * @return HookDetails
     */
    public function getKycSucceeded(): HookDetails
    {
        return $this->kycSucceeded;
    }

    /**
     * @return HookDetails
     */
    public function getKycFailed(): HookDetails
    {
        return $this->kycFailed;
    }

    /**
     * @return HookDetails
     */
    public function getMandateCreated(): HookDetails
    {
        return $this->mandateCreated;
    }

    /**
     * @return HookDetails
     */
    public function getMandateSucceeded(): HookDetails
    {
        return $this->mandateSucceeded;
    }

    /**
     * @return HookDetails
     */
    public function getMandateFailed(): HookDetails
    {
        return $this->mandateFailed;
    }

    /**
     * @return HookDetails
     */
    public function getTransferCreated(): HookDetails
    {
        return $this->transferCreated;
    }

    /**
     * @return HookDetails
     */
    public function getTransferSucceeded(): HookDetails
    {
        return $this->transferSucceeded;
    }

    /**
     * @return HookDetails
     */
    public function getTransferFailed(): HookDetails
    {
        return $this->transferFailed;
    }

    /**
     * @return HookDetails
     */
    public function getTransferRefundCreated(): HookDetails
    {
        return $this->transferRefundCreated;
    }

    /**
     * @return HookDetails
     */
    public function getTransferRefundSucceeded(): HookDetails
    {
        return $this->transferRefundSucceeded;
    }

    /**
     * @return HookDetails
     */
    public function getTransferRefundFailed(): HookDetails
    {
        return $this->transferRefundFailed;
    }

    /**
     * @return HookDetails
     */
    public function getWithdrawalCreated(): HookDetails
    {
        return $this->withdrawalCreated;
    }

    /**
     * @return HookDetails
     */
    public function getWithdrawalSucceeded(): HookDetails
    {
        return $this->withdrawalSucceeded;
    }

    /**
     * @return HookDetails
     */
    public function getWithdrawalFailed(): HookDetails
    {
        return $this->withdrawalFailed;
    }

    /**
     * @return HookDetails
     */
    public function getWithdrawalRefundCreated(): HookDetails
    {
        return $this->withdrawalRefundCreated;
    }

    /**
     * @return HookDetails
     */
    public function getWithdrawalRefundSucceeded(): HookDetails
    {
        return $this->withdrawalRefundSucceeded;
    }

    /**
     * @return HookDetails
     */
    public function getWithdrawalRefundFailed(): HookDetails
    {
        return $this->withdrawalRefundFailed;
    }

    /**
     * {@inheritdoc}
     */
    public function httpCreate(): array
    {
        throw new FinBlocksException('Impossible to create the Hooks');
    }

    /**
     * {@inheritdoc}
     */
    public function httpUpdate(): array
    {
        return [
            'depositCreated' => $this->depositCreated->httpUpdate(),
            'depositFailed' => $this->depositFailed->httpUpdate(),
            'depositSucceeded' => $this->depositSucceeded->httpUpdate(),
            'depositRefundCreated' => $this->depositRefundCreated->httpUpdate(),
            'depositRefundFailed' => $this->depositRefundFailed->httpUpdate(),
            'depositRefundSucceeded' => $this->depositRefundSucceeded->httpUpdate(),
            'kycCreated' => $this->kycCreated->httpUpdate(),
            'kycFailed' => $this->kycFailed->httpUpdate(),
            'kycSucceeded' => $this->kycSucceeded->httpUpdate(),
            'mandateCreated' => $this->mandateCreated->httpUpdate(),
            'mandateFailed' => $this->mandateFailed->httpUpdate(),
            'mandateSucceeded' => $this->mandateSucceeded->httpUpdate(),
            'transferCreated' => $this->transferCreated->httpUpdate(),
            'transferFailed' => $this->transferFailed->httpUpdate(),
            'transferSucceeded' => $this->transferSucceeded->httpUpdate(),
            'transferRefundCreated' => $this->transferRefundCreated->httpUpdate(),
            'transferRefundFailed' => $this->transferRefundFailed->httpUpdate(),
            'transferRefundSucceeded' => $this->transferRefundSucceeded->httpUpdate(),
            'withdrawalCreated' => $this->withdrawalCreated->httpUpdate(),
            'withdrawalFailed' => $this->withdrawalFailed->httpUpdate(),
            'withdrawalSucceeded' => $this->withdrawalSucceeded->httpUpdate(),
            'withdrawalRefundCreated' => $this->withdrawalRefundCreated->httpUpdate(),
            'withdrawalRefundFailed' => $this->withdrawalRefundFailed->httpUpdate(),
            'withdrawalRefundSucceeded' => $this->withdrawalRefundSucceeded->httpUpdate(),
        ];
    }
}
