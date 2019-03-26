<?php

/*
 * This file is part of FinBlocks PHP SDK.
 *
 * Copyright (C) 2018 FinBlocks Ltd.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace FinBlocks\Model\Document;

abstract class AbstractFrontBackDocument extends AbstractFrontDocument
{
    /**
     * @var string
     */
    private $back;

    /**
     * @param string $back
     */
    public function setBack(string $back)
    {
        $this->back = $back;
    }

    /**
     * {@inheritdoc}
     */
    public function httpCreate(): array
    {
        return array_merge(parent::httpCreate(), ['back' => $this->back]);
    }
}
