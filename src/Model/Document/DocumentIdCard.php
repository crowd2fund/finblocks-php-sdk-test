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

/**
 * @author    David Garcia <me@davidgarcia.cat>
 * @copyright FinBlocks
 *
 * @version 1.0.0
 *
 * @since   1.0.0
 */
final class DocumentIdCard extends AbstractDocument
{
    const TYPE = 'idCard';

    /**
     * @var string
     */
    private $back;

    /**
     * DocumentIdCard constructor.
     *
     * @param string|null $jsonData
     */
    protected function __construct(string $jsonData = null)
    {
        if (!empty($jsonData)) {
            parent::__construct($jsonData);
        } else {
            $this->setType(self::TYPE);
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
