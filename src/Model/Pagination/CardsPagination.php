<?php

/*
 * This file is part of FinBlocks PHP SDK.
 *
 * Copyright (C) 2018 FinBlocks Ltd.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace FinBlocks\Model\Pagination;

use FinBlocks\Model\Card\Card;

/**
 * @author    David Garcia <me@davidgarcia.cat>
 * @copyright FinBlocks
 *
 * @version 1.0.0
 *
 * @since   1.0.0
 */
final class CardsPagination extends AbstractPagination
{
    /**
     * @param string|null $jsonData
     */
    protected function __construct(string $jsonData = null)
    {
        parent::__construct($jsonData);
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
        $model = new self($jsonData);

        $array = json_decode($jsonData, true);

        foreach ($array['items'] as $arrayModel) {
            $itemModel = Card::createFromPayload(json_encode($arrayModel));

            array_push($model->items, $itemModel);
        }

        return $model;
    }

    /**
     * @return Card[]
     */
    public function getItems(): array
    {
        return $this->items;
    }
}
