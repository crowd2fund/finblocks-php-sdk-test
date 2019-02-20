<?php

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
