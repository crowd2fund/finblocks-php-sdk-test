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
    public function testSettersForCardModel()
    {
        $model = new Mandate();
        $model->setBankAccountId('12345678');
        $model->setLabel('label');
        $model->setTag('tag');

        // There's no getter for the return URL, please run testCreateArray() test for token checks
        $model->setReturnUrl('https://www.domain.com/return-url');

        $this->assertEquals('12345678', $model->getBankAccountId());
        $this->assertEquals('label', $model->getLabel());
        $this->assertEquals('tag', $model->getTag());
    }

    public function testCreateArray()
    {
        $model = new Mandate();
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

        $model = new Mandate();
        $model->httpUpdate();
    }
}
