<?php

namespace FinBlocks\Tests\Model\Pagination;

use FinBlocks\Exception\FinBlocksException;
use FinBlocks\Model\Pagination;
use FinBlocks\Model;
use PHPUnit\Framework\TestCase;

/**
 * @author    David Garcia <me@davidgarcia.cat>
 * @copyright FinBlocks
 *
 * @version 1.0.0
 * @since   1.0.0
 */
class PaginationTest extends TestCase
{
    public function testCreateEmptyModelAccountHoldersPagination()
    {
        $model = Pagination\AccountHoldersPagination::create();

        $this->assertInstanceOf(Pagination\Links::class, $model->getLinks());

        $this->assertInternalType('string', $model->getLinks()->getSelf());
        $this->assertInternalType('string', $model->getLinks()->getFirst());
        $this->assertInternalType('string', $model->getLinks()->getPrev());
        $this->assertInternalType('string', $model->getLinks()->getNext());
        $this->assertInternalType('string', $model->getLinks()->getLast());

        $this->assertInternalType('integer', $model->getTotal());
        $this->assertInternalType('array', $model->getEmbedded());

        $this->assertEquals(0, $model->getTotal());
        $this->assertEquals([], $model->getEmbedded());
    }

    public function testCreateEmptyModelBankAccountsPagination()
    {
        $model = Pagination\BankAccountsPagination::create();

        $this->assertInstanceOf(Pagination\Links::class, $model->getLinks());

        $this->assertInternalType('string', $model->getLinks()->getSelf());
        $this->assertInternalType('string', $model->getLinks()->getFirst());
        $this->assertInternalType('string', $model->getLinks()->getPrev());
        $this->assertInternalType('string', $model->getLinks()->getNext());
        $this->assertInternalType('string', $model->getLinks()->getLast());

        $this->assertInternalType('integer', $model->getTotal());
        $this->assertInternalType('array', $model->getEmbedded());

        $this->assertEquals(0, $model->getTotal());
        $this->assertEquals([], $model->getEmbedded());
    }

    public function testCreateEmptyModelCardsPagination()
    {
        $model = Pagination\CardsPagination::create();

        $this->assertInstanceOf(Pagination\Links::class, $model->getLinks());

        $this->assertInternalType('string', $model->getLinks()->getSelf());
        $this->assertInternalType('string', $model->getLinks()->getFirst());
        $this->assertInternalType('string', $model->getLinks()->getPrev());
        $this->assertInternalType('string', $model->getLinks()->getNext());
        $this->assertInternalType('string', $model->getLinks()->getLast());

        $this->assertInternalType('integer', $model->getTotal());
        $this->assertInternalType('array', $model->getEmbedded());

        $this->assertEquals(0, $model->getTotal());
        $this->assertEquals([], $model->getEmbedded());
    }

    public function testCreateEmptyModelCardsPaginationFromPayload()
    {
        $model = Pagination\CardsPagination::createFromPayload('{
  "total": 0,
  "_links": {
    "self": "string",
    "first": "string",
    "prev": "string",
    "next": "string",
    "last": "string"
  },
  "_embedded": [
    {
      "id": "string",
      "accountHolderId": "string",
      "label": "string",
      "tag": "string",
      "lastFour": "string",
      "status": "pending",
      "createdAt": "2019-01-03T17:01:16.982Z",
      "expiresAt": "2019-01-03T17:01:16.982Z"
    }
  ]
}');

        $this->assertInstanceOf(Pagination\Links::class, $model->getLinks());

        $this->assertCount(1, $model->getEmbedded());

        $this->assertInstanceOf(Model\Card\Card::class, $model->getEmbedded()[0]);
    }

    public function testCreateEmptyModelDepositsPagination()
    {
        $model = Pagination\DepositsPagination::create();

        $this->assertInstanceOf(Pagination\Links::class, $model->getLinks());

        $this->assertInternalType('string', $model->getLinks()->getSelf());
        $this->assertInternalType('string', $model->getLinks()->getFirst());
        $this->assertInternalType('string', $model->getLinks()->getPrev());
        $this->assertInternalType('string', $model->getLinks()->getNext());
        $this->assertInternalType('string', $model->getLinks()->getLast());

        $this->assertInternalType('integer', $model->getTotal());
        $this->assertInternalType('array', $model->getEmbedded());

        $this->assertEquals(0, $model->getTotal());
        $this->assertEquals([], $model->getEmbedded());
    }

    public function testCreateEmptyModelDocumentsPagination()
    {
        $model = Pagination\DocumentsPagination::create();

        $this->assertInstanceOf(Pagination\Links::class, $model->getLinks());

        $this->assertInternalType('string', $model->getLinks()->getSelf());
        $this->assertInternalType('string', $model->getLinks()->getFirst());
        $this->assertInternalType('string', $model->getLinks()->getPrev());
        $this->assertInternalType('string', $model->getLinks()->getNext());
        $this->assertInternalType('string', $model->getLinks()->getLast());

        $this->assertInternalType('integer', $model->getTotal());
        $this->assertInternalType('array', $model->getEmbedded());

        $this->assertEquals(0, $model->getTotal());
        $this->assertEquals([], $model->getEmbedded());
    }

    public function testCreateEmptyModelKnowYourCustomersPagination()
    {
        $model = Pagination\KnowYourCustomersPagination::create();

        $this->assertInstanceOf(Pagination\Links::class, $model->getLinks());

        $this->assertInternalType('string', $model->getLinks()->getSelf());
        $this->assertInternalType('string', $model->getLinks()->getFirst());
        $this->assertInternalType('string', $model->getLinks()->getPrev());
        $this->assertInternalType('string', $model->getLinks()->getNext());
        $this->assertInternalType('string', $model->getLinks()->getLast());

        $this->assertInternalType('integer', $model->getTotal());
        $this->assertInternalType('array', $model->getEmbedded());

        $this->assertEquals(0, $model->getTotal());
        $this->assertEquals([], $model->getEmbedded());
    }

    public function testCreateEmptyModelKnowYourCustomersPaginationFromPayload()
    {
        $model = Pagination\KnowYourCustomersPagination::createFromPayload('{
  "total": 0,
  "_links": {
    "self": "string",
    "first": "string",
    "prev": "string",
    "next": "string",
    "last": "string"
  },
  "_embedded": [
    {
      "id": "string",
      "documentId": "string",
      "status": "pending",
      "refusedReason": "string",
      "label": "string",
      "tag": "string",
      "createdAt": "2019-01-03T17:00:59.549Z",
      "processedAt": "2019-01-03T17:00:59.549Z"
    }
  ]
}');

        $this->assertInstanceOf(Pagination\Links::class, $model->getLinks());

        $this->assertCount(1, $model->getEmbedded());

        $this->assertInstanceOf(Model\KnowYourCustomer\KnowYourCustomer::class, $model->getEmbedded()[0]);
    }

    public function testCreateEmptyModelMandatesPagination()
    {
        $model = Pagination\MandatesPagination::create();

        $this->assertInstanceOf(Pagination\Links::class, $model->getLinks());

        $this->assertInternalType('string', $model->getLinks()->getSelf());
        $this->assertInternalType('string', $model->getLinks()->getFirst());
        $this->assertInternalType('string', $model->getLinks()->getPrev());
        $this->assertInternalType('string', $model->getLinks()->getNext());
        $this->assertInternalType('string', $model->getLinks()->getLast());

        $this->assertInternalType('integer', $model->getTotal());
        $this->assertInternalType('array', $model->getEmbedded());

        $this->assertEquals(0, $model->getTotal());
        $this->assertEquals([], $model->getEmbedded());
    }

    public function testCreateEmptyModelMandatesPaginationFromPayload()
    {
        $model = Pagination\MandatesPagination::createFromPayload('{
  "total": 0,
  "_links": {
    "self": "string",
    "first": "string",
    "prev": "string",
    "next": "string",
    "last": "string"
  },
  "_embedded": [
    {
      "id": "string",
      "bankAccountId": "string",
      "accountHolderId": "string",
      "label": "string",
      "tag": "string",
      "documentUrl": "string",
      "scheme": "sepa",
      "status": "created",
      "bankReference": "string",
      "createdAt": "2019-01-03T16:58:43.465Z"
    }
  ]
}');

        $this->assertInstanceOf(Pagination\Links::class, $model->getLinks());

        $this->assertCount(1, $model->getEmbedded());

        $this->assertInstanceOf(Model\Mandate\Mandate::class, $model->getEmbedded()[0]);
    }

    public function testCreateEmptyModelRefundsPagination()
    {
        $model = Pagination\RefundsPagination::create();

        $this->assertInstanceOf(Pagination\Links::class, $model->getLinks());

        $this->assertInternalType('string', $model->getLinks()->getSelf());
        $this->assertInternalType('string', $model->getLinks()->getFirst());
        $this->assertInternalType('string', $model->getLinks()->getPrev());
        $this->assertInternalType('string', $model->getLinks()->getNext());
        $this->assertInternalType('string', $model->getLinks()->getLast());

        $this->assertInternalType('integer', $model->getTotal());
        $this->assertInternalType('array', $model->getEmbedded());

        $this->assertEquals(0, $model->getTotal());
        $this->assertEquals([], $model->getEmbedded());
    }

    public function testCreateEmptyModelRefundsPaginationFromPayload()
    {
        $model = Pagination\RefundsPagination::createFromPayload('{
  "total": 0,
  "_links": {
    "self": "string",
    "first": "string",
    "prev": "string",
    "next": "string",
    "last": "string"
  },
  "_embedded": [
    {
      "id": "string",
      "status": "string",
      "nature": "refund",
      "label": "string",
      "tag": "string",
      "debitedWalletId": "string",
      "creditedWalletId": "string",
      "debitedFunds": {
        "currency": "GBP",
        "amount": 0
      },
      "creditedFunds": {
        "currency": "GBP",
        "amount": 0
      },
      "fees": {
        "currency": "GBP",
        "amount": 0
      },
      "createdAt": "2019-01-03T16:57:45.787Z",
      "executedAt": "2019-01-03T16:57:45.787Z"
    }
  ]
}');

        $this->assertInstanceOf(Pagination\Links::class, $model->getLinks());

        $this->assertCount(1, $model->getEmbedded());

        $this->assertInstanceOf(Model\Refund\Refund::class, $model->getEmbedded()[0]);
    }

    public function testCreateEmptyModelStatementsPagination()
    {
        $model = Pagination\StatementsPagination::create();

        $this->assertInstanceOf(Pagination\Links::class, $model->getLinks());

        $this->assertInternalType('string', $model->getLinks()->getSelf());
        $this->assertInternalType('string', $model->getLinks()->getFirst());
        $this->assertInternalType('string', $model->getLinks()->getPrev());
        $this->assertInternalType('string', $model->getLinks()->getNext());
        $this->assertInternalType('string', $model->getLinks()->getLast());

        $this->assertInternalType('integer', $model->getTotal());
        $this->assertInternalType('array', $model->getEmbedded());

        $this->assertEquals(0, $model->getTotal());
        $this->assertEquals([], $model->getEmbedded());
    }

    public function testCreateEmptyModelStatementsPaginationFromPayload()
    {
        $model = Pagination\StatementsPagination::createFromPayload('{
  "total": 0,
  "_links": {
    "self": "string",
    "first": "string",
    "prev": "string",
    "next": "string",
    "last": "string"
  },
  "_embedded": [
    {
      "id": "string",
      "type": "bankWire",
      "nature": "deposit",
      "status": "created",
      "creditedWalletId": "string",
      "createdAt": "2019-01-03T17:15:57.518Z",
      "executedAt": "2019-01-03T17:15:57.518Z",
      "billingAddress": {
        "flatNumber": "string",
        "buildingNumber": "string",
        "buildingName": "string",
        "street": "string",
        "subStreet": "string",
        "town": "string",
        "state": "string",
        "postcode": "string",
        "country": "string"
      },
      "debitedFunds": {
        "currency": "GBP",
        "amount": 0
      },
      "creditedFunds": {
        "currency": "GBP",
        "amount": 0
      },
      "fees": {
        "currency": "GBP",
        "amount": 0
      },
      "declaredDebitedFunds": {
        "currency": "GBP",
        "amount": 0
      },
      "declaredFees": {
        "currency": "GBP",
        "amount": 0
      },
      "wireReference": "string"
    },
    {
      "id": "string",
      "type": "card",
      "nature": "deposit",
      "status": "created",
      "creditedWalletId": "string",
      "createdAt": "2019-01-03T17:15:57.518Z",
      "executedAt": "2019-01-03T17:15:57.518Z",
      "billingAddress": {
        "flatNumber": "string",
        "buildingNumber": "string",
        "buildingName": "string",
        "street": "string",
        "subStreet": "string",
        "town": "string",
        "state": "string",
        "postcode": "string",
        "country": "string"
      },
      "debitedFunds": {
        "currency": "GBP",
        "amount": 0
      },
      "creditedFunds": {
        "currency": "GBP",
        "amount": 0
      },
      "fees": {
        "currency": "GBP",
        "amount": 0
      },
      "cardId": "string",
      "secureMode": false
    },
    {
      "id": "string",
      "type": "directDebit",
      "nature": "deposit",
      "status": "created",
      "creditedWalletId": "string",
      "createdAt": "2019-01-03T17:15:57.518Z",
      "executedAt": "2019-01-03T17:15:57.518Z",
      "billingAddress": {
        "flatNumber": "string",
        "buildingNumber": "string",
        "buildingName": "string",
        "street": "string",
        "subStreet": "string",
        "town": "string",
        "state": "string",
        "postcode": "string",
        "country": "string"
      },
      "debitedFunds": {
        "currency": "GBP",
        "amount": 0
      },
      "creditedFunds": {
        "currency": "GBP",
        "amount": 0
      },
      "fees": {
        "currency": "GBP",
        "amount": 0
      },
      "mandateId": "string"
    },
    {
      "id": "string",
      "status": "string",
      "nature": "refund",
      "label": "string",
      "tag": "string",
      "debitedWalletId": "string",
      "creditedWalletId": "string",
      "debitedFunds": {
        "currency": "GBP",
        "amount": 0
      },
      "creditedFunds": {
        "currency": "GBP",
        "amount": 0
      },
      "fees": {
        "currency": "GBP",
        "amount": 0
      },
      "createdAt": "2019-01-03T17:15:57.518Z",
      "executedAt": "2019-01-03T17:15:57.518Z"
    },
    {
      "id": "string",
      "status": "string",
      "nature": "transfer",
      "label": "string",
      "tag": "string",
      "debitedWalletId": "string",
      "creditedWalletId": "string",
      "debitedFunds": {
        "currency": "GBP",
        "amount": 0
      },
      "creditedFunds": {
        "currency": "GBP",
        "amount": 0
      },
      "fees": {
        "currency": "GBP",
        "amount": 0
      },
      "createdAt": "2019-01-03T17:15:57.518Z",
      "executedAt": "2019-01-03T17:15:57.518Z"
    },
    {
      "id": "string",
      "label": "string",
      "tag": "string",
      "status": "created",
      "nature": "withdrawal",
      "walletId": "string",
      "bankAccountId": "string",
      "bankWireReference": "string",
      "debitedFunds": {
        "currency": "GBP",
        "amount": 0
      },
      "fees": {
        "currency": "GBP",
        "amount": 0
      },
      "createdAt": "2019-01-03T17:15:57.518Z",
      "executedAt": "2019-01-03T17:15:57.518Z"
    }
  ]
}');

        $this->assertInstanceOf(Pagination\Links::class, $model->getLinks());

        $this->assertCount(6, $model->getEmbedded());

        $this->assertInstanceOf(Model\Deposit\DepositBankWire::class, $model->getEmbedded()[0]);
        $this->assertInstanceOf(Model\Deposit\DepositCard::class, $model->getEmbedded()[1]);
        $this->assertInstanceOf(Model\Deposit\DepositDirectDebit::class, $model->getEmbedded()[2]);
        $this->assertInstanceOf(Model\Refund\Refund::class, $model->getEmbedded()[3]);
        $this->assertInstanceOf(Model\Transfer\Transfer::class, $model->getEmbedded()[4]);
        $this->assertInstanceOf(Model\Withdrawal\Withdrawal::class, $model->getEmbedded()[5]);
    }

    public function testCreateModelStatementsPaginationForUnknownNatureFromPayload()
    {
        $this->expectException(FinBlocksException::class);

        Pagination\StatementsPagination::createFromPayload('{
            "total": 0,
            "_links": {
                "self": "string",
                "first": "string",
                "prev": "string",
                "next": "string",
                "last": "string"
            },
            "_embedded": [
                {
                    "id": "string"
                }
            ]
        }');
    }

    public function testCreateModelStatementsPaginationForInvalidNatureFromPayload()
    {
        $this->expectException(FinBlocksException::class);

        Pagination\StatementsPagination::createFromPayload('{
            "total": 0,
            "_links": {
                "self": "string",
                "first": "string",
                "prev": "string",
                "next": "string",
                "last": "string"
            },
            "_embedded": [
                {
                    "id": "string",
                    "nature": "unknown"
                }
            ]
        }');
    }

    public function testCreateModelStatementsPaginationForUnknownDepositTypeFromPayload()
    {
        $this->expectException(FinBlocksException::class);

        Pagination\StatementsPagination::createFromPayload('{
            "total": 0,
            "_links": {
                "self": "string",
                "first": "string",
                "prev": "string",
                "next": "string",
                "last": "string"
            },
            "_embedded": [
                {
                    "id": "string",
                    "nature": "deposit"
                }
            ]
        }');
    }

    public function testCreateModelStatementsPaginationForInvalidDepositFromPayload()
    {
        $this->expectException(FinBlocksException::class);

        Pagination\StatementsPagination::createFromPayload('{
            "total": 0,
            "_links": {
                "self": "string",
                "first": "string",
                "prev": "string",
                "next": "string",
                "last": "string"
            },
            "_embedded": [
                {
                    "id": "string",
                    "type": "unknown",
                    "nature": "deposit"
                }
            ]
        }');
    }

    public function testCreateEmptyModelTransfersPagination()
    {
        $model = Pagination\TransfersPagination::create();

        $this->assertInstanceOf(Pagination\Links::class, $model->getLinks());

        $this->assertInternalType('string', $model->getLinks()->getSelf());
        $this->assertInternalType('string', $model->getLinks()->getFirst());
        $this->assertInternalType('string', $model->getLinks()->getPrev());
        $this->assertInternalType('string', $model->getLinks()->getNext());
        $this->assertInternalType('string', $model->getLinks()->getLast());

        $this->assertInternalType('integer', $model->getTotal());
        $this->assertInternalType('array', $model->getEmbedded());

        $this->assertEquals(0, $model->getTotal());
        $this->assertEquals([], $model->getEmbedded());
    }

    public function testCreateModelTransfersPaginationFromPayload()
    {
        $model = Pagination\TransfersPagination::createFromPayload('{
  "total": 0,
  "_links": {
    "self": "string",
    "first": "string",
    "prev": "string",
    "next": "string",
    "last": "string"
  },
  "_embedded": [
    {
      "id": "string",
      "status": "string",
      "nature": "transfer",
      "label": "string",
      "tag": "string",
      "debitedWalletId": "string",
      "creditedWalletId": "string",
      "debitedFunds": {
        "currency": "GBP",
        "amount": 0
      },
      "creditedFunds": {
        "currency": "GBP",
        "amount": 0
      },
      "fees": {
        "currency": "GBP",
        "amount": 0
      },
      "createdAt": "2019-01-03T16:52:15.220Z",
      "executedAt": "2019-01-03T16:52:15.220Z"
    }
  ]
}');

        $this->assertInstanceOf(Pagination\Links::class, $model->getLinks());

        $this->assertCount(1, $model->getEmbedded());

        $this->assertInstanceOf(Model\Transfer\Transfer::class, $model->getEmbedded()[0]);
    }

    public function testCreateEmptyModelWalletsPagination()
    {
        $model = Pagination\WalletsPagination::create();

        $this->assertInstanceOf(Pagination\Links::class, $model->getLinks());

        $this->assertInternalType('string', $model->getLinks()->getSelf());
        $this->assertInternalType('string', $model->getLinks()->getFirst());
        $this->assertInternalType('string', $model->getLinks()->getPrev());
        $this->assertInternalType('string', $model->getLinks()->getNext());
        $this->assertInternalType('string', $model->getLinks()->getLast());

        $this->assertInternalType('integer', $model->getTotal());
        $this->assertInternalType('array', $model->getEmbedded());

        $this->assertEquals(0, $model->getTotal());
        $this->assertEquals([], $model->getEmbedded());
    }

    public function testCreateModelWalletsPaginationFromPayload()
    {
        $model = Pagination\WalletsPagination::createFromPayload('{
  "total": 0,
  "_links": {
    "self": "string",
    "first": "string",
    "prev": "string",
    "next": "string",
    "last": "string"
  },
  "_embedded": [
    {
      "id": "string",
      "accountHolderId": "string",
      "currency": "GBP",
      "label": "string",
      "tag": "string",
      "balance": {
        "currency": "GBP",
        "amount": 0
      },
      "createdAt": "2019-01-03T16:51:16.471Z"
    }
  ]
}');

        $this->assertInstanceOf(Pagination\Links::class, $model->getLinks());

        $this->assertCount(1, $model->getEmbedded());

        $this->assertInstanceOf(Model\Wallet\Wallet::class, $model->getEmbedded()[0]);
    }

    public function testCreateEmptyModelWithdrawalsPagination()
    {
        $model = Pagination\WithdrawalsPagination::create();

        $this->assertInstanceOf(Pagination\Links::class, $model->getLinks());

        $this->assertInternalType('string', $model->getLinks()->getSelf());
        $this->assertInternalType('string', $model->getLinks()->getFirst());
        $this->assertInternalType('string', $model->getLinks()->getPrev());
        $this->assertInternalType('string', $model->getLinks()->getNext());
        $this->assertInternalType('string', $model->getLinks()->getLast());

        $this->assertInternalType('integer', $model->getTotal());
        $this->assertInternalType('array', $model->getEmbedded());

        $this->assertEquals(0, $model->getTotal());
        $this->assertEquals([], $model->getEmbedded());
    }

    public function testCreateModelWithdrawalsPaginationFromPayload()
    {
        $model = Pagination\WithdrawalsPagination::createFromPayload('{
  "total": 0,
  "_links": {
    "self": "string",
    "first": "string",
    "prev": "string",
    "next": "string",
    "last": "string"
  },
  "_embedded": [
    {
      "id": "string",
      "label": "string",
      "tag": "string",
      "status": "created",
      "nature": "withdrawal",
      "walletId": "string",
      "bankAccountId": "string",
      "bankWireReference": "string",
      "debitedFunds": {
        "currency": "GBP",
        "amount": 0
      },
      "fees": {
        "currency": "GBP",
        "amount": 0
      },
      "createdAt": "2019-01-03T16:34:49.488Z",
      "executedAt": "2019-01-03T16:34:49.488Z"
    }
  ]
}');

        $this->assertInstanceOf(Pagination\Links::class, $model->getLinks());

        $this->assertCount(1, $model->getEmbedded());

        $this->assertInstanceOf(Model\Withdrawal\Withdrawal::class, $model->getEmbedded()[0]);
    }
}
