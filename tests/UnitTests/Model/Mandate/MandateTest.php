<?php

/*
 * This file is part of FinBlocks PHP SDK.
 *
 * Copyright (C) 2018 FinBlocks Ltd.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Finblocks\Tests\UnitTests\Model\Mandate;

use FinBlocks\Exception\FinBlocksException;
use FinBlocks\Model\Mandate\Mandate;
use PHPUnit\Framework\TestCase;

/**
 * @author    David Garcia <me@davidgarcia.cat>
 * @copyright FinBlocks
 *
 * @version 1.0.0
 *
 * @since   1.0.0
 */
class MandateTest extends TestCase
{
    public function testInstantiateEmptyMandate()
    {
        $this->expectException(FinBlocksException::class);

        Mandate::create();
    }

    public function testInstantiateEmptyJson()
    {
        $this->expectException(FinBlocksException::class);

        Mandate::createFromPayload('');
    }

    public function testInstantiateInvalidJson()
    {
        $this->expectException(FinBlocksException::class);

        Mandate::createFromPayload('This is not a valid JSON');
    }

    public function testInstantiateMandate()
    {
        $mandate = Mandate::createFromPayload('{
            "id":"mandate-00000000-0000-4000-0000-000000000000",
            "status":"created",
            "active":false,
            "provider":"provider",
            "flowId":"flow-00000000-0000-4000-0000-000000000000",
            "accountHolderId":"accountholder-00000000-0000-4000-0000-000000000000",
            "providerId":"PROVIDER-ID",
            "createdAt":"2019-04-25T14:45:19.788Z"
        }');

        $this->assertEquals('mandate-00000000-0000-4000-0000-000000000000', $mandate->getId());
        $this->assertEquals('flow-00000000-0000-4000-0000-000000000000', $mandate->getFlowId());
        $this->assertEquals('accountholder-00000000-0000-4000-0000-000000000000', $mandate->getAccountHolderId());
        $this->assertEquals('created', $mandate->getStatus());
        $this->assertEquals(false, $mandate->isActive());
        $this->assertEquals('provider', $mandate->getProvider());
        $this->assertEquals('PROVIDER-ID', $mandate->getProviderId());
        $this->assertEquals('2019-04-25 14:45:19', $mandate->getCreatedAt()->format('Y-m-d H:i:s'));
    }

    public function testCreateArray()
    {
        $this->expectException(FinBlocksException::class);

        $model = Mandate::createFromPayload('{}');
        $model->httpCreate();
    }

    public function testUpdateArray()
    {
        $this->expectException(FinBlocksException::class);

        $model = Mandate::createFromPayload('{}');
        $model->httpUpdate();
    }
}
