<?php

namespace FinBlocks\Model;

/**
 * @author    David Garcia <me@davidgarcia.cat>
 * @copyright FinBlocks
 *
 * @version 1.0.0
 * @since   1.0.0
 */
interface BaseModelInterface
{
    /**
     * Instantiates a new Model.
     *
     * @return self
     */
    public static function create();

    /**
     * Instantiates a new Model filling the properties with the JSON string returned by the API.
     *
     * @param string $jsonData
     *
     * @return self
     */
    public static function createFromPayload(string $jsonData);

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
