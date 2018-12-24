<?php

namespace FinBlocks\Model\Document;

/**
 * @author    David Garcia <me@davidgarcia.cat>
 * @copyright FinBlocks
 *
 * @version 1.0.0
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
     */
    public function __construct()
    {
        $this->setType(self::TYPE);
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
