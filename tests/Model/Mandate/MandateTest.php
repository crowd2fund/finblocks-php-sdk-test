<?php

namespace FinBlocks\Tests\Model\Mandate;

use FinBlocks\Exception\FinBlocksException;
use FinBlocks\Model\Mandate\Mandate;
use PHPUnit\Framework\TestCase;

/**
 * @author    David Garcia <me@davidgarcia.cat>
 * @copyright FinBlocks
 *
 * @version 1.0.0
 * @since   1.0.0
 */
class MandateTest extends TestCase
{
    public function testCreateEmptyModelAndSetters()
    {
        $model = Mandate::create();
        $model->setBankAccountId('12345678');
        $model->setLabel('label');
        $model->setTag('tag');

        // There's no getter for the return URL, please run testCreateArray() test for token checks
        $model->setReturnUrl('https://www.domain.com/return-url');

        $this->assertEquals('12345678', $model->getBankAccountId());
        $this->assertEquals('label', $model->getLabel());
        $this->assertEquals('tag', $model->getTag());
    }

    public function testCreateFilledModelFromJsonPayload()
    {
        $model = Mandate::createFromPayload('{
  "id": "1111",
  "bankAccountId": "2222",
  "accountHolderId": "3333",
  "label": "Mandate\'s Label",
  "tag": "Mandate\'s Tag",
  "documentUrl": "Document\'s URL",
  "scheme": "sepa",
  "status": "created",
  "bankReference": "QWERTY",
  "createdAt": "2019-01-02T12:04:07.278Z"
}');

        $this->assertEquals('1111', $model->getId());
        $this->assertEquals('2222', $model->getBankAccountId());
        $this->assertEquals('3333', $model->getAccountHolderId());
        $this->assertEquals('Mandate\'s Label', $model->getLabel());
        $this->assertEquals('Mandate\'s Tag', $model->getTag());
        $this->assertEquals('Document\'s URL', $model->getDocumentUrl());
        $this->assertEquals('sepa', $model->getScheme());
        $this->assertEquals('created', $model->getStatus());
        $this->assertEquals('QWERTY', $model->getBankReference());

        $this->assertInstanceOf(\DateTime::class, $model->getCreatedAt());

        $this->assertEquals('2019-01-02 12:04:07', $model->getCreatedAt()->format('Y-m-d H:i:s'));
    }

    public function testCreateFilledModelFromWrongJsonPayload()
    {
        $this->expectException(FinBlocksException::class);

        Mandate::createFromPayload('This is not a JSON payload');
    }

    public function testCreateArray()
    {
        $model = Mandate::create();
        $model->setReturnUrl('https://www.domain.com/return-url');

        $array = $model->httpCreate();

        $this->assertCount(4, $array);

        $this->assertArrayHasKey('bankAccountId', $array);
        $this->assertArrayHasKey('returnUrl', $array);
        $this->assertArrayHasKey('label', $array);
        $this->assertArrayHasKey('tag', $array);

        $this->assertEquals('https://www.domain.com/return-url', $array['returnUrl']);
    }

    public function testUpdateArray()
    {
        $this->expectException(FinBlocksException::class);

        $model = Mandate::create();
        $model->httpUpdate();
    }
}
