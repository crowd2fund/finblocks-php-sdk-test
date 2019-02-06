<?php

/*
 * This file is part of FinBlocks PHP SDK.
 *
 * Copyright (C) 2018 FinBlocks Ltd.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace FinBlocks\Model\Card;

use FinBlocks\Exception\FinBlocksException;
use FinBlocks\Model\BaseModelInterface;

/**
 * @author    David Garcia <me@davidgarcia.cat>
 * @copyright FinBlocks
 *
 * @version 1.0.0
 *
 * @since   1.0.0
 */
class OneUseToken implements BaseModelInterface
{
    /**
     * @var string
     */
    private $oneUseToken;

    /**
     * @var string
     */
    private $cardLastfour;

    /**
     * @var \DateTime
     */
    private $endDate;

    /**
     * @var string
     */
    private $cardScheme;

    /**
     * @var string
     */
    private $cardFunding;

    /**
     * Card constructor.
     *
     * @param string $jsonData
     */
    private function __construct(string $jsonData)
    {
        try {
            $arrayData = json_decode($jsonData, true);

            if (JSON_ERROR_NONE !== json_last_error()) {
                throw new \InvalidArgumentException(json_last_error_msg(), json_last_error());
            }

            foreach ($arrayData as $property => $content) {
                switch ($property) {
                    case 'endDate':
                        $this->$property = !empty($content) ? \DateTime::createFromFormat('m/y', $content) : null;
                        $this->$property->setDate($this->$property->format('Y'), $this->$property->format('m'), $this->$property->format('t'));
                        $this->$property->setTime(23, 59, 59);
                        break;
                    default:
                        $this->$property = $content;
                }
            }
        } catch (\Throwable $throwable) {
            throw new FinBlocksException($throwable->getMessage(), $throwable->getCode(), $throwable);
        }
    }

    /**
     * {@inheritdoc}
     */
    public static function create()
    {
        throw new FinBlocksException('Impossible to create the One Use Token');
    }

    /**
     * {@inheritdoc}
     */
    public static function createFromPayload(string $jsonData)
    {
        return new self($jsonData);
    }

    /**
     * @return string
     */
    public function getOneUseToken(): string
    {
        return $this->oneUseToken;
    }

    /**
     * @return string
     */
    public function getCardLastfour(): string
    {
        return $this->cardLastfour;
    }

    /**
     * @return \DateTime
     */
    public function getEndDate(): \DateTime
    {
        return $this->endDate;
    }

    /**
     * @return string
     */
    public function getCardScheme(): string
    {
        return $this->cardScheme;
    }

    /**
     * @return string
     */
    public function getCardFunding(): string
    {
        return $this->cardFunding;
    }

    /**
     * Converts the Model to an array with all fields and format that we can use for the POST request.
     *
     * @return array
     */
    public function httpCreate(): array
    {
        throw new FinBlocksException('Impossible to create the One Use Token');
    }

    /**
     * Converts the Model to an array with all fields and format that we can use for the PUT request.
     *
     * @return array
     */
    public function httpUpdate(): array
    {
        throw new FinBlocksException('Impossible to update the One Use Token');
    }
}
