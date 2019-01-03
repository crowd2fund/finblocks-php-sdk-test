<?php

namespace FinBlocks\Tests\Model\Hook;

use FinBlocks\Exception\FinBlocksException;
use FinBlocks\Model\Hook\Hook;
use PHPUnit\Framework\TestCase;

/**
 * @author    David Garcia <me@davidgarcia.cat>
 * @copyright FinBlocks
 *
 * @version 1.0.0
 * @since   1.0.0
 */
class HookTest extends TestCase
{
    public function testCreateEmptyModelAndSetters()
    {
    }

    public function testCreateArray()
    {
        $this->expectException(FinBlocksException::class);

        $model = Hook::create();
        $model->httpCreate();
    }

    public function testUpdateArray()
    {
        $model = Hook::create();

        $array = $model->httpUpdate();

        $this->assertCount(24, $array);
        $this->assertArrayHasKey('depositCreated', $array);
        $this->assertArrayHasKey('depositSucceeded', $array);
        $this->assertArrayHasKey('depositFailed', $array);
        $this->assertArrayHasKey('depositRefundCreated', $array);
        $this->assertArrayHasKey('depositRefundSucceeded', $array);
        $this->assertArrayHasKey('depositRefundFailed', $array);
        $this->assertArrayHasKey('kycCreated', $array);
        $this->assertArrayHasKey('kycSucceeded', $array);
        $this->assertArrayHasKey('kycFailed', $array);
        $this->assertArrayHasKey('mandateCreated', $array);
        $this->assertArrayHasKey('mandateSucceeded', $array);
        $this->assertArrayHasKey('mandateFailed', $array);
        $this->assertArrayHasKey('transferCreated', $array);
        $this->assertArrayHasKey('transferSucceeded', $array);
        $this->assertArrayHasKey('transferFailed', $array);
        $this->assertArrayHasKey('transferRefundCreated', $array);
        $this->assertArrayHasKey('transferRefundSucceeded', $array);
        $this->assertArrayHasKey('transferRefundFailed', $array);
        $this->assertArrayHasKey('withdrawalCreated', $array);
        $this->assertArrayHasKey('withdrawalSucceeded', $array);
        $this->assertArrayHasKey('withdrawalFailed', $array);
        $this->assertArrayHasKey('withdrawalRefundCreated', $array);
        $this->assertArrayHasKey('withdrawalRefundSucceeded', $array);
        $this->assertArrayHasKey('withdrawalRefundFailed', $array);

        $this->assertCount(2, $array['depositCreated']);
        $this->assertArrayHasKey('url', $array['depositCreated']);
        $this->assertArrayHasKey('active', $array['depositCreated']);

        $this->assertCount(2, $array['depositSucceeded']);
        $this->assertArrayHasKey('url', $array['depositSucceeded']);
        $this->assertArrayHasKey('active', $array['depositSucceeded']);

        $this->assertCount(2, $array['depositFailed']);
        $this->assertArrayHasKey('url', $array['depositFailed']);
        $this->assertArrayHasKey('active', $array['depositFailed']);

        $this->assertCount(2, $array['depositRefundCreated']);
        $this->assertArrayHasKey('url', $array['depositRefundCreated']);
        $this->assertArrayHasKey('active', $array['depositRefundCreated']);

        $this->assertCount(2, $array['depositRefundSucceeded']);
        $this->assertArrayHasKey('url', $array['depositRefundSucceeded']);
        $this->assertArrayHasKey('active', $array['depositRefundSucceeded']);

        $this->assertCount(2, $array['depositRefundFailed']);
        $this->assertArrayHasKey('url', $array['depositRefundFailed']);
        $this->assertArrayHasKey('active', $array['depositRefundFailed']);

        $this->assertCount(2, $array['kycCreated']);
        $this->assertArrayHasKey('url', $array['kycCreated']);
        $this->assertArrayHasKey('active', $array['kycCreated']);

        $this->assertCount(2, $array['kycSucceeded']);
        $this->assertArrayHasKey('url', $array['kycSucceeded']);
        $this->assertArrayHasKey('active', $array['kycSucceeded']);

        $this->assertCount(2, $array['kycFailed']);
        $this->assertArrayHasKey('url', $array['kycFailed']);
        $this->assertArrayHasKey('active', $array['kycFailed']);

        $this->assertCount(2, $array['mandateCreated']);
        $this->assertArrayHasKey('url', $array['mandateCreated']);
        $this->assertArrayHasKey('active', $array['mandateCreated']);

        $this->assertCount(2, $array['mandateSucceeded']);
        $this->assertArrayHasKey('url', $array['mandateSucceeded']);
        $this->assertArrayHasKey('active', $array['mandateSucceeded']);

        $this->assertCount(2, $array['mandateFailed']);
        $this->assertArrayHasKey('url', $array['mandateFailed']);
        $this->assertArrayHasKey('active', $array['mandateFailed']);

        $this->assertCount(2, $array['transferCreated']);
        $this->assertArrayHasKey('url', $array['transferCreated']);
        $this->assertArrayHasKey('active', $array['transferCreated']);

        $this->assertCount(2, $array['transferSucceeded']);
        $this->assertArrayHasKey('url', $array['transferSucceeded']);
        $this->assertArrayHasKey('active', $array['transferSucceeded']);

        $this->assertCount(2, $array['transferFailed']);
        $this->assertArrayHasKey('url', $array['transferFailed']);
        $this->assertArrayHasKey('active', $array['transferFailed']);

        $this->assertCount(2, $array['transferRefundCreated']);
        $this->assertArrayHasKey('url', $array['transferRefundCreated']);
        $this->assertArrayHasKey('active', $array['transferRefundCreated']);

        $this->assertCount(2, $array['transferRefundSucceeded']);
        $this->assertArrayHasKey('url', $array['transferRefundSucceeded']);
        $this->assertArrayHasKey('active', $array['transferRefundSucceeded']);

        $this->assertCount(2, $array['transferRefundFailed']);
        $this->assertArrayHasKey('url', $array['transferRefundFailed']);
        $this->assertArrayHasKey('active', $array['transferRefundFailed']);

        $this->assertCount(2, $array['withdrawalCreated']);
        $this->assertArrayHasKey('url', $array['withdrawalCreated']);
        $this->assertArrayHasKey('active', $array['withdrawalCreated']);

        $this->assertCount(2, $array['withdrawalSucceeded']);
        $this->assertArrayHasKey('url', $array['withdrawalSucceeded']);
        $this->assertArrayHasKey('active', $array['withdrawalSucceeded']);

        $this->assertCount(2, $array['withdrawalFailed']);
        $this->assertArrayHasKey('url', $array['withdrawalFailed']);
        $this->assertArrayHasKey('active', $array['withdrawalFailed']);

        $this->assertCount(2, $array['withdrawalRefundCreated']);
        $this->assertArrayHasKey('url', $array['withdrawalRefundCreated']);
        $this->assertArrayHasKey('active', $array['withdrawalRefundCreated']);

        $this->assertCount(2, $array['withdrawalRefundSucceeded']);
        $this->assertArrayHasKey('url', $array['withdrawalRefundSucceeded']);
        $this->assertArrayHasKey('active', $array['withdrawalRefundSucceeded']);

        $this->assertCount(2, $array['withdrawalRefundFailed']);
        $this->assertArrayHasKey('url', $array['withdrawalRefundFailed']);
        $this->assertArrayHasKey('active', $array['withdrawalRefundFailed']);
    }

    public function testCreateFilledModelFromJsonPayload()
    {
        $model = Hook::createFromPayload('{
            "kycCreated": {
                "url": "https://domain.com/callbacks",
                "active": true
            },
            "kycSucceeded": {
                "url": "https://domain.com/callbacks",
                "active": true
            },
            "kycFailed": {
                "url": "https://domain.com/callbacks",
                "active": true
            },
            "mandateCreated": {
                "url": "https://domain.com/callbacks",
                "active": true
            },
            "mandateSucceeded": {
                "url": "https://domain.com/callbacks",
                "active": true
            },
            "mandateFailed": {
                "url": "https://domain.com/callbacks",
                "active": true
            },
            "depositCreated": {
                "url": "https://domain.com/callbacks",
                "active": true
            },
            "depositSucceeded": {
                "url": "https://domain.com/callbacks",
                "active": true
            },
            "depositFailed": {
                "url": "https://domain.com/callbacks",
                "active": true
            },
            "depositRefundCreated": {
                "url": "https://domain.com/callbacks",
                "active": true
            },
            "depositRefundSucceeded": {
                "url": "https://domain.com/callbacks",
                "active": true
            },
            "depositRefundFailed": {
                "url": "https://domain.com/callbacks",
                "active": true
            },
            "transferCreated": {
                "url": "https://domain.com/callbacks",
                "active": true
            },
            "transferSucceeded": {
                "url": "https://domain.com/callbacks",
                "active": true
            },
            "transferFailed": {
                "url": "https://domain.com/callbacks",
                "active": true
            },
            "transferRefundCreated": {
                "url": "https://domain.com/callbacks",
                "active": true
            },
            "transferRefundSucceeded": {
                "url": "https://domain.com/callbacks",
                "active": true
            },
            "transferRefundFailed": {
                "url": "https://domain.com/callbacks",
                "active": true
            },
            "withdrawalCreated": {
                "url": "https://domain.com/callbacks",
                "active": true
            },
            "withdrawalSucceeded": {
                "url": "https://domain.com/callbacks",
                "active": true
            },
            "withdrawalFailed": {
                "url": "https://domain.com/callbacks",
                "active": true
            },
            "withdrawalRefundCreated": {
                "url": "https://domain.com/callbacks",
                "active": true
            },
            "withdrawalRefundSucceeded": {
                "url": "https://domain.com/callbacks",
                "active": true
            },
            "withdrawalRefundFailed": {
                "url": "https://domain.com/callbacks",
                "active": true
            }
        }');

        $this->assertEquals('https://domain.com/callbacks', $model->getKycCreated()->getUrl());
        $this->assertEquals('https://domain.com/callbacks', $model->getKycSucceeded()->getUrl());
        $this->assertEquals('https://domain.com/callbacks', $model->getKycFailed()->getUrl());
        $this->assertEquals('https://domain.com/callbacks', $model->getMandateCreated()->getUrl());
        $this->assertEquals('https://domain.com/callbacks', $model->getMandateSucceeded()->getUrl());
        $this->assertEquals('https://domain.com/callbacks', $model->getMandateFailed()->getUrl());
        $this->assertEquals('https://domain.com/callbacks', $model->getDepositCreated()->getUrl());
        $this->assertEquals('https://domain.com/callbacks', $model->getDepositSucceeded()->getUrl());
        $this->assertEquals('https://domain.com/callbacks', $model->getDepositFailed()->getUrl());
        $this->assertEquals('https://domain.com/callbacks', $model->getDepositRefundCreated()->getUrl());
        $this->assertEquals('https://domain.com/callbacks', $model->getDepositRefundSucceeded()->getUrl());
        $this->assertEquals('https://domain.com/callbacks', $model->getDepositRefundFailed()->getUrl());
        $this->assertEquals('https://domain.com/callbacks', $model->getTransferCreated()->getUrl());
        $this->assertEquals('https://domain.com/callbacks', $model->getTransferSucceeded()->getUrl());
        $this->assertEquals('https://domain.com/callbacks', $model->getTransferFailed()->getUrl());
        $this->assertEquals('https://domain.com/callbacks', $model->getTransferRefundCreated()->getUrl());
        $this->assertEquals('https://domain.com/callbacks', $model->getTransferRefundSucceeded()->getUrl());
        $this->assertEquals('https://domain.com/callbacks', $model->getTransferRefundFailed()->getUrl());
        $this->assertEquals('https://domain.com/callbacks', $model->getWithdrawalCreated()->getUrl());
        $this->assertEquals('https://domain.com/callbacks', $model->getWithdrawalSucceeded()->getUrl());
        $this->assertEquals('https://domain.com/callbacks', $model->getWithdrawalFailed()->getUrl());
        $this->assertEquals('https://domain.com/callbacks', $model->getWithdrawalRefundCreated()->getUrl());
        $this->assertEquals('https://domain.com/callbacks', $model->getWithdrawalRefundSucceeded()->getUrl());
        $this->assertEquals('https://domain.com/callbacks', $model->getWithdrawalRefundFailed()->getUrl());

        $this->assertEquals(true, $model->getKycCreated()->isActive());
        $this->assertEquals(true, $model->getKycSucceeded()->isActive());
        $this->assertEquals(true, $model->getKycFailed()->isActive());
        $this->assertEquals(true, $model->getMandateCreated()->isActive());
        $this->assertEquals(true, $model->getMandateSucceeded()->isActive());
        $this->assertEquals(true, $model->getMandateFailed()->isActive());
        $this->assertEquals(true, $model->getDepositCreated()->isActive());
        $this->assertEquals(true, $model->getDepositSucceeded()->isActive());
        $this->assertEquals(true, $model->getDepositFailed()->isActive());
        $this->assertEquals(true, $model->getDepositRefundCreated()->isActive());
        $this->assertEquals(true, $model->getDepositRefundSucceeded()->isActive());
        $this->assertEquals(true, $model->getDepositRefundFailed()->isActive());
        $this->assertEquals(true, $model->getTransferCreated()->isActive());
        $this->assertEquals(true, $model->getTransferSucceeded()->isActive());
        $this->assertEquals(true, $model->getTransferFailed()->isActive());
        $this->assertEquals(true, $model->getTransferRefundCreated()->isActive());
        $this->assertEquals(true, $model->getTransferRefundSucceeded()->isActive());
        $this->assertEquals(true, $model->getTransferRefundFailed()->isActive());
        $this->assertEquals(true, $model->getWithdrawalCreated()->isActive());
        $this->assertEquals(true, $model->getWithdrawalSucceeded()->isActive());
        $this->assertEquals(true, $model->getWithdrawalFailed()->isActive());
        $this->assertEquals(true, $model->getWithdrawalRefundCreated()->isActive());
        $this->assertEquals(true, $model->getWithdrawalRefundSucceeded()->isActive());
        $this->assertEquals(true, $model->getWithdrawalRefundFailed()->isActive());
    }

    public function testCreateFilledModelFromWrongJsonPayload()
    {
        $this->expectException(FinBlocksException::class);

        Hook::createFromPayload('This is not a JSON payload');
    }
}
