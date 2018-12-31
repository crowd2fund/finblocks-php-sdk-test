<?php

namespace FinBlocks\Tests\Model\KnowYourCustomer;

use FinBlocks\Exception\FinBlocksException;
use FinBlocks\Model\KnowYourCustomer\KnowYourCustomer;
use PHPUnit\Framework\TestCase;

/**
 * @author    David Garcia <me@davidgarcia.cat>
 * @copyright FinBlocks
 *
 * @version 1.0.0
 * @since   1.0.0
 */
class KnowYourCustomerTest extends TestCase
{
    public function testCreateEmptyModelAndSetters()
    {
        $model = KnowYourCustomer::create();
        $model->setDocumentId('documentId');
        $model->setLabel('label');
        $model->setTag('tag');

        $this->assertEquals('documentId', $model->getDocumentId());
        $this->assertEquals('label', $model->getLabel());
        $this->assertEquals('tag', $model->getTag());
    }

    public function testCreateArray()
    {
        $model = KnowYourCustomer::create();

        $array = $model->httpCreate();

        $this->assertCount(3, $array);

        $this->assertArrayHasKey('documentId', $array);
        $this->assertArrayHasKey('label', $array);
        $this->assertArrayHasKey('tag', $array);
    }

    public function testUpdateArray()
    {
        $this->expectException(FinBlocksException::class);

        $model = KnowYourCustomer::create();
        $model->httpUpdate();
    }
}
