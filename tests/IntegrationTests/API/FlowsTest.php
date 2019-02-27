<?php

/*
 * This file is part of FinBlocks PHP SDK.
 *
 * Copyright (C) 2018 FinBlocks Ltd.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace FinBlocks\Tests\IntegrationTests\API;

use FinBlocks\Model\Mandate\Flow;
use FinBlocks\Tests\Traits\AccountHolderTrait;
use FinBlocks\Tests\Traits\FlowTrait;

/**
 * @author    David Garcia <me@davidgarcia.cat>
 * @copyright FinBlocks
 *
 * @version 1.0.0
 *
 * @since   1.0.0
 */
class FlowsTest extends AbstractApiTests
{
    use AccountHolderTrait;
    use FlowTrait;

    public function testCreateFlowForNewMandate()
    {
        $accountHolder = $this->traitCreateAccountHolderIndividualModel($this->finBlocks);
        $accountHolder = $this->finBlocks->api()->accountHolders()->create($accountHolder);

        $flow = $this->traitCreateFlowModel($this->finBlocks, $accountHolder->getId());

        $returnedFlow = $this->finBlocks->api()->mandates()->flows()->create($flow);

        $this->assertInstanceOf(Flow::class, $returnedFlow);
        $this->assertInstanceOf(\DateTime::class, $returnedFlow->getCreatedAt());

        $this->assertNotEmpty($returnedFlow->getId());
        $this->assertNotEmpty($returnedFlow->getUserUrl());

        $this->assertEquals($accountHolder->getId(), $returnedFlow->getAccountHolderId());

        $this->assertNull($returnedFlow->getLabel());
        $this->assertNull($returnedFlow->getTag());

        $this->assertEquals(Flow::STATUS_FLOW_PENDING, $returnedFlow->getStatus());

        $reloadedFlow = $this->finBlocks->api()->mandates()->flows()->show($returnedFlow->getId());

        $this->assertEquals($returnedFlow->getId(), $reloadedFlow->getId());
    }
}
