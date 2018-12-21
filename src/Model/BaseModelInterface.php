<?php

namespace FinBlocks\Model;

/**
 * @author    David Garcia <me@davidgarcia.cat>
 * @copyright FinBlocks
 * @version   1.0.0
 */
interface BaseModelInterface
{
    /**
     * Converts the Model to an array with all fields and format that we can use for the POST request.
     *
     * @return array
     */
    public function httpCreate(): array;

    /**
     * Converts the Model to an array with all fields and format that we can use for the PUT request.
     *
     * @return array
     */
    public function httpUpdate(): array;
}
