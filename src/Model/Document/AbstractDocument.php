<?php

namespace FinBlocks\Model\Document;

use FinBlocks\Exception\FinBlocksException;
use FinBlocks\Model\BaseModelInterface;

/**
 * @author    David Garcia <me@davidgarcia.cat>
 * @copyright FinBlocks
 *
 * @version 1.0.0
 * @since   1.0.0
 */
abstract class AbstractDocument implements BaseModelInterface
{
    /**
     * @var string
     */
    private $id;

    /**
     * @var string
     */
    private $type;

    /**
     * @var string
     */
    private $accountHolderId;

    /**
     * @var string|null
     */
    private $label;

    /**
     * @var string|null
     */
    private $tag;

    /**
     * @var \DateTime
     */
    private $createdAt;

    /**
     * @var string
     */
    private $front;

    /**
     * @return string
     */
    public function getId(): string
    {
        return $this->id;
    }

    /**
     * @param string $type
     */
    protected function setType(string $type)
    {
        $this->type = $type;
    }

    /**
     * @return string
     */
    public function getType(): string
    {
        return $this->type;
    }

    /**
     * @param string $accountHolderId
     */
    public function setAccountHolderId(string $accountHolderId)
    {
        $this->accountHolderId = $accountHolderId;
    }

    /**
     * @return string
     */
    public function getAccountHolderId(): string
    {
        return $this->accountHolderId;
    }

    /**
     * @param string|null $label
     */
    public function setLabel(string $label = null)
    {
        $this->label = $label;
    }

    /**
     * @return string|null
     */
    public function getLabel()
    {
        return $this->label;
    }

    /**
     * @param string|null $tag
     */
    public function setTag(string $tag = null)
    {
        $this->tag = $tag;
    }

    /**
     * @return string|null
     */
    public function getTag()
    {
        return $this->tag;
    }

    /**
     * @return \DateTime
     */
    public function getCreatedAt(): \DateTime
    {
        return $this->createdAt;
    }

    /**
     * @param string $front
     */
    public function setFront(string $front)
    {
        $this->front = $front;
    }

    /**
     * {@inheritdoc}
     */
    public function httpCreate(): array
    {
        return [
            'accountHolderId' => $this->accountHolderId,
            'label' => $this->label,
            'tag' => $this->tag,
            'front' => $this->front,
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function httpUpdate(): array
    {
        throw new FinBlocksException('Impossible to update the Document');
    }
}
