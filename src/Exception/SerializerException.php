<?php

namespace FinBlocks\Exception;

/**
 * @author    David Garcia <me@davidgarcia.cat>
 * @copyright FinBlocks
 *
 * @version 1.0.0
 * @since   1.0.0
 */
class SerializerException extends \RuntimeException
{
    public function __construct($message, $code, \Throwable $throwable)
    {
        parent::__construct($message, $code, $throwable);
    }
}
