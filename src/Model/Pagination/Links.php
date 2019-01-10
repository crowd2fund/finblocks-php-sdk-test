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

/**
 * @author    David Garcia <me@davidgarcia.cat>
 * @copyright FinBlocks
 *
 * @version 1.0.0
 *
 * @since   1.0.0
 */
final class Links
{
    /**
     * @var string
     */
    private $self;

    /**
     * @var string
     */
    private $first;

    /**
     * @var string
     */
    private $prev;

    /**
     * @var string
     */
    private $next;

    /**
     * @var string
     */
    private $last;

    /**
     * @param string|null $jsonData
     */
    private function __construct(string $jsonData = null)
    {
    }

    public static function create()
    {
        return new self();
    }

    public static function createFromPayload(string $jsonData)
    {
        return new self($jsonData);
    }

    /**
     * @return string
     */
    public function getSelf(): string
    {
        return sprintf('%s', $this->self);
    }

    /**
     * @return string
     */
    public function getFirst(): string
    {
        return sprintf('%s', $this->first);
    }

    /**
     * @return string
     */
    public function getPrev(): string
    {
        return sprintf('%s', $this->prev);
    }

    /**
     * @return string
     */
    public function getNext(): string
    {
        return sprintf('%s', $this->next);
    }

    /**
     * @return string
     */
    public function getLast(): string
    {
        return sprintf('%s', $this->last);
    }
}
