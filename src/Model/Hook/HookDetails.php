<?php

namespace FinBlocks\Model\Hook;

use FinBlocks\Exception\FinBlocksException;
use FinBlocks\Model\BaseModelInterface;
use Webmozart\Assert\Assert;

/**
 * @author    David Garcia <me@davidgarcia.cat>
 * @copyright FinBlocks
 *
 * @version 1.0.0
 * @since   1.0.0
 */
class HookDetails implements BaseModelInterface
{
    /**
     * @var string|null
     */
    private $url;

    /**
     * @var bool
     */
    private $active = false;

    /**
     * HookDetails constructor.
     *
     * @param string|null $jsonData
     */
    private function __construct(string $jsonData = null)
    {
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
     * @param string|null $url
     */
    public function setUrl(string $url = null)
    {
        Assert::nullOrStringNotEmpty($url);

        $this->url = $url;
    }

    /**
     * @return string|null
     */
    public function getUrl()
    {
        return $this->url;
    }

    /**
     * @param bool $active
     */
    public function setActive(bool $active)
    {
        Assert::boolean($active);

        $this->active = $active;
    }

    /**
     * @return bool
     */
    public function isActive(): bool
    {
        return true === $this->active;
    }

    /**
     * {@inheritdoc}
     */
    public function httpCreate(): array
    {
        throw new FinBlocksException('Impossible to create the Hook Details');
    }

    /**
     * {@inheritdoc}
     */
    public function httpUpdate(): array
    {
        return [
            'url' => $this->url,
            'active' => $this->active,
        ];
    }
}
