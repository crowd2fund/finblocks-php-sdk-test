# FinBlocks PHP SDK

This is the official's [FinBlocks](https://www.finblocks.net/) PHP SDK.

![PHP Versions](https://img.shields.io/badge/PHP-%3E%3D%207.0%2C%20%3C8.0-1a7cb8.svg)
[![Build Status](https://scrutinizer-ci.com/g/crowd2fund/finblocks-php-sdk/badges/build.png?b=master&s=f6a62b102bd22ff4537f5cd15e8f59038676f8ab)](https://scrutinizer-ci.com/g/crowd2fund/finblocks-php-sdk/build-status/master)
[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/crowd2fund/finblocks-php-sdk/badges/quality-score.png?b=master&s=402d0cea20619454ae161e18ccd41f92b064b88e)](https://scrutinizer-ci.com/g/crowd2fund/finblocks-php-sdk/?branch=master)
[![Code Coverage](https://scrutinizer-ci.com/g/crowd2fund/finblocks-php-sdk/badges/coverage.png?b=master&s=1807a04bcf24071a747e22b7748bfbfedc8454de)](https://scrutinizer-ci.com/g/crowd2fund/finblocks-php-sdk/?branch=master)
[![SymfonyInsight](https://insight.symfony.com/projects/e94f0c04-15ca-4fad-ac02-d63396e42e63/mini.svg)](https://insight.symfony.com/projects/e94f0c04-15ca-4fad-ac02-d63396e42e63)
[![StyleCI](https://github.styleci.io/repos/162704104/shield?branch=master)](https://github.styleci.io/repos/162704104)

# NOT READY FOR PRODUCTION

## Prerequisites

* PHP 7.0 or later
* PHP cURL extension
* PHP JSON extension

## Changelog

All notable changes to this project will be documented in [this file](CHANGELOG.md).

The format is based on [Keep a Changelog](https://keepachangelog.com/en/1.0.0/),
and this project adheres to [Semantic Versioning](https://semver.org/spec/v2.0.0.html).

## Install

Install the SDK through Composer:

```bash
$ composer require finblocks/finblocks-php-sdk
```

## Usage

Make sure that your code has included Composer's autoload:

```php
require 'vendor/autoload.php';
```

Pass the path to your certificates when instantiating the client:

```php
// Include the `use` statement
use FinBlocks\FinBlocks;

// Instantiate the production environment passing the certificates as arguments 
$finBlocksProd = new FinBlocks('path/to/prod/key', 'path/to/prod/cert', 'path/to/prod/ca');

// You can switch to the Sandbox environment just setting `true` as the 4th argument
$finBlocksDev  = new FinBlocks('path/to/dev/key', 'path/to/dev/cert', 'path/to/dev/ca', true);
```

Access to the API resources directly from the client. Here's an example:

```php
// Get the first 20 Account Holders, or other pages when including arguments
$paginatedAccountHolders = $finblocks->api()->accountHolders()->list();
```

Or create new resources instantiating the ones that you need through the built-in factories:

```php
// Use the built-in factories to create empty models
$accountHolder = $finblocks->factories()->accountHolders()->createIndividual();

// Then use the setters for each model to fill them with the expected values
$accountHolder->setEmail('mailbox@domain.com');

// The API Endpoint will return a new object, that you can set to the existing variable
$accountHolder = $finblocks->api()->accountHolders()->createIndividual($accountHolder);
```

You can create any new model that you need easily thanks to the built-in factories. Please note that depending on the model/resource, we provide a `->create()` method but we also might expect a other methods when dealing with discriminator:

```php
$finblocks->factories()->accountHolders(); // Account Holders
$finblocks->factories()->bankAccounts();   // Bank Accounts
$finblocks->factories()->cards();          // Cards
$finblocks->factories()->deposits();       // Deposits
$finblocks->factories()->documents();      // Documents
$finblocks->factories()->kyc();            // KYC
$finblocks->factories()->mandates();       // Mandates
$finblocks->factories()->refunds();        // Refunds
$finblocks->factories()->transfers();      // Transfers
$finblocks->factories()->wallets();        // Wallets
$finblocks->factories()->withdrawals();    // Withdrawals
``` 

All the available API endpoints are provided by this SDK, where we can use methods list, show, create, update or disable resources, according to our API requirements:

```php
$finblocks->api()->accountHolders(); // Account Holders
$finblocks->api()->bankAccounts();   // Bank Accounts
$finblocks->api()->cards();          // Cards
$finblocks->api()->deposits();       // Deposits
$finblocks->api()->documents();      // Documents
$finblocks->api()->hooks();          // Hooks
$finblocks->api()->kyc();            // KYC
$finblocks->api()->mandates();       // Mandates
$finblocks->api()->network();        // Network
$finblocks->api()->refunds();        // Refunds
$finblocks->api()->statements();     // Statements
$finblocks->api()->transfers();      // Transfers
$finblocks->api()->wallets();        // Wallets
$finblocks->api()->withdrawals();    // Withdrawals
```

## Contributing

FinBlocks PHP SDK is an Open Source library, offered under the MIT license. As an Open Source project, we would love to be informed about any potential bug that you might find using it, but we would love to see you being part of the community that can maintain the SDK. 

## Security Issues

FinBlocks takes security very seriously. If you think that you have found a security vulnerability, please don't use a bug tracker or the _Issues_ page. Instead, please reach out your FinBlocks's account manager.

For each report, we first try to confirm the vulnerability. When it is confirmed, the core team works on a solution. Our team will get back to you once the security vulnerability has been fixed.
