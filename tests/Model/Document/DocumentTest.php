<?php

namespace FinBlocks\Tests\Model\Document;

use FinBlocks\Exception\FinBlocksException;
use FinBlocks\Model\Document\DocumentIdCard;
use FinBlocks\Model\Document\DocumentPassport;
use PHPUnit\Framework\TestCase;

/**
 * @author    David Garcia <me@davidgarcia.cat>
 * @copyright FinBlocks
 *
 * @version 1.0.0
 * @since   1.0.0
 */
class DocumentTest extends TestCase
{
    public function testCreateEmptyModelAndSettersForIdCard()
    {
        $model = DocumentIdCard::create();
        $model->setAccountHolderId('12345678');
        $model->setLabel('label');
        $model->setTag('tag');

        $this->assertEquals('12345678', $model->getAccountHolderId());
        $this->assertEquals('label', $model->getLabel());
        $this->assertEquals('tag', $model->getTag());
    }

    public function testCreateArrayForIdCard()
    {
        $model = DocumentIdCard::create();
        $model->setFront('front');
        $model->setBack('back');

        $array = $model->httpCreate();

        $this->assertCount(5, $array);
        $this->assertArrayHasKey('accountHolderId', $array);
        $this->assertArrayHasKey('label', $array);
        $this->assertArrayHasKey('tag', $array);
        $this->assertArrayHasKey('front', $array);
        $this->assertArrayHasKey('back', $array);
    }

    public function testUpdateArrayForIdCard()
    {
        $this->expectException(FinBlocksException::class);

        $model = DocumentIdCard::create();
        $model->httpUpdate();
    }

    public function testCreateEmptyModelAndSettersForPassport()
    {
        $model = DocumentPassport::create();
        $model->setAccountHolderId('12345678');
        $model->setLabel('label');
        $model->setTag('tag');

        $this->assertEquals('12345678', $model->getAccountHolderId());
        $this->assertEquals('label', $model->getLabel());
        $this->assertEquals('tag', $model->getTag());
    }

    public function testCreateArrayForPassport()
    {
        $model = DocumentPassport::create();
        $model->setFront('front');

        $array = $model->httpCreate();

        $this->assertCount(4, $array);
        $this->assertArrayHasKey('accountHolderId', $array);
        $this->assertArrayHasKey('label', $array);
        $this->assertArrayHasKey('tag', $array);
        $this->assertArrayHasKey('front', $array);
    }

    public function testUpdateArrayForPassport()
    {
        $this->expectException(FinBlocksException::class);

        $model = DocumentPassport::create();
        $model->httpUpdate();
    }
}
