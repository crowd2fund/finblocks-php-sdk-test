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

use FinBlocks\Exception\FinBlocksException;

/**
 * @author    David Garcia <me@davidgarcia.cat>
 * @copyright FinBlocks
 *
 * @version 1.0.0
 *
 * @since   1.0.0
 */
class KnowYourCustomersTest extends AbstractApiTests
{
    public function testSendDocumentForAdvancedKycCheck()
    {
        $this->markTestIncomplete('Not yet implemented');
    }

    public function testGetPaginatedKycChecks()
    {
        $this->markTestIncomplete('Not yet implemented');
    }

    public function testErrorWhenGettingPaginatedResultsWithInvalidPage()
    {
        $this->expectException(FinBlocksException::class);

        $this->finBlocks->api()->kyc()->list(-1);
    }

    public function testErrorWhenGettingPaginatedResultsWithInvalidPerPage()
    {
        $this->expectException(FinBlocksException::class);

        $this->finBlocks->api()->kyc()->list(1, 10000);
    }

    public function testGetPaginatedKycChecksForGivenAccountHolder()
    {
        $this->markTestIncomplete('Not yet implemented');
    }

    public function testGetPaginatedKycChecksForGivenAccountHolderWithInvalidPage()
    {
        $this->expectException(FinBlocksException::class);

        $this->finBlocks->api()->kyc()->listByAccountHolder('account-holder-id', -1);
    }

    public function testGetPaginatedKycChecksForGivenAccountHolderWithInvalidPerPage()
    {
        $this->expectException(FinBlocksException::class);

        $this->finBlocks->api()->kyc()->listByAccountHolder('account-holder-id', 1, 10000);
    }
}
