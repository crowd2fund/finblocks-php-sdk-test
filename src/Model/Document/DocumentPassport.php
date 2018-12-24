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
     */
    public function __construct()
    {
        $this->setType(self::TYPE);
    }
}
