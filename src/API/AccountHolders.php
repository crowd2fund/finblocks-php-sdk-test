<?php

namespace FinBlocks\API;

use FinBlocks\Client\HttpResponse;
use FinBlocks\Exception\FinBlocksException;
use FinBlocks\Exception\HttpClientException;
use FinBlocks\Exception\SerializerException;
use FinBlocks\Model\AccountHolder\AbstractAccountHolder;
use FinBlocks\Model\AccountHolder\AccountHolderBusiness;
use FinBlocks\Model\AccountHolder\AccountHolderIndividual;
use FinBlocks\Model\Pagination\AccountHoldersPagination;
use Webmozart\Assert\Assert;

/**
 * @author    David Garcia <me@davidgarcia.cat>
 * @copyright FinBlocks
 *
 * @version 1.0.0
 * @since   1.0.0
 */
class AccountHolders extends AbstractHttpApi
{
    /**
     * Retrieves a collection of Account Holders.
     *
     * @param int $page
     * @param int $perPage
     *
     * @throws FinBlocksException
     *
     * @return AccountHoldersPagination
     */
    public function list(int $page = 1, int $perPage = 20): AccountHoldersPagination
    {
        try {
            Assert::integer($page, '`page` argument must be an integer');
            Assert::greaterThanEq($page, 1, '`page` argument must be greater than or equal to 1');

            Assert::integer($perPage, '`perPage` argument must be an integer');
            Assert::greaterThanEq($perPage, 1, '`perPage` argument must be greater than or equal to 1');
            Assert::lessThanEq($perPage, 100, '`perPage` argument must be less than or equal to 100');

            $offset = (($page - 1) * $perPage);

            $httpResponse = $this->httpGet('/account-holders', ['offset' => $offset, 'perPage' => $perPage]);

            // TODO: REMOVE THIS LINE, DUE TO IS JUST FOR TESTING REASONS
            ////$httpResponse = new HttpResponse(200, '{"total":0,"_links":{"self":"string","first":"string","prev":"string","next":"string","last":"string"},"_embedded":[{"id":"1","type":"individual","email":"individual@johnpublic.com","label":"John Q. Public","tag":"Individual Test User","givenName":"John","middleName":"Q.","familyName":"Public","dateOfBirth":"1985-04-23T14:52:27.796Z","nationality":"GBR","occupation":"Unknown","incomeRange":6,"kyc":"restricted","address":{"flatNumber":"3","buildingNumber":"28","buildingName":"n/a","street":"Ely Place","subStreet":"N/A","town":"London","state":"England","postcode":"EC1N 6TD","country":"GBR"}},{"id":"1","type":"business","email":"individual@johnpublic.com","label":"John Q. Public","tag":"Business Test User","givenName":"John","middleName":"Q.","familyName":"Public","dateOfBirth":"1985-04-23T14:52:27.796Z","nationality":"GBR","occupation":"CEO","incomeRange":6,"kyc":"restricted","address":{"flatNumber":"3","buildingNumber":"28","buildingName":"n/a","street":"Ely Place","subStreet":"N/A","town":"London","state":"England","postcode":"EC1N 6TD","country":"GBR"},"company":{"number":"0000000000","name":"John Q. Public LTD","email":"info@johnpublic.com","type":"business","address":{"flatNumber":"3","buildingNumber":"28","buildingName":"n/a","street":"Ely Place","subStreet":"N/A","town":"London","state":"England","postcode":"EC1N 6TD","country":"GBR"}}}]}');

            return $this->hydrateResponse($httpResponse, AccountHoldersPagination::class);
        } catch (\Throwable $throwable) {
            throw new FinBlocksException($throwable->getMessage(), $throwable->getCode(), $throwable);
        }
    }

    /**
     * Creates an Account Holder.
     *
     * @param AbstractAccountHolder $accountHolder
     *
     * @throws FinBlocksException
     *
     * @return AbstractAccountHolder
     */
    public function create(AbstractAccountHolder $accountHolder): AbstractAccountHolder
    {
        try {
            switch ($accountHolder->getType()) {
                case AccountHolderIndividual::TYPE:
                    $model = AccountHolderIndividual::class;
                    $endpoint = '/account-holders/individual';
                    break;
                case AccountHolderBusiness::TYPE:
                    $model = AccountHolderBusiness::class;
                    $endpoint = '/account-holders/business';
                    break;
            }

            $httpResponse = $this->httpPost($endpoint, $accountHolder->httpCreate());

            return $this->hydrateResponse($httpResponse, $model);
        } catch (\Throwable $throwable) {
            throw new FinBlocksException($throwable->getMessage(), $throwable->getCode(), $throwable);
        }
    }

    /**
     * Retrieves an Account Holder.
     *
     * @param string $accountHolderId
     *
     * @throws FinBlocksException
     *
     * @return AbstractAccountHolder
     */
    public function show(string $accountHolderId): AbstractAccountHolder
    {
        try {
            Assert::stringNotEmpty($accountHolderId, '`accountHolderId` argument must be a not empty string');

            $httpResponse = $this->httpGet(sprintf('/account-holders/%s', $accountHolderId));

            $arrayResponse = json_decode($httpResponse->getBody(), true);

            if (JSON_ERROR_NONE !== json_last_error()) {
                throw new SerializerException(json_last_error_msg(), json_last_error());
            }

            $arrayResponse['type'] = $arrayResponse['type'] ?? null;

            switch ($arrayResponse['type']) {
                case AccountHolderIndividual::TYPE:
                    $model = AccountHolderIndividual::class;
                    break;
                case AccountHolderBusiness::TYPE:
                    $model = AccountHolderBusiness::class;
                    break;
                default:
                    $model = 'unknown';
            }

            return $this->hydrateResponse($httpResponse, $model);
        } catch (\Throwable $throwable) {
            throw new FinBlocksException($throwable->getMessage(), $throwable->getCode(), $throwable);
        }
    }

    /**
     * Updates an Account Holder.
     *
     * @param AbstractAccountHolder $accountHolder
     *
     * @throws FinBlocksException
     *
     * @return AbstractAccountHolder
     */
    public function update(AbstractAccountHolder $accountHolder): AbstractAccountHolder
    {
        try {
            switch ($accountHolder->getType()) {
                case AccountHolderIndividual::TYPE:
                    $model = AccountHolderIndividual::class;
                    $endpoint = '/account-holders/individual/%s';
                    break;
                case AccountHolderBusiness::TYPE:
                    $model = AccountHolderBusiness::class;
                    $endpoint = '/account-holders/business/%s';
                    break;
            }

            $httpResponse = $this->httpPut(sprintf($endpoint, $accountHolder->getId()), $accountHolder->httpUpdate());

            // TODO: REMOVE THIS LINE, DUE TO IS JUST FOR TESTING REASONS
            /* if ($accountHolder instanceof AccountHolderIndividual) {
                $httpResponse = new HttpResponse(201, '{"id":"1","type":"individual","email":"individual@johnpublic.com","label":"New Label for Individual","tag":"Individual Test User","givenName":"John","middleName":"Q.","familyName":"Public","dateOfBirth":"1985-04-23T14:52:27.796Z","nationality":"GBR","occupation":"Unknown","incomeRange":6,"kyc":"restricted","address":{"flatNumber":"3","buildingNumber":"28","buildingName":"n/a","street":"Ely Place","subStreet":"N/A","town":"London","state":"England","postcode":"EC1N 6TD","country":"GBR"}}');
            } else {
                $httpResponse = new HttpResponse(201, '{"id":"1","type":"business","email":"individual@johnpublic.com","label":"New Label for Business","tag":"Business Test User","givenName":"John","middleName":"Q.","familyName":"Public","dateOfBirth":"1985-04-23T14:52:27.796Z","nationality":"GBR","occupation":"CEO","incomeRange":6,"kyc":"restricted","address":{"flatNumber":"3","buildingNumber":"28","buildingName":"n/a","street":"Ely Place","subStreet":"N/A","town":"London","state":"England","postcode":"EC1N 6TD","country":"GBR"},"company":{"number":"0000000000","name":"John Q. Public LTD","email":"info@johnpublic.com","type":"business","address":{"flatNumber":"3","buildingNumber":"28","buildingName":"n/a","street":"Ely Place","subStreet":"N/A","town":"London","state":"England","postcode":"EC1N 6TD","country":"GBR"}}}');
            } */

            return $this->hydrateResponse($httpResponse, $model);
        } catch (\Throwable $throwable) {
            throw new FinBlocksException($throwable->getMessage(), $throwable->getCode(), $throwable);
        }
    }
}
