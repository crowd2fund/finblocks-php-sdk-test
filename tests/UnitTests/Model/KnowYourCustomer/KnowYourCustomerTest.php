<?php

/*
 * This file is part of FinBlocks PHP SDK.
 *
 * Copyright (C) 2018 FinBlocks Ltd.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Finblocks\Tests\UnitTests\Model\KnowYourCustomer;

use FinBlocks\Exception\FinBlocksException;
use FinBlocks\Model\KnowYourCustomer\KnowYourCustomer;
use PHPUnit\Framework\TestCase;

/**
 * @author    David Garcia <me@davidgarcia.cat>
 * @copyright FinBlocks
 *
 * @version 1.0.0
 *
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

    public function testCreateFilledModelFromJsonPayload()
    {
        $model = KnowYourCustomer::createFromPayload('{
            "id": "1111",
            "documentId": "2222",
            "status": "refused",
            "refusedReason": "Expired document",
            "label": "Document\'s Label",
            "tag": "Document\'s Tag",
            "createdAt": "2019-01-02T12:40:21.919Z",
            "processedAt": "2019-01-02T12:40:21.919Z"
        }');

        $this->assertEquals('1111', $model->getId());
        $this->assertEquals('2222', $model->getDocumentId());
        $this->assertEquals('refused', $model->getStatus());
        $this->assertEquals('Expired document', $model->getRefusedReason());
        $this->assertEquals('Document\'s Label', $model->getLabel());
        $this->assertEquals('Document\'s Tag', $model->getTag());

        $this->assertInstanceOf(\DateTime::class, $model->getCreatedAt());
        $this->assertInstanceOf(\DateTime::class, $model->getProcessedAt());

        $this->assertEquals('2019-01-02 12:40:21', $model->getCreatedAt()->format('Y-m-d H:i:s'));
        $this->assertEquals('2019-01-02 12:40:21', $model->getProcessedAt()->format('Y-m-d H:i:s'));
    }

    public function testCreateFilledModelFromWrongJsonPayload()
    {
        $this->expectException(FinBlocksException::class);

        KnowYourCustomer::createFromPayload('This is not a JSON payload');
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
