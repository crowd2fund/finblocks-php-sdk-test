<?php

/*
 * This file is part of FinBlocks PHP SDK.
 *
 * Copyright (C) 2018 FinBlocks Ltd.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace FinBlocks\Tests\Traits;

use FinBlocks\FinBlocks;
use FinBlocks\Model\Mandate\Flow;

/**
 * @author    David Garcia <me@davidgarcia.cat>
 * @copyright FinBlocks
 *
 * @version 1.0.0
 *
 * @since   1.0.0
 */
trait FlowTrait
{
    public function traitCreateFlowModel(FinBlocks $finBlocks, string $accountHolderId): Flow
    {
        $flow = $finBlocks->factories()->flows()->create();
        $flow->setAccountHolderId($accountHolderId);
        $flow->setReturnUrl('https://domain.com/return/flow');

        return $flow;
    }
}
