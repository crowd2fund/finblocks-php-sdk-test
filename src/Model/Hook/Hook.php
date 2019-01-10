<?php

/*
 * This file is part of FinBlocks PHP SDK.
 *
 * Copyright (C) 2018 FinBlocks Ltd.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace FinBlocks\Model\Hook;

use FinBlocks\Exception\FinBlocksException;
use FinBlocks\Model\BaseModelInterface;

/**
 * @author    David Garcia <me@davidgarcia.cat>
 * @copyright FinBlocks
 *
 * @version 1.0.0
 *
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
     *
     * @param string|null $jsonData
     */
    private function __construct(string $jsonData = null)
    {
        if (!empty($jsonData)) {
            try {
                $arrayData = json_decode($jsonData, true);

                if (JSON_ERROR_NONE !== json_last_error()) {
                    throw new \InvalidArgumentException(json_last_error_msg(), json_last_error());
                }

                foreach ($arrayData as $property => $content) {
                    $this->$property = HookDetails::createFromPayload(json_encode($content));
                }
            } catch (\Throwable $throwable) {
                throw new FinBlocksException($throwable->getMessage(), $throwable->getCode(), $throwable);
            }
        } else {
            $this->depositCreated = HookDetails::create();
            $this->depositSucceeded = HookDetails::create();
            $this->depositFailed = HookDetails::create();
            $this->depositRefundCreated = HookDetails::create();
            $this->depositRefundSucceeded = HookDetails::create();
            $this->depositRefundFailed = HookDetails::create();
            $this->kycCreated = HookDetails::create();
            $this->kycSucceeded = HookDetails::create();
            $this->kycFailed = HookDetails::create();
            $this->mandateCreated = HookDetails::create();
            $this->mandateSucceeded = HookDetails::create();
            $this->mandateFailed = HookDetails::create();
            $this->transferCreated = HookDetails::create();
            $this->transferSucceeded = HookDetails::create();
            $this->transferFailed = HookDetails::create();
            $this->transferRefundCreated = HookDetails::create();
            $this->transferRefundSucceeded = HookDetails::create();
            $this->transferRefundFailed = HookDetails::create();
            $this->withdrawalCreated = HookDetails::create();
            $this->withdrawalSucceeded = HookDetails::create();
            $this->withdrawalFailed = HookDetails::create();
            $this->withdrawalRefundCreated = HookDetails::create();
            $this->withdrawalRefundSucceeded = HookDetails::create();
            $this->withdrawalRefundFailed = HookDetails::create();
        }
    }

    /**
     * {@inheritdoc}
     */
    public static function create()
    {
        return new self();
    }

    /**
     * {@inheritdoc}
     */
    public static function createFromPayload(string $jsonData)
    {
        return new self($jsonData);
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
            'depositCreated'            => $this->depositCreated->httpUpdate(),
            'depositFailed'             => $this->depositFailed->httpUpdate(),
            'depositSucceeded'          => $this->depositSucceeded->httpUpdate(),
            'depositRefundCreated'      => $this->depositRefundCreated->httpUpdate(),
            'depositRefundFailed'       => $this->depositRefundFailed->httpUpdate(),
            'depositRefundSucceeded'    => $this->depositRefundSucceeded->httpUpdate(),
            'kycCreated'                => $this->kycCreated->httpUpdate(),
            'kycFailed'                 => $this->kycFailed->httpUpdate(),
            'kycSucceeded'              => $this->kycSucceeded->httpUpdate(),
            'mandateCreated'            => $this->mandateCreated->httpUpdate(),
            'mandateFailed'             => $this->mandateFailed->httpUpdate(),
            'mandateSucceeded'          => $this->mandateSucceeded->httpUpdate(),
            'transferCreated'           => $this->transferCreated->httpUpdate(),
            'transferFailed'            => $this->transferFailed->httpUpdate(),
            'transferSucceeded'         => $this->transferSucceeded->httpUpdate(),
            'transferRefundCreated'     => $this->transferRefundCreated->httpUpdate(),
            'transferRefundFailed'      => $this->transferRefundFailed->httpUpdate(),
            'transferRefundSucceeded'   => $this->transferRefundSucceeded->httpUpdate(),
            'withdrawalCreated'         => $this->withdrawalCreated->httpUpdate(),
            'withdrawalFailed'          => $this->withdrawalFailed->httpUpdate(),
            'withdrawalSucceeded'       => $this->withdrawalSucceeded->httpUpdate(),
            'withdrawalRefundCreated'   => $this->withdrawalRefundCreated->httpUpdate(),
            'withdrawalRefundFailed'    => $this->withdrawalRefundFailed->httpUpdate(),
            'withdrawalRefundSucceeded' => $this->withdrawalRefundSucceeded->httpUpdate(),
        ];
    }
}
