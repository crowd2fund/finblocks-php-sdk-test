<?php

/*
 * This file is part of FinBlocks PHP SDK.
 *
 * Copyright (C) 2018 FinBlocks Ltd.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace FinBlocks\Model\BankAccount;

use FinBlocks\Exception\FinBlocksException;
use FinBlocks\Model\BankAccount\BankAccountDetails\BankAccountCaDetails;
use FinBlocks\Model\BankAccount\BankAccountDetails\BankAccountGbDetails;
use FinBlocks\Model\BankAccount\BankAccountDetails\BankAccountIbanDetails;
use FinBlocks\Model\BankAccount\BankAccountDetails\BankAccountOtherDetails;
use FinBlocks\Model\BankAccount\BankAccountDetails\BankAccountUsDetails;
use FinBlocks\Model\BaseModelInterface;
use Webmozart\Assert\Assert;

/**
 * @author    David Garcia <me@davidgarcia.cat>
 * @copyright FinBlocks
 *
 * @version 1.0.0
 *
 * @since   1.0.0
 */
abstract class AbstractBankAccount implements BaseModelInterface
{
    /**
     * @var string
     */
    protected $id;

    /**
     * @var string
     */
    protected $type;

    /**
     * @var string
     */
    protected $accountHolderId;

    /**
     * @var string
     */
    protected $label;

    /**
     * @var string
     */
    protected $tag;

    /**
     * @var bool
     */
    protected $enabled;

    /**
     * @var BankAccountCaDetails|BankAccountGbDetails|BankAccountIbanDetails|BankAccountOtherDetails|BankAccountUsDetails
     */
    protected $details;

    /**
     * @var \DateTime
     */
    protected $createdAt;

    /**
     * @return string
     */
    public function getId(): string
    {
        return $this->id;
    }

    /**
     * @param string $type
     */
    protected function setType(string $type)
    {
        $bankAccountTypes = [
            BankAccountGb::TYPE,
            BankAccountIban::TYPE,
            BankAccountCa::TYPE,
            BankAccountUs::TYPE,
            BankAccountOther::TYPE,
        ];

        Assert::stringNotEmpty($type, 'Bank Account Type must be a non-empty string');
        Assert::oneOf($type, $bankAccountTypes, sprintf('Bank Account Type must be one of: %s', implode(', ', $bankAccountTypes)));

        $this->type = $type;
    }

    /**
     * @return string
     */
    public function getType(): string
    {
        return $this->type;
    }

    /**
     * @param string $accountHolderId
     */
    public function setAccountHolderId(string $accountHolderId)
    {
        Assert::stringNotEmpty($accountHolderId, 'Bank Account Account Holder must be a non-empty string');
        Assert::maxLength($accountHolderId, 255, 'Bank Account Account Holder cannot be longer than 255 characters');

        $this->accountHolderId = $accountHolderId;
    }

    /**
     * @return string
     */
    public function getAccountHolderId(): string
    {
        return $this->accountHolderId;
    }

    /**
     * @param string|null $label
     */
    public function setLabel(string $label = null)
    {
        Assert::nullOrStringNotEmpty($label, 'Bank Account Label must be null or a non-empty string');
        Assert::nullOrMaxLength($label, 255, 'Bank Account Label cannot be longer than 255 characters');

        $this->label = $label;
    }

    /**
     * @return string|null
     */
    public function getLabel()
    {
        return $this->label;
    }

    /**
     * @param string|null $tag
     */
    public function setTag(string $tag = null)
    {
        Assert::nullOrStringNotEmpty($tag, 'Bank Account Tag must be null or a non-empty string');
        Assert::nullOrMaxLength($tag, 255, 'Bank Account Tag cannot be longer than 255 characters');

        $this->tag = $tag;
    }

    /**
     * @return string|null
     */
    public function getTag()
    {
        return $this->tag;
    }

    /**
     * @return bool
     */
    public function isEnabled(): bool
    {
        return true === $this->enabled;
    }

    /**
     * @param BankAccountCaDetails|BankAccountGbDetails|BankAccountIbanDetails|BankAccountOtherDetails|BankAccountUsDetails $details
     */
    protected function setDetails($details)
    {
        $this->details = $details;
    }

    /**
     * @return \DateTime
     */
    public function getCreatedAt(): \DateTime
    {
        return $this->createdAt;
    }

    /**
     * {@inheritdoc}
     */
    public function httpCreate(): array
    {
        return [
            'accountHolderId' => $this->accountHolderId,
            'label'           => $this->label,
            'tag'             => $this->tag,
            'details'         => $this->details->httpCreate(),
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function httpUpdate(): array
    {
        throw new FinBlocksException('Impossible to update the Bank Account');
    }
}
