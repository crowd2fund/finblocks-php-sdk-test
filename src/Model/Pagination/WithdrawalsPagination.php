<?php

namespace FinBlocks\Model\Pagination;

use FinBlocks\Model\Withdrawal\Withdrawal;

/**
 * @author    David Garcia <me@davidgarcia.cat>
 * @copyright FinBlocks
 *
 * @version 1.0.0
 * @since   1.0.0
 */
final class WithdrawalsPagination extends AbstractPagination
{
    /**
     * @param string|null $jsonData
     */
    protected function __construct(string $jsonData = null)
    {
        parent::__construct($jsonData);
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
        $model = new self($jsonData);

        $array = json_decode($jsonData, true);

        foreach ($array['_embedded'] as $arrayModel) {
            $itemModel = Withdrawal::createFromPayload(json_encode($arrayModel));

            array_push($model->_embedded, $itemModel);
        }

        return $model;
    }

    /**
     * @return Withdrawal[]
     */
    public function getEmbedded(): array
    {
        return $this->_embedded;
    }
}
