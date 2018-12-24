# FinBlocks PHP SDK

This is the official's [FinBlocks](https://www.finblocks.net/) PHP SDK.

[![Build Status](https://scrutinizer-ci.com/g/crowd2fund/finblocks-php-sdk/badges/build.png?b=master&s=f6a62b102bd22ff4537f5cd15e8f59038676f8ab)](https://scrutinizer-ci.com/g/crowd2fund/finblocks-php-sdk/build-status/master)
[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/crowd2fund/finblocks-php-sdk/badges/quality-score.png?b=master&s=402d0cea20619454ae161e18ccd41f92b064b88e)](https://scrutinizer-ci.com/g/crowd2fund/finblocks-php-sdk/?branch=master)
[![Code Coverage](https://scrutinizer-ci.com/g/crowd2fund/finblocks-php-sdk/badges/coverage.png?b=master&s=1807a04bcf24071a747e22b7748bfbfedc8454de)](https://scrutinizer-ci.com/g/crowd2fund/finblocks-php-sdk/?branch=master)
[![SymfonyInsight](https://insight.symfony.com/projects/e94f0c04-15ca-4fad-ac02-d63396e42e63/mini.svg)](https://insight.symfony.com/projects/e94f0c04-15ca-4fad-ac02-d63396e42e63)
[![StyleCI](https://github.styleci.io/repos/162704104/shield?branch=master)](https://github.styleci.io/repos/162704104)

## Prerequisites

* PHP 7.0 or later
* PHP cURL extension
* PHP JSON extension

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
use FinBlocks\FinBlocks;

$finblocks = new FinBlocks('path/to/cert', 'path/to/info', 'path/to/path');

$sandbox = new FinBlocks('path/to/cert', 'path/to/info', 'path/to/path', true);
```

Access to the API resources directly from the client, such as::

```php
$finblocksWallets = $finblocks->api()->accountHolders()->list();
```

Or create new resources instantiating the ones that you need:

```php
$accountHolder = $finblocks->factories()->accountHolders()->createIndividual();
$accountHolder->... // Use the setters to add the expected content for this model.

// The Endpoint will return a new object, that you can set to the existing variable.
$accountHolder = $finblocks->api()->accountHolders()->createIndividual($accountHolder);
```

You can create new models easily thanks to the built-in factories:

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

And all available API resources are provided by this SDK.

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

As an OpenSource project, all _Issues_ and _Pull Requests_ are welcome. 
