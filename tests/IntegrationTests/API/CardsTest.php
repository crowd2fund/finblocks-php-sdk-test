<?php

/*
 * This file is part of FinBlocks PHP SDK.
 *
 * Copyright (C) 2018 FinBlocks Ltd.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace FinBlocks\Tests\IntegrationTests\API;

use FinBlocks\Client\HttpResponse;
use FinBlocks\Exception\FinBlocksException;
use FinBlocks\Model\Card\Card;
use FinBlocks\Model\Pagination\CardsPagination;
use FinBlocks\Tests\Traits\AccountHolderTrait;
use FinBlocks\Tests\Traits\CardTrait;

/**
 * @author    David Garcia <me@davidgarcia.cat>
 * @copyright FinBlocks
 *
 * @version 1.0.0
 *
 * @since   1.0.0
 */
class CardsTest extends AbstractApiTests
{
    use AccountHolderTrait;
    use CardTrait;

    public function testCreateVaultedCard()
    {
        $accountHolder = $this->traitCreateAccountHolderIndividualModel($this->finBlocks);
        $accountHolder = $this->finBlocks->api()->accountHolders()->create($accountHolder);

        $card = $this->traitCreateCardModel($this->finBlocks, $accountHolder->getId());
        $card = $this->finBlocks->api()->cards()->create($card);

        $this->assertInstanceOf(Card::class, $card);
        $this->assertInstanceOf(\DateTime::class, $card->getCreatedAt());
        $this->assertInstanceOf(\DateTime::class, $card->getEndDate());

        $this->assertNotEmpty($card->getId());
        $this->assertNotEmpty($card->getFunding());

        $this->assertEquals($accountHolder->getId(), $card->getAccountHolderId());
        $this->assertEquals('Visa Debit', $card->getIssuer());
        $this->assertEquals('3436', $card->getLastFour());
        $this->assertEquals('Debit', $card->getFunding());
        $this->assertEquals('2020-12-31 23:59:59', $card->getEndDate()->format('Y-m-d H:i:s'));
        $this->assertEquals('Card\'s Label', $card->getLabel());
        $this->assertEquals('Card\'s Tag', $card->getTag());
        $this->assertEquals('FR', $card->getCountry());
        $this->assertEquals('Credit Industriel Et Commercial', $card->getBank());

        $this->assertTrue($card->isActive());

        $reloadedCard = $this->finBlocks->api()->cards()->show($card->getId());

        $this->assertInstanceOf(Card::class, $card);

        $this->assertEquals($card->getId(), $reloadedCard->getId());
    }

    public function testCreateVaultedCardWithInvalidToken()
    {
        $accountHolder = $this->traitCreateAccountHolderIndividualModel($this->finBlocks);
        $accountHolder = $this->finBlocks->api()->accountHolders()->create($accountHolder);

        $card = $this->traitCreateCardModel($this->finBlocks, $accountHolder->getId());
        $card->setToken(base64_encode('invalid-token'));

        $this->expectException(FinBlocksException::class);
        //TODO: Re-enable the following line to validate the expected HTTP Status Code
        // $this->expectExceptionCode(HttpResponse::NOT_FOUND);

        $this->finBlocks->api()->cards()->create($card);
    }

    public function testGetNonExistingCard()
    {
        $this->expectException(FinBlocksException::class);
        $this->expectExceptionCode(HttpResponse::NOT_FOUND);

        $this->finBlocks->api()->cards()->show('dummy-card-id');
    }

    public function testDeactivateCard()
    {
        $this->markTestSkipped('Not yet implemented');

        $accountHolder = $this->traitCreateAccountHolderIndividualModel($this->finBlocks);
        $accountHolder = $this->finBlocks->api()->accountHolders()->create($accountHolder);

        $card = $this->traitCreateCardModel($this->finBlocks, $accountHolder->getId());
        $card = $this->finBlocks->api()->cards()->create($card);

        $this->assertInstanceOf(Card::class, $card);

        $this->finBlocks->api()->cards()->deactivate($card->getId());

        $deactivatedCard = $this->finBlocks->api()->cards()->show($card->getId());

        $this->assertEquals(false, $deactivatedCard->isActive());

        $this->expectException(FinBlocksException::class);
        $this->expectExceptionCode(HttpResponse::BAD_REQUEST);

        $this->finBlocks->api()->cards()->deactivate($card->getId());
    }

    public function testDeactivateNonExistingCard()
    {
        $this->expectException(FinBlocksException::class);
        $this->expectExceptionCode(HttpResponse::NOT_FOUND);

        $this->finBlocks->api()->cards()->deactivate('dummy-card-id');
    }

    public function testPaginatedCards()
    {
        $accountHolder1 = $this->finBlocks->api()->accountHolders()->create($this->traitCreateAccountHolderIndividualModel($this->finBlocks));
        $accountHolder2 = $this->finBlocks->api()->accountHolders()->create($this->traitCreateAccountHolderIndividualModel($this->finBlocks));

        $this->finBlocks->api()->cards()->create($this->traitCreateCardModel($this->finBlocks, $accountHolder1->getId()));
        $this->finBlocks->api()->cards()->create($this->traitCreateCardModel($this->finBlocks, $accountHolder2->getId()));

        $this->markTestSkipped('Not yet implemented');

        $cards = $this->finBlocks->api()->cards()->list(1, 2);

        $this->assertInstanceOf(CardsPagination::class, $cards);

        $this->assertGreaterThanOrEqual(2, $cards->getTotal());

        $this->assertCount(2, $cards->getItems());
    }

    public function testPaginatedCardsWithInvalidPage()
    {
        $this->expectException(FinBlocksException::class);

        $this->finBlocks->api()->cards()->list(-1);
    }

    public function testPaginatedCardsWithLowerPerPage()
    {
        $this->expectException(FinBlocksException::class);

        $this->finBlocks->api()->cards()->list(1, -1);
    }

    public function testPaginatedCardsWithGreaterPerPage()
    {
        $this->expectException(FinBlocksException::class);

        $this->finBlocks->api()->cards()->list(1, 10000);
    }

    public function testPaginatedCardsByAccountHolder()
    {
        $accountHolder1 = $this->finBlocks->api()->accountHolders()->create($this->traitCreateAccountHolderIndividualModel($this->finBlocks));
        $accountHolder2 = $this->finBlocks->api()->accountHolders()->create($this->traitCreateAccountHolderIndividualModel($this->finBlocks));

        $this->finBlocks->api()->cards()->create($this->traitCreateCardModel($this->finBlocks, $accountHolder1->getId()));
        $this->finBlocks->api()->cards()->create($this->traitCreateCardModel($this->finBlocks, $accountHolder2->getId()));

        $this->markTestSkipped('Not yet implemented');

        $cards1 = $this->finBlocks->api()->cards()->listByAccountHolder($accountHolder1->getId());
        $cards2 = $this->finBlocks->api()->cards()->listByAccountHolder($accountHolder2->getId());

        $this->assertInstanceOf(CardsPagination::class, $cards1);
        $this->assertInstanceOf(CardsPagination::class, $cards2);

        $this->assertEquals(1, $cards1->getTotal());
        $this->assertEquals(1, $cards2->getTotal());

        $this->assertCount(1, $cards1->getItems());
        $this->assertCount(1, $cards2->getItems());
    }

    public function testPaginatedCardsByAccountHolderWithInvalidPage()
    {
        $this->expectException(FinBlocksException::class);

        $this->finBlocks->api()->cards()->listByAccountHolder('id', -1);
    }

    public function testPaginatedCardsByAccountHolderWithLowerPerPage()
    {
        $this->expectException(FinBlocksException::class);

        $this->finBlocks->api()->cards()->listByAccountHolder('id', 1, -1);
    }

    public function testPaginatedCardsByAccountHolderWithGreaterPerPage()
    {
        $this->expectException(FinBlocksException::class);

        $this->finBlocks->api()->cards()->listByAccountHolder('id', 1, 10000);
    }
}
