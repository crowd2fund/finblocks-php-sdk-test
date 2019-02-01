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
use FinBlocks\Model\Card\Card;
use FinBlocks\Model\Card\OneUseToken;

/**
 * @author    David Garcia <me@davidgarcia.cat>
 * @copyright FinBlocks
 *
 * @version 1.0.0
 *
 * @since   1.0.0
 */
trait CardTrait
{
    public function traitCreateOneUseTokenCardModel(FinBlocks $finBlocks): OneUseToken
    {
        return $finBlocks->api()->cards()->devCards()->oneUseToken();
    }

    public function traitCreateCardModel(FinBlocks $finBlocks, string $accountHolderId, bool $justMandatory = false, OneUseToken $oneUseToken = null): Card
    {
        $oneUseToken = !is_null($oneUseToken) ? $oneUseToken : $this->traitCreateOneUseTokenCardModel($finBlocks);

        $model = $finBlocks->factories()->cards()->create();
        $model->setAccountHolderId($accountHolderId);
        $model->setToken($oneUseToken->getOneUseToken());

        if (!$justMandatory) {
            $model->setLabel('Card\'s Label');
            $model->setTag('Card\'s Tag');
        }

        return $model;
    }
}
