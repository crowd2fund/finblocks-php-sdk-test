<?php

namespace FinBlocks\Model\Document;

/**
 * @author    David Garcia <me@davidgarcia.cat>
 * @copyright FinBlocks
 *
 * @version 1.0.0
 * @since   1.0.0
 */
final class DocumentPassport extends AbstractDocument
{
    const TYPE = 'passport';

    /**
     * DocumentPassport constructor.
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
}
